<?php

namespace App\Services\Employee;

use Akbarali\DataObject\DataObjectCollection;
use App\DataObjects\Employees\Warehouse\EmployeeProductData;
use App\Models\EmployeeProduct;
use function App\Helpers\employee;

class WarehouseService
{
    public function getEmployeeProducts(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $employee_id = employee()->id;
        $model = EmployeeProduct::applyEloquentFilters($filters)
            ->where('employee_id','=',$employee_id)
            ->with('warehouse','warehouse_category')
            ->orderBy('id','DESC');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (EmployeeProduct $employee_product) {
            return EmployeeProductData::createFromEloquentModel($employee_product);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);

    }
}
