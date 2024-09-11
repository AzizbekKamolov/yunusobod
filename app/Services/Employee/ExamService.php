<?php
declare(strict_types=1);

namespace App\Services\Employee;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Employees\EmployeeExamAttempt\EmployeeExamAttemptActionData;
use App\DataObjects\Employees\EmployeeExamAttempt\EmployeeExamAttemptData;
use App\DataObjects\Employees\Exam\ExamData;
use App\DataObjects\Quiz\Question\QuestionData;
use App\Models\EmployeeExamAttemptModel;
use App\Models\ExamModel;
use App\Models\QuestionModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use function App\Helpers\employee;

class ExamService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = []): DataObjectCollection
    {
        $model = ExamModel::applyEloquentFilters($filters)
            ->with('department', 'employeeAttempt')
            ->orderBy('exams.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (ExamModel $exam) {
            return ExamData::createFromEloquentModel($exam);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param int $examId
     * @return ExamModel
     */
    public function getOne(int $examId): ExamModel
    {
        return ExamModel::query()->where('department_id', '=', employee()->department_id)->with('employeeAttempt')->findOrFail($examId);
    }

    public function getOneData(int $examId): ExamData
    {
        return ExamData::fromModel($this->getOne($examId));
    }

    public function getRandQuestions(int $topicId, int $questionsCount): Collection
    {
        return QuestionModel::query()
            ->where('topic_id', '=', $topicId)
//            ->with(['answers' => function ($query) {
//                $query->inRandomOrder();
//            }])
            ->limit($questionsCount)
            ->inRandomOrder()
            ->get();
    }

    public function getQuestions(ExamData $exam): Collection
    {
        $questions = collect();
        foreach ($exam->topics as $item) {
            $questions = $questions->merge($this->getRandQuestions((int)$item["topic_id"], (int)$item['questions_count']));
        }
        return $questions->transform(fn(QuestionModel $questionModel) => QuestionData::fromModel($questionModel));
    }

    public function checkExam(ExamData $exam): bool
    {
        $employeeAttemptCount = EmployeeExamAttemptModel::query()
            ->where('exam_id', '=', $exam->id)
            ->where('employee_id', '=', employee()->id)
            ->count();
        return $exam->attempts_count <= $employeeAttemptCount;
    }
    public function checkExamExpire(ExamData $exam): bool
    {
        if ($exam->to_date < date("Y-m-d H:i:s") || !$exam->status) return true;
        return false;
    }

    public function createNewAttempt(ExamData $exam, int $questionCount, array $questions = []):EmployeeExamAttemptData
    {
        $duration = explode(':', $exam->duration);
        $endTime = Carbon::now()->addHour($duration[0])->addMinute($duration[1])->addSecond($duration[2]);
        $employeeAttempt = EmployeeExamAttemptActionData::fromArray([
            "employee_id" => employee()->id,
            "start_time" => now(),
            "end_time" => $endTime,
            "exam_id" => $exam->id,
            "question_count" => $questionCount,
            "questions" => $questions,
        ]);
        $newAttempt = EmployeeExamAttemptModel::query()->create($employeeAttempt->toArray());
        return EmployeeExamAttemptData::fromModel($newAttempt);
    }
}
