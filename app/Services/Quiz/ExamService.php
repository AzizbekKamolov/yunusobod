<?php

namespace App\Services\Quiz;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Quiz\Exam\CreateExamActionData;
use App\DataObjects\Employees\EmployeeExamAttempt\EmployeeExamAttemptData;
use App\DataObjects\Quiz\Exam\ExamData;
use App\DataObjects\Quiz\Question\QuestionData;
use App\Models\EmployeeExamAttemptModel;
use App\Models\ExamModel;
use App\Models\QuestionModel;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class ExamService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = ExamModel::applyEloquentFilters($filters)
            ->with('department')
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
     * @param CreateExamActionData $actionData
     * @return ExamData
     * @throws ValidationException
     */
    public function createExam(CreateExamActionData $actionData): void
    {
        $data = $actionData->all();
        ExamModel::query()->create($data);
    }


    /**
     * @param CreateExamActionData $actionData
     * @param int $id
     * @return ExamData
     * @throws ValidationException
     */
    public function updateExam(CreateExamActionData $actionData, int $id): ExamData
    {
        $data = $actionData->all();
        $exam = $this->getExam($id);
        $exam->update($data);
        return ExamData::createFromEloquentModel($exam);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteExam(int $id): void
    {
        $exam = $this->getExam($id);
        $exam->delete();

    }

    /**
     * @param int $id
     * @return ExamModel
     */
    public function getExam(int $id): ExamModel
    {
        return ExamModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return ExamData
     */
    public function edit(int $id): ExamData
    {
        $exam = $this->getExam($id);
        return ExamData::fromModel($exam);
    }

    /**
     * @param int $id
     * @return EmployeeExamAttemptData
     */
    public function getOneAttempt(int $id): EmployeeExamAttemptData
    {
        return EmployeeExamAttemptData::fromModel(EmployeeExamAttemptModel::query()->findOrFail($id));
    }

    /**
     * @param array $idS
     * @param int $type
     * @return Collection
     */
    public function getQuestions(array $idS, int $type = 3): Collection
    {
        $questions = QuestionModel::query()
            ->where('type', '=', $type)
            ->whereIn('id', $idS)
            ->get();
        return $questions->transform(fn(QuestionModel $model) => QuestionData::fromModel($model));
    }

    public function getQuestionsById(array $idS): Collection
    {
        $questions = QuestionModel::query()->with(['answers' => function ($query) {
            $query->inRandomOrder();
        }])
            ->whereIn('id', $idS)
            ->get();
        return $questions->transform(fn(QuestionModel $model) => QuestionData::fromModel($model));
    }

    public function checkAttempt(EmployeeExamAttemptData $attempt, array $checkedAnswers = []): void
    {
        EmployeeExamAttemptModel::query()
            ->where('id', $attempt->id)
            ->update([
                "correct_answers_count" => $attempt->correct_answers_count + count($checkedAnswers),
                "checked_answers" => $checkedAnswers,
                "checked_by" => auth()->id()
            ]);
    }

    public function export()
    {

    }

    public function all(): array
    {
        $exams = [];
        $all = ExamModel::query()->count();
        $active = ExamModel::query()->where("status", "=", 1)
            ->where('from_date', '<', now())
            ->where('to_date', '>', now())
            ->count();
        $exams['all'] = $all;
        $exams['active'] = $active;
        return $exams;
    }
}
