<?php

namespace App\Services\Accident;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Accident\AccidentRecord\CreateAccidentRecordActionData;
use App\ActionData\Accident\AccidentRecord\ExportAccidentRecordActionData;
use App\ActionData\Accident\AccidentRecord\UpdateAccidentRecordActionData;
use App\DataObjects\Accident\AccidentRecord\AccidentRecordData;
use App\Models\Accident\AccidentRecord;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AccidentRecordService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = AccidentRecord::applyEloquentFilters($filters)->with('accidentType','employee')
            ->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (AccidentRecord $accidentRecord) {
            return AccidentRecordData::fromModel($accidentRecord);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CreateAccidentRecordActionData $actionData
     * @return AccidentRecordData
     */
    public function createAccidentRecord(CreateAccidentRecordActionData $actionData): AccidentRecordData
    {
        $data = $actionData->all();
        $accidentRecord = AccidentRecord::query()->create($data);
        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                $this->uploadFile($file, $accidentRecord);
            }
        }
        return AccidentRecordData::createFromEloquentModel($accidentRecord);
    }

    /**
     * @param UpdateAccidentRecordActionData $actionData
     * @param int $id
     * @return AccidentRecordData
     */
    public function updateAccidentRecord(UpdateAccidentRecordActionData $actionData, int $id): AccidentRecordData
    {
        $data = $actionData->all();
        $accidentRecord = $this->getAccidentRecord($id);
        $accidentRecord->update($data);
        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                $this->uploadFile($file, $accidentRecord);
            }
        }
        return AccidentRecordData::createFromEloquentModel($accidentRecord);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteAccidentRecord(int $id): void
    {
        $accidentRecord = $this->getAccidentRecord($id);
        $accidentRecord->delete();

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Collection
     */
    public function getAccidentRecords()
    {
        $accidentRecords = AccidentRecord::all();
        return $accidentRecords->transform(fn(AccidentRecord $accidentRecord) => AccidentRecordData::fromModel($accidentRecord));
    }

    /**
     * @param int $id
     * @return AccidentRecord
     */
    public function getAccidentRecord(int $id): AccidentRecord
    {
        return AccidentRecord::query()->with(['files','accidentType','employee'])->findOrFail($id);
    }

    /**
     * @param int $id
     * @return AccidentRecordData
     */
    public function edit(int $id): AccidentRecordData
    {
        $accidentRecord = $this->getAccidentRecord($id);
        return AccidentRecordData::fromModel($accidentRecord);
    }

    /**
     * @param $file
     * @param Model $model
     * @return void
     */
    public function uploadFile($file, Model $model): void
    {
        if (isset($file['file'])) {
            FileService::uploadFile(file: $file['file'], model: $model, lang: $file['lang'], diskName: 'medicals', filePath: 'records/', uploaded_at: $file['uploaded_at']);
        }
    }

    public function exportAccidentRecords(ExportAccidentRecordActionData $actionData)
    {
        $query = AccidentRecord::query();
        if($actionData->has('accident_type_id') && $actionData->accident_type_id != null){
            $query->where('accident_type_id','=', $actionData->accident_type_id);
        }
        $query->where('begin_date' ,'>=', $actionData->from)
            ->where('begin_date' ,'<=', $actionData->to);
        $accidentRecords = $query->with('accidentType','employee')->get();
        return $accidentRecords->transform(fn(AccidentRecord $data) => AccidentRecordData::fromModel($data));
    }
}
