<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Employee\CreateEmployeeActionData;
use App\ActionData\Employee\UpdateEmployeeActionData;
use App\DataObjects\Employee\EmployeeData;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = EmployeeModel::applyEloquentFilters($filters)
            ->orderBy('employees.order');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (EmployeeModel $data) {
            return EmployeeData::createFromEloquentModel($data);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param int $id
     * @return void
     */
    public function setOrder(int $id): void
    {
        $employee = $this->getOne(abs($id));
        if ($id < 0) {
            $employee2 = EmployeeModel::query()->where('order', '<', $employee->order)->orderByDesc('order')->first();
        } else {
            $employee2 = EmployeeModel::query()->where('order', '>', $employee->order)->orderBy('order')->first();
        }
        if ($employee2) {
            $ord = $employee->order;
            $employee->order = $employee2->order;
            $employee2->order = $ord;
            $employee->update();
            $employee2->update();
        }
    }


    /**
     * @param CreateEmployeeActionData $actionData
     * @return EmployeeData
     */
    public function createEmployee(CreateEmployeeActionData $actionData): EmployeeData
    {
        $data = $actionData->all();
        $data['photo'] = $actionData->photo->hashName();
        Storage::disk('local')->put('employees/' . $data['photo'], file_get_contents($actionData->photo->getRealPath()));
        $employee = EmployeeModel::query()->create($data);
        $employee->update(['order' => $employee->id]);
        return EmployeeData::createFromEloquentModel($employee);
    }


    /**
     * @param UpdateEmployeeActionData $actionData
     * @param int $id
     * @return void
     */
    public function updateEmployee(UpdateEmployeeActionData $actionData, int $id): void
    {
        $employee = $this->getOne($id);
        $data = $actionData->all();
        unset($data['photo']);
        if ($actionData->photo) {
            Storage::disk('local')->delete('employees/' . $employee->photo);
            $data['photo'] = $actionData->photo->hashName();
            Storage::disk('local')->put('employees/' . $data['photo'], file_get_contents($actionData->photo->getRealPath()));
        }
        $employee->fill($data);
        $employee->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteEmployee(int $id): void
    {
        $data = $this->getOne($id);
        Storage::disk('local')->delete('employees/' . $data->photo);

        $data->delete();
    }

    /**
     * @param int $id
     * @return EmployeeModel
     */
    protected function getOne(int $id): EmployeeModel
    {
        return EmployeeModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return EmployeeData
     */
    public function getEmployee(int $id): EmployeeData
    {
        return EmployeeData::fromModel($this->getOne($id));
    }

    public function getAllEmployees()
    {
        $employees = EmployeeModel::query()->orderBy('order')->where('status', true)->get();
        return $employees->transform(fn(EmployeeModel $data) => EmployeeData::fromModel($data));
    }
}
