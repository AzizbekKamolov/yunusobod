<?php
declare(strict_types=1);

namespace App\Http\Controllers\Quiz;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Employees\EmployeeExamAttempt\EmployeeAttemptCheckActionData;
use App\ActionData\Quiz\Exam\CreateExamActionData;
use App\Enums\QuestionEnum;
use App\Exports\Quiz\EmployeeExamExport;
use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use App\Services\Employee\EmployeeExamAttemptService;
use App\Services\EmployeeService;
use App\Services\Quiz\ExamService;
use App\Services\Quiz\TopicService;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use App\ViewModels\Employee\EmployeeExamAttemptViewModel;
use App\ViewModels\Employees\Exam\EmployeeExamAttemptViewModel as EmployeeAttemptViewModel;
use App\ViewModels\Quiz\Exam\ExamViewModel;
use App\ViewModels\Quiz\Topic\TopicViewModel;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExamController extends Controller
{
    function __construct(
        protected ExamService       $service,
        protected DepartmentService $departmentService,
        protected EmployeeService   $employeeService,
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
        $departments = $this->departmentService->getDepartments();
        $departments->transform(fn($department) => DepartmentViewModel::fromDataObject($department));

        $filters = [];
        $collection = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        return (new PaginationViewModel($collection, ExamViewModel::class))->toView('admin.quiz.exams.index', compact('departments'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $departments = $this->departmentService->getDepartments();
        $departments->transform(fn($department) => DepartmentViewModel::fromDataObject($department));

        return view('admin.quiz.exams.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(CreateExamActionData $actionData): RedirectResponse
    {
        $this->service->createExam($actionData);
        return redirect()->route('exams.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('quiz.quiz')]),
        ]);
    }

    public function edit(int $id): View
    {
        $data = $this->service->edit($id);
        $viewModel = new ExamViewModel($data);

        $departments = $this->departmentService->getDepartments();
        $departments->transform(fn($department) => DepartmentViewModel::fromDataObject($department));

        $topics = (new TopicService())->getAll($data->lang);
        $topics->transform(fn($topic) => TopicViewModel::fromDataObject($topic));
        return $viewModel->toView('admin.quiz.exams.edit', compact('departments', 'topics'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function show(Request $request, int $id): View
    {
        $exam = $this->service->edit($id);

        $departments = $this->departmentService->getDepartments();
        $departments->transform(fn($department) => DepartmentViewModel::fromDataObject($department));

        $topics = (new TopicService())->getAll($exam->lang);
        $topics->transform(fn($topic) => TopicViewModel::fromDataObject($topic));

        $employees = $this->employeeService
            ->paginateEmployee(examId: $id, departmentId: $exam->department_id, page: (int)$request->get('page', 1), limit: (int)$request->get('limit', 10));
        return (new PaginationViewModel($employees, EmployeeExamAttemptViewModel::class))
            ->toView('admin.quiz.exams.show', compact('departments', 'topics', 'exam'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function showAttempt(int $id): View
    {
        $attempt = $this->service->getOneAttempt($id);
        $questions = $this->service->getQuestions($attempt->questions, QuestionEnum::TYPE_PRACTICAL->value);

        $viewModel = EmployeeAttemptViewModel::fromDataObject($attempt);
        return $viewModel->toView('admin.quiz.exams.attempts', compact('questions'));
    }

    /**
     * @param EmployeeAttemptCheckActionData $actionData
     * @param int $attemptId
     * @return RedirectResponse
     */
    public function checkAttempt(EmployeeAttemptCheckActionData $actionData, int $attemptId): RedirectResponse
    {
        $attempt = $this->service->getOneAttempt($attemptId);
        if ($attempt->checked_by) {
            return redirect()->route('exams.show', [$attempt->exam_id])->with('res', [
                'method' => 'info',
                'msg' => trans('quiz.already_evaluation'),
            ]);
        }
        $this->service->checkAttempt($attempt, $actionData->checked_answers);
        return redirect()->route('exams.show', [$attempt->exam_id]);
    }

    /**
     * @param CreateExamActionData $actionData
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(CreateExamActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateExam($actionData, $id);
        return redirect()->route('exams.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('quiz.quiz')]),
        ]);
    }


    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteExam($id);
        return redirect()->route('exams.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('quiz.quiz')]),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return BinaryFileResponse
     */
    public function exportAttempt(Request $request, int $id): BinaryFileResponse
    {
        $exam = $this->service->edit($id);
        $departments = $this->departmentService->getDepartments();
        $departments->transform(fn($department) => DepartmentViewModel::fromDataObject($department));

        $topics = (new TopicService())->getAll($exam->lang);
        $topics->transform(fn($topic) => TopicViewModel::fromDataObject($topic));

        $employees = $this->employeeService
            ->paginateEmployee(examId: $id, departmentId: $exam->department_id, page: (int)$request->get('page', 1), limit: (int)$request->get('limit', 500));
        $fileName = $exam->name . "(" . Carbon::now()->format('d-m-Y') . ").xlsx";
//        dd($employees->items);
        $employees->items->transform(fn($model) => EmployeeExamAttemptViewModel::fromDataObject($model));
        return Excel::download(new EmployeeExamExport($employees->items, $departments, $topics, $exam), $fileName);
//        return (new PaginationViewModel($employees, EmployeeExamAttemptViewModel::class))
//            ->toView('admin.quiz.exams.show', compact('departments', 'topics', 'exam'));
    }

    public function result(int $id):View
    {
        $attempt = $this->service->getOneAttempt($id);
        $questions = $this->service->getQuestionsById($attempt->questions);
        $viewModel = EmployeeAttemptViewModel::fromDataObject($attempt);
        return  $viewModel->toView('admin.quiz.exams.result', compact( 'questions'));
    }
}
