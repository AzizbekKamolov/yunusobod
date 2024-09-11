<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Permission\CreatePermissionActionData;
use App\DataObjects\Permission\PermissionData;
use App\Filters\Permissions\PermissionsFilter;
use App\Services\PermissionService;
use App\ViewModels\Admin\Permission\PermissionViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct(protected PermissionService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):View
    {
        $filters[] = PermissionsFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'),filters: $filters);
        return (new PaginationViewModel($collection, PermissionViewModel::class))->toView('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $viewModel = PermissionViewModel::createEmpty();
        return $viewModel->toView('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->service->createPermission(CreatePermissionActionData::createFromRequest($request));
        return redirect()->route('permissions.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_create',[ 'attribute' => trans('form.permissions.permission')])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $permission = Permission::query()->findOrFail($id);
        $viewModel = new PermissionViewModel(PermissionData::fromModel($permission));

        return $viewModel->toView('admin.permissions.edit');
    }

    /**
     * Update the specified resource in storage.
     * @throws ValidationException
     */
    public function update(Request $request,int $id): RedirectResponse
    {

        $actionDAta = CreatePermissionActionData::fromRequest($request);
        $this->service->updatePermission($actionDAta,$id);
        return redirect()->route('permissions.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_update' ,['attribute' => trans('form.permissions.permission')])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deletePermission($id);
        return redirect()->route('permissions.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_delete' ,['attribute' => trans('form.permissions.permission')])
        ]);
    }
}
