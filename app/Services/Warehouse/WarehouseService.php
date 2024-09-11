<?php
declare(strict_types = 1);
namespace App\Services\Warehouse;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Warehouse\Warehouse\ExportWarehouseActionData;
use App\ActionData\Warehouse\Warehouse\WarehouseActionData;
use App\DataObjects\Warehouse\Warehouse\WarehouseData;
use App\Models\WarehouseModel;

class WarehouseService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = WarehouseModel::applyEloquentFilters($filters)->with('warehouse_category')
            ->orderBy('id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (WarehouseModel $wareHouse) {
            return WareHouseData::fromModel($wareHouse);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param WarehouseActionData $actionData
     * @return WarehouseData
     */
    public function createWareHouse(WareHouseActionData $actionData): WareHouseData
    {
        $data = $actionData->all();
        $wareHouse = WarehouseModel::query()->create($data);
        return WareHouseData::createFromEloquentModel($wareHouse);
    }

    /**
     * @param WarehouseActionData $actionData
     * @param int $id
     * @return WarehouseData
     */
    public function updateWareHouse(WareHouseActionData $actionData, int $id): WareHouseData
    {
        $data = $actionData->all();
        $wareHouse = $this->getWareHouse($id);
        $wareHouse->update($data);
        return WareHouseData::createFromEloquentModel($wareHouse);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteWareHouse(int $id): void
    {
        $wareHouse = $this->getWareHouse($id);
        $wareHouse->delete();
    }

    public function getWareHouses()
    {
        $warehouses = WarehouseModel::with('warehouse_category')->get();
        return $warehouses->transform(fn(WareHouseModel $medicalStatus) => WareHouseData::fromModel($medicalStatus));
    }

    /**
     * @param int $id
     * @return WarehouseModel
     */
    public function getWareHouse(int $id): WarehouseModel
    {
        return WareHouseModel::query()->with(['warehouse_category'])->findOrFail($id);
    }

    /**
     * @param int $id
     * @return WarehouseData
     */
    public function edit(int $id): WareHouseData
    {
        $medicalStatus = $this->getWareHouse($id);
        return WareHouseData::fromModel($medicalStatus);
    }

    public function exportWarehouses(ExportWarehouseActionData $actionData)
    {
        $query = WarehouseModel::query();
        if ($actionData->has('select') && $actionData->select != null)  {
            if($actionData->select == 'not_empty') {
                $query->where('remaining_quantity','>',0);
            }
            if($actionData->select == 'empty') {
                $query->where('remaining_quantity','=',0);
            }
        }
        $query->where('date_entered', '>=', $actionData->from)
            ->where('date_entered', '<=', $actionData->to);
        $warehouses = $query->with('warehouse_category')->get();
        return $warehouses->transform(fn(WareHouseModel $medicalStatus) => WareHouseData::fromModel($medicalStatus));
    }

}
