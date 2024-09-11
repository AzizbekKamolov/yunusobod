<?php

namespace App\Services\Employee;

use Akbarali\DataObject\DataObjectCollection;
use App\DataObjects\Employees\Accident\AccidentRecordData;
use App\Models\Accident\AccidentRecord;
use function App\Helpers\employee;

class AccidentRecordService
{

    public function getEmployeeProducts(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $employee_id = employee()->id;
        $model = AccidentRecord::applyEloquentFilters($filters)
            ->where('employee_id','=',$employee_id)
            ->with('files')
            ->orderBy('id','DESC');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (AccidentRecord $employee_product) {
            return AccidentRecordData::createFromEloquentModel($employee_product);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }
}
