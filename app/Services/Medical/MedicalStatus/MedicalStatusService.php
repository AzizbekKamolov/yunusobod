<?php
declare(strict_types=1);
namespace App\Services\Medical\MedicalStatus;
use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Medical\MedicalStatus\CreateMedicalStatusActionData;
use App\DataObjects\Medical\MedicalStatus\MedicalStatusData;
use App\Models\MedicalStatus;
use App\ViewModels\Medical\MedicalStatus\MedicalStatusViewModel;
use Illuminate\Validation\ValidationException;

class MedicalStatusService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = MedicalStatus::applyEloquentFilters($filters)->with('medical_results')
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (MedicalStatus $medicalStatus) {
            return MedicalStatusData::createFromEloquentModel($medicalStatus);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CreateMedicalStatusActionData $actionData
     * @return MedicalStatusData
     * @throws ValidationException
     */
    public function createMedicalStatus(CreateMedicalStatusActionData $actionData): MedicalStatusData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:medical_statuses,name->uz',
            'name.ru' => 'required|string|unique:medical_statuses,name->ru'
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $medicalStatus = MedicalStatus::query()->create($data);
        return MedicalStatusData::createFromEloquentModel($medicalStatus);
    }

    /**
     * @param CreateMedicalStatusActionData $actionData
     * @param int $id
     * @return MedicalStatusData
     * @throws ValidationException
     */
    public function updateMedicalStatus(CreateMedicalStatusActionData $actionData, int $id): MedicalStatusData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:medical_statuses,name->uz' . $id,
            'name.ru' => 'required|string|unique:medical_statuses,name->ru' . $id
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $medicalStatus = $this->getMedicalStatus($id);
        $medicalStatus->update($data);
        return MedicalStatusData::createFromEloquentModel($medicalStatus);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteMedicalStatus(int $id): bool
    {
        $medicalStatus = $this->getMedicalStatus($id);
        if(count($medicalStatus->medical_results) > 0){
            return false;
        }
        $medicalStatus->delete();
        return true;
    }


    public function getMedicalStatuses()
    {
        $medicalStatuses = MedicalStatus::all();
        return $medicalStatuses->transform(fn(MedicalStatus $medicalStatus) => MedicalStatusData::fromModel($medicalStatus));

    }

    /**
     * @param int $id
     * @return MedicalStatus
     */
    public function getMedicalStatus(int $id): MedicalStatus
    {
        return MedicalStatus::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return MedicalStatusData
     */
    public function edit(int $id): MedicalStatusData
    {
        $medicalStatus = $this->getMedicalStatus($id);
        return MedicalStatusData::fromModel($medicalStatus);
    }
}
