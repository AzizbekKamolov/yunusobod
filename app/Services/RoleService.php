<?php

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\DataObjects\Role\RoleData;
use App\Models\Role;
use App\ActionData\Role\CreateRoleActionData;

class RoleService
{

    public function paginate( int $page = 1 ,int $limit = 20, ?iterable $filters = null):DataObjectCollection
    {
        $model = Role::applyEloquentFilters($filters)
            ->orderBy('roles.id', 'desc');

        $total = $model->count();
        $skip = ($page - 1) * $limit;
        $items  = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Role $role){
            return RoleData::createFromEloquentModel($role);
        });
        return new DataObjectCollection($items, $total,$limit,$page);
    }
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public  function createRole(CreateRoleActionData $actionData): RoleData
    {

        $actionData->addValidationRule('name', "required|string|unique:roles");
        $actionData->validateException();
        $data = $actionData->all();
        $role = Role::query()->create($data);
        $role->syncPermissions($actionData->permission_id);
        return RoleData::createFromEloquentModel($role);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public  function updateRole(CreateRoleActionData $actionData,int $id): void
    {

        $actionData->addValidationRule('name', "unique:roles,name,$id");
        $actionData->validateException();
        $role = $this->getOne($id);
        $role->fill($actionData->all());
        $role->save();
        $role->syncPermissions($actionData->permission_id);

    }

    /**
     * @throws \Exception
     */
    public  function deleteRole(int $id): void
    {
        $role = Role::query()->find($id);
        if (!$role) {
            throw new \Exception('Role not found');
        }
        $role->delete();
    }

    public function getRole(int $id): RoleData
    {

        return RoleData::fromModel($this->getOne($id));
    }

    public function getOne(int $id): Role
    {
        return Role::query()->with('permissions')->findOrFail($id);

    }


}
