<?php

namespace App\Services\Warehouse;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Warehouse\WarehouseCategory\WarehouseCategoryActionData;
use App\DataObjects\Warehouse\WarehouseCategory\WarehouseCategoryData;
use App\Models\WarehouseCategoryModel;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class WarehouseCategoryService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = WarehouseCategoryModel::applyEloquentFilters($filters)->with('warehouses')
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (WarehouseCategoryModel $wareHouseCategory) {
            return WareHouseCategoryData::fromModel($wareHouseCategory);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param WarehouseCategoryActionData $actionData
     * @return WarehouseCategoryData
     * @throws ValidationException
     */
    public function createWareHouseCategory(WareHouseCategoryActionData $actionData): WareHouseCategoryData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:medical_statuses,name->uz',
            'name.ru' => 'required|string|unique:medical_statuses,name->ru'
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $wareHouseCategory = WarehouseCategoryModel::query()->create($data);
        return WareHouseCategoryData::createFromEloquentModel($wareHouseCategory);
    }

    /**
     * @param WarehouseCategoryActionData $actionData
     * @param int $id
     * @return WarehouseCategoryData
     * @throws ValidationException
     */
    public function updateWareHouseCategory(WareHouseCategoryActionData $actionData, int $id): WareHouseCategoryData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:medical_statuses,name->uz' . $id,
            'name.ru' => 'required|string|unique:medical_statuses,name->ru' . $id
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $wareHouseCategory = $this->getWareHouseCategory($id);
        $wareHouseCategory->update($data);
        return WareHouseCategoryData::createFromEloquentModel($wareHouseCategory);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteWareHouseCategory(int $id): bool
    {
        $wareHouseCategory = $this->getWareHouseCategory($id);
        if (count($wareHouseCategory->warehouses) > 0) {
            return false;
        }
        $wareHouseCategory->delete();
        return true;

    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|Collection
     */
    public function getWareHouseCategories()
    {
        $wareHouseCategories = WarehouseCategoryModel::query()->with('warehouses')->orderBy('id', 'Desc')->get();
        return $wareHouseCategories->transform(fn(WareHouseCategoryModel $medicalStatus) => WareHouseCategoryData::fromModel($medicalStatus));

    }

    /**
     * @param int $id
     * @return WarehouseCategoryModel
     */
    public function getWareHouseCategory(int $id): WarehouseCategoryModel
    {
        return WareHouseCategoryModel::query()->with('warehouses')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return WarehouseCategoryData
     */
    public function edit(int $id): WareHouseCategoryData
    {
        $medicalStatus = $this->getWareHouseCategory($id);
        return WareHouseCategoryData::fromModel($medicalStatus);
    }
}
