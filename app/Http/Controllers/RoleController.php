<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Role\CreateRoleActionData;
use App\Filters\Role\RolesFilter;
use App\Services\PermissionService;
use App\ViewModels\Admin\Role\RoleViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\RoleService;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct(protected RoleService $service){

    }

    public function index(Request $request):View
    {
        $filters [] = RolesFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return  (new PaginationViewModel($collection ,RoleViewModel::class))->toView('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $viewModel = RoleViewModel::createEmpty();
        $permissions = (new PermissionService())->getPermissions();
        return $viewModel->toView('admin.roles.create', compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request):RedirectResponse
    {
        $this->service->createRole(CreateRoleActionData::createFromRequest($request)  );
        return redirect()->route('roles.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_create',['attribute' => trans('form.roles.role')])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id):View
    {
        $role = $this->service->getRole($id);
        $viewModel = new RoleViewModel($role);
        $permissions = (new PermissionService())->getPermissions();
        return $viewModel->toView('admin.roles.edit', compact( 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(Request $request,int $id): \Illuminate\Http\RedirectResponse
    {
        $actionData = CreateRoleActionData::createFromRequest($request);
        $this->service->updateRole($actionData,$id);
        return redirect()->route('roles.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_update',['attribute' => trans('form.roles.role')])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Exception
     */
    public function delete(int $id): \Illuminate\Http\RedirectResponse
    {
        $this->service->deleteRole($id);
        return redirect()->route('roles.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_delete',['attribute' => trans('form.roles.role')])
        ]);
    }

}
