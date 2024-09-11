<?php
declare(strict_types=1);

namespace App\Services\Employee;

use App\DataObjects\Employees\EmployeeExamAttempt\EmployeeExamAttemptData;
use App\DataObjects\Quiz\Question\QuestionData;
use App\Enums\QuestionEnum;
use App\Models\EmployeeExamAttemptModel;
use App\Models\ExamModel;
use App\Models\QuestionModel;
use Illuminate\Support\Collection;
use function App\Helpers\employee;

class EmployeeExamAttemptService
{

    /**
     * @param int $examId
     * @return ExamModel
     */
    public function getOneAttempt(int $attemptId): EmployeeExamAttemptModel
    {
        return EmployeeExamAttemptModel::query()->where('employee_id', '=', employee()->id)->findOrFail($attemptId);
    }
    public function  getOne(int $id):EmployeeExamAttemptData
    {
        return EmployeeExamAttemptData::fromModel(EmployeeExamAttemptModel::query()->findOrFail($id));
    }

    public function getAttempts(int $examId):Collection
    {
        $attempts = EmployeeExamAttemptModel::query()
             ->where('employee_id', '=', employee()->id)
             ->where('exam_id', '=', $examId)
             ->get();
        return $attempts->transform(fn (EmployeeExamAttemptModel $model) => EmployeeExamAttemptData::fromModel($model));
    }

    public function getOneAttemptData(int $attemptId): EmployeeExamAttemptData
    {
        return EmployeeExamAttemptData::fromModel($this->getOneAttempt($attemptId));
    }

    public function checkAttempt(EmployeeExamAttemptData $attemptData): bool
    {
        $now = date("Y-m-d H:i:s");
        if ($attemptData->attempt_completed) {
            return false;
        }
        return $now >= $attemptData->start_time && $now <= $attemptData->end_time;
    }

    public function getRandQuestions(array $questionId): Collection
    {
        return QuestionModel::query()
            ->whereIn('id', $questionId)
            ->with(['answers' => function ($query) {
                $query->inRandomOrder();
            }])
            ->get();
    }

    public function getQuestions(array $questionId): Collection
    {
        $questions = $this->getRandQuestions($questionId);

        return $questions->transform(fn(QuestionModel $questionModel) => QuestionData::fromModel($questionModel));
    }

    public function checkAnswers(EmployeeExamAttemptData $attemptData, array $answers): void
    {
        $questions = QuestionModel::query()->with(['answers' => function ($query) {
            $query->where('is_correct', '=', true);
        }])
            ->whereIn('id', $attemptData->questions)
            ->get();
        $correctAnswers = 0;
        $practicalAnswers = [];
        $employeeAnswers = [];
        $existsPractical = false;
        foreach ($questions as $question) {
            if ($question->type != QuestionEnum::TYPE_PRACTICAL->value){
                if (array_key_exists($question->id, $answers)
                    && !array_diff($question->answers->pluck('id')->toArray(), $answers[$question->id])
                    && !array_diff($answers[$question->id], $question->answers->pluck('id')->toArray())) {
                    $correctAnswers++;
                }
                $employeeAnswers[$question->id] = $answers[$question->id];
            }else{
                $existsPractical = true;
                $practicalAnswers[$question->id] = $answers[$question->id];
            }
        }
        EmployeeExamAttemptModel::query()
            ->where('id', $attemptData->id)
            ->update([
                "correct_answers_count" => $correctAnswers,
                "employee_answers" => $employeeAnswers,
                "body" => json_encode($practicalAnswers),
                "attempt_completed" => true,
                "exists_practical" => $existsPractical,
                "finished_at" => date("Y-m-d H:i:s"),
            ]);
    }
}
