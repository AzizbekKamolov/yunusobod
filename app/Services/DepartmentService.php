<?php
namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\Exceptions\OperationException;
use App\Models\Department;
use App\DataObjects\Department\DepartmentData;
use App\ActionData\Department\CreateDepartmentActionData;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use Illuminate\Database\Eloquent\Builder;

class DepartmentService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page =1, int $limit =15 ,?iterable $filters = [] ):DataObjectCollection
    {
        $model = Department::applyEloquentFilters($filters)->with('employees')
            ->orderBy('departments.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Department $department) {
            return DepartmentData::createFromEloquentModel($department);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CreateDepartmentActionData $actionData
     * @return DepartmentData
     * @throws \Illuminate\Validation\ValidationException
     */
    public  function createDepartment(CreateDepartmentActionData  $actionData): DepartmentData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:departments,name->uz',
            'name.ru' => 'required|string|unique:departments,name->ru'
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $department = Department::create($data);
        return DepartmentData::createFromEloquentModel($department);
    }


    /**
     * @param CreateDepartmentActionData $actionData
     * @param int $id
     * @return DepartmentData
     * @throws \Illuminate\Validation\ValidationException
     */
    public  function updateDepartment(CreateDepartmentActionData $actionData, int $id): DepartmentData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:departments,name->uz'.$id,
            'name.ru' => 'required|string|unique:departments,name->ru'.$id
        ]);
        $actionData->validateException();
        $data = $actionData->all();
        $department = Department::query()->findOrFail($id);
        $department->update($data);
        return DepartmentData::createFromEloquentModel($department);
    }


    /**
     * @param int $id
     * @return bool
     */
    public  function deleteDepartment(int $id): bool
    {
        $department = Department::query()->find($id);
        if ($department->employees()->exists() || $department->positions()->exists()) {
           return false;
        }
        $department->delete();
        return true;
    }

    /**
     * @return Department[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getDepartments()
    {
        $departments = Department::query()->with('employees')->get();
        return $departments->transform(fn(Department $department) => DepartmentData::fromModel($department));
    }

}
