<?php
declare(strict_types=1);
namespace App\Services\Medical\MedicalResult;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Medical\MrdicalResult\CreateMedicalResultActionData;
use App\ActionData\Medical\MrdicalResult\UpdateMedicalResultActionData;
use App\DataObjects\Medical\MedicalResult\MedicalResultData;
use App\Models\MedicalResult;
use Illuminate\Database\Eloquent\Model;
use App\Services\FileService;
use App\ViewModels\Medical\MedicalResult\MedicalResultViewModel;

class MedicalResultService
{
    /**
     * @param int $medical
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $medical,int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = MedicalResult::applyEloquentFilters($filters)->with('files')
            ->where('medical_order_id','=' , $medical)
            ->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (MedicalResult $medical_result) {
            return MedicalResultData::createFromEloquentModel($medical_result);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CreateMedicalResultActionData $actionData
     * @return MedicalResultData
     */
    public function createMedicalResult(CreateMedicalResultActionData $actionData): MedicalResultData
    {
        $data = $actionData->all();
        $medical_result = MedicalResult::query()->create($data);
        if (isset($data['files'])){
            foreach ($data['files'] as $file){
                $this->uploadFile($file, $medical_result);
            }
        }
        return MedicalResultData::createFromEloquentModel($medical_result);
    }

    /**
     * @param UpdateMedicalResultActionData $actionData
     * @param int $id
     * @return MedicalResultData
     */
    public function updateMedicalResult(UpdateMedicalResultActionData $actionData, int $id): MedicalResultData
    {
        $data = $actionData->all();
        $medical_result = $this->getMedicalResult($id);
        $medical_result->update($data);
        if (isset($data['files'])){
            foreach ($data['files'] as $file){
                $this->uploadFile($file, $medical_result);
            }
        }
        return MedicalResultData::createFromEloquentModel($medical_result);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteMedicalResult(int $id): void
    {
        $medical_result = $this->getMedicalResult($id);
        foreach ($medical_result->files as $file) {
            FileService::fileDelete(diskName: 'medicals', id: $file->id);
        }
        $medical_result->delete();

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */

    public function getMedicalResults()
    {
        return self::paginate(1)->items->transform(function (MedicalResultData $data) {
            return new MedicalResultViewModel($data);
        });
    }

    /**
     * @param int $id
     * @return MedicalResult
     */
    public function getMedicalResult(int $id): MedicalResult
    {
        return MedicalResult::query()->with('files')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return MedicalResultData
     */
    public function edit(int $id): MedicalResultData
    {
        $medical_result = $this->getMedicalResult($id);
        return MedicalResultData::fromModel($medical_result);
    }

    /**
     * @param $file
     * @param Model $model
     * @return void
     */
    public function uploadFile( $file,Model $model):void
    {
        if (isset($file['file'])){
            FileService::uploadFile(file: $file['file'], model: $model, lang: $file['lang'], diskName: 'medicals', filePath: 'results/', uploaded_at: $file['uploaded_at']);
        }
    }
}
