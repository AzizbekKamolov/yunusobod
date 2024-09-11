<?php

namespace App\Services\Employee;


use Akbarali\DataObject\DataObjectCollection;
use App\DataObjects\Employees\Medical\MedicalOrderData;
use App\Models\MedicalOrder;
use function App\Helpers\employee;

class MedicalService
{


    public function getmedicalOrders(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $employee_id = employee()->id;
        $model = MedicalOrder::applyEloquentFilters($filters)->whereHas('order_employees', function ($query) use ($employee_id) {
            $query->where('employee_id', $employee_id);
        })->with(['medical_results' => function ($query) use ($employee_id) {
            $query->where('employee_id', $employee_id)->with('files');
        }, 'files']);
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (MedicalOrder $medical_order) {
            return MedicalOrderData::createFromEloquentModel($medical_order);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);

    }
}
