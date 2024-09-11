<?php
declare(strict_types=1);

namespace App\Http\Controllers\Employee;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Employees\EmployeeExamAttempt\EmployeeFinishAttemptActionData;
use App\Filters\Employees\Exam\ExamFilter;
use App\Http\Controllers\Controller;
use App\Services\Employee\EmployeeExamAttemptService;
use App\Services\Employee\ExamService;
use App\ViewModels\Employees\Exam\EmployeeExamAttemptViewModel;
use App\ViewModels\Employees\Exam\ExamViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    function __construct(
        protected ExamService $service,
        protected EmployeeExamAttemptService $employeeExamAttemptService,
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if ($request->has("session")){
            session()->flash("res", [
                "method" => "success",
                "msg" => $request->get("session"),
            ]);
        }

        $filters[] = ExamFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, ExamViewModel::class))->toView('employee.quiz.exams.index');
    }

    public function showExam(int $examId):View
    {
        $exam = $this->service->getOneData($examId);
        $attempts = $this->employeeExamAttemptService->getAttempts($exam->id)->transform(fn($attempt) => EmployeeExamAttemptViewModel::fromDataObject($attempt));
        $viewModel = ExamViewModel::fromDataObject($exam);
        return $viewModel->toView('employee.quiz.exams.exam_show', compact('attempts'));
    }

    public function startTest(int $examId): RedirectResponse
    {
        $exam = $this->service->getOneData($examId);
        if ($this->service->checkExam($exam)) {
            return redirect()->route("employee.exams.showExam", [$exam->id])->with('res', [
                'method' => 'error',
                'msg' => __('quiz.employee.no_attempt'),
            ]);
        }
        if ($this->service->checkExamExpire($exam)){
            return redirect()->route("employee.exams.showExam", [$exam->id])->with('res', [
                'method' => 'error',
                'msg' => __('quiz.employee.exam_expire'),
            ]);
        }
        $questions = $this->service->getQuestions($exam);
        $newAttempt = $this->service->createNewAttempt($exam, $questions->count(), $questions->pluck('id')->toArray());
        return redirect()->route("employee.exams.getAttempt", [$newAttempt->id]);
    }

    public function getAttempt(int $attemptId): View|RedirectResponse
    {
        $attempt = $this->employeeExamAttemptService->getOneAttemptData($attemptId);
        if (!$this->employeeExamAttemptService->checkAttempt($attempt)) {
            return redirect()->route("employee.exams.showExam", [$attempt->exam_id])->with('res', [
                'method' => 'error',
                'msg' => __('quiz.employee.test_time_is_over') ,
            ]);
        }
        $exam = $this->service->getOneData($attempt->exam_id);
        $questions = $this->employeeExamAttemptService->getQuestions($attempt->questions);
        $viewModel = EmployeeExamAttemptViewModel::fromDataObject($attempt);

        return $viewModel->toView('employee.quiz.exams.start_exam', compact('questions', 'exam'));
    }

    public function finishAttempt(EmployeeFinishAttemptActionData $actionData, int $attemptId):RedirectResponse
    {
        $attempt = $this->employeeExamAttemptService->getOneAttemptData($attemptId);
        $method = "success";
        $msg = __('quiz.employee.test_finish');
        if (!$this->employeeExamAttemptService->checkAttempt($attempt)) {
            $method = "error";
            $msg = __('quiz.employee.test_time_is_over');
        }
        $this->employeeExamAttemptService->checkAnswers($attempt, $actionData->answers);
        return redirect()->route("employee.exams.showExam", [$attempt->exam_id])->with('res', [
            'method' => $method,
            'msg' => $msg,
        ]);
    }

}
