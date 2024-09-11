<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Department\CreateDepartmentActionData;
use App\DataObjects\Department\DepartmentData;
use App\Exceptions\OperationException;
use App\Models\Department;
use App\Services\DepartmentService;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DepartmentController extends Controller
{


     function __construct( protected DepartmentService $service ){

     }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request):View
    {
        $filters = [];
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection,DepartmentViewModel::class))->toView('admin.departments.index');
    }

    /**
     * @return View
     */
    public function create():View
    {

        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(CreateDepartmentActionData $actionData):RedirectResponse
    {
        $department = $this->service->createDepartment($actionData);
        return redirect()->route('departments.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_create',['attribute' => trans('form.departments.department')]),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id):View
    {
        $data = Department::query()->findOrFail($id);
        $viewModel = new DepartmentViewModel(DepartmentData::fromModel($data));
        return $viewModel->toView('admin.departments.edit');
    }

    /**
     * Update the specified resource in storage.
     * @throws ValidationException
     * @throws OperationException
     */
    public function update(CreateDepartmentActionData $actionData,int $id ):RedirectResponse
    {
        $this->service->updateDepartment( $actionData, $id);
        return redirect()->route('departments.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_update',['attribute' => trans('form.departments.department')]),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @throws OperationException
     */
    public function delete(int $id):RedirectResponse
    {
        if (!$this->service->deleteDepartment($id)){
            return redirect()->route('departments.index')->with('res',[
                'method' => 'error',
                'msg' => trans('form.dont_delete_departments')
            ]);
        }
        return redirect()->route('departments.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_delete',['attribute' => trans('form.departments.department')]),
        ]);
    }
}
