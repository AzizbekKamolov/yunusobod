<?php
declare(strict_types=1);

namespace App\Services\Warehouse;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Warehouse\EmployeeProduct\EmployeeProductActionData;
use App\DataObjects\Warehouse\EmployeeProduct\EmployeeProductData;
use App\Models\EmployeeProduct;
use App\Models\WarehouseModel;
use Illuminate\Support\Collection;

class EmployeeProductService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = EmployeeProduct::applyEloquentFilters($filters)->with('warehouse_category', 'employee')
            ->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (EmployeeProduct $employeeProduct) {
            return EmployeeProductData::fromModel($employeeProduct);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param EmployeeProductActionData $actionData
     * @return bool
     */
    public function createEmployeeProduct(EmployeeProductActionData $actionData):bool
    {
        $warehouse = WarehouseModel::query()->findOrFail($actionData->warehouse_id);
        if($warehouse->remaining_quantity - $actionData->quantity < 0){
            return false;
        }
        $data = $actionData->all();
        $employeeProduct = EmployeeProduct::query()->create($data);
        $warehouse->update([
            'remaining_quantity' => $warehouse ->remaining_quantity - $actionData->quantity
        ]);
        return true;
    }

    /**
     * @param EmployeeProductActionData $actionData
     * @param int $id
     * @return bool
     */
    public function updateEmployeeProduct(EmployeeProductActionData $actionData, int $id): bool
    {
        $data = $actionData->all();
        $warehouse = WarehouseModel::query()->findOrFail($actionData->warehouse_id);
        $employeeProduct = $this->getEmployeeProduct($id);
        if (($warehouse->remaining_quantity + $employeeProduct->quantity) < $actionData->quantity){
            return false;
        }
        $warehouse->update([
            'remaining_quantity' => $warehouse->remaining_quantity - $actionData->quantity + $employeeProduct->quantity
        ]);
        $employeeProduct->update($data);
        return true;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): int
    {
        $employeeProduct = $this->getEmployeeProduct($id);
        $warehouse = WarehouseModel::query()->findOrFail($employeeProduct->warehouse_id);
        $warehouse->update([
            'remaining_quantity' => $warehouse->remaining_quantity + $employeeProduct->quantity
        ]);
        $employeeProduct->delete();
        return $warehouse->id;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getEmployeeProducts(int $id):Collection
    {
        $employeeProductCategories = EmployeeProduct::all();
        return $employeeProductCategories->transform(fn(EmployeeProduct $medicalStatus) => EmployeeProductData::fromModel($medicalStatus));
    }

    /**
     * @param int $id
     * @return EmployeeProduct
     */
    public function getEmployeeProduct(int $id): EmployeeProduct
    {
        return EmployeeProduct::query()->with( 'employee')->findOrFail($id);
    }

    /**
     * @param int $id
     * @return EmployeeProductData
     */
    public function edit(int $id): EmployeeProductData
    {
        $medicalStatus = $this->getEmployeeProduct($id);
        return EmployeeProductData::fromModel($medicalStatus);
    }

    public function getEmployeeProductsById(int $id)
    {
        $products =  EmployeeProduct::query()->with(['employee' => function ($query) {
            $query->with('position','branch');
        }])->where('warehouse_id','=',$id)->orderBy('id','DESC')->get();
        return $products->transform(fn(EmployeeProduct $data) => EmployeeProductData::fromModel($data));
    }
}
