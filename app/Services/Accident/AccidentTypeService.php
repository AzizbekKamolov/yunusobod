<?php

namespace App\Services\Accident;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Accident\AccidentType\CreateAccidentTypeActionData;
use App\DataObjects\Accident\AccidentType\AccidentTypeData;
use App\DataObjects\Accident\AccidentType\AccidentTypeWithCountData;
use App\Models\Accident\AccidentType;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class AccidentTypeService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = AccidentType::applyEloquentFilters($filters)->with('accidentRecords')
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (AccidentType $accidentType) {
            return AccidentTypeData::fromModel($accidentType);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CreateAccidentTypeActionData $actionData
     * @return AccidentTypeData
     * @throws ValidationException
     */
    public function createAccidentType(CreateAccidentTypeActionData $actionData): AccidentTypeData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:accident_types,name->uz',
            'name.ru' => 'required|string|unique:accident_types,name->ru'
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $accidentType = AccidentType::query()->create($data);
        return AccidentTypeData::createFromEloquentModel($accidentType);
    }

    /**
     * @param CreateAccidentTypeActionData $actionData
     * @param int $id
     * @return AccidentTypeData
     * @throws ValidationException
     */
    public function updateAccidentType(CreateAccidentTypeActionData $actionData, int $id): AccidentTypeData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:accident_types,name->uz' . $id,
            'name.ru' => 'required|string|unique:accident_types,name->ru' . $id
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $accidentType = $this->getAccidentType($id);
        $accidentType->update($data);
        return AccidentTypeData::createFromEloquentModel($accidentType);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteAccidentType(int $id): void
    {
        $accidentType = $this->getAccidentType($id);
        $accidentType->delete();

    }

    public function getAccidentTypes()
    {
        $accidentTypes = AccidentType::all();
        return $accidentTypes->transform(fn(AccidentType $accidentType) => AccidentTypeData::fromModel($accidentType));
    }

    /**
     * @param int $id
     * @return AccidentType
     */
    public function getAccidentType(int $id): AccidentType
    {
        return AccidentType::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return AccidentTypeData
     */
    public function edit(int $id): AccidentTypeData
    {
        $accidentType = $this->getAccidentType($id);
        return AccidentTypeData::fromModel($accidentType);
    }

    public function getTypesWithCount()
    {
        $now = Carbon::yesterday()->startOfDay();
        $accidentTypes = AccidentType::query()->withCount(['accidentRecords' => function ($query) use ($now){
            $query->where('end_date','>',$now);
        }])->get();
        return $accidentTypes->transform(fn (AccidentType $data) => AccidentTypeWithCountData::fromModel($data));
    }
}
