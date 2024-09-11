<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ActionData\ActionDataException;
use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Employee\CreateEmployeeActionData;
use App\ActionData\Employee\ImportEmployeeActionData;
use App\ActionData\Employee\UpdateEmployeeActionData;
use App\DataObjects\Branch\BranchData;
use App\DataObjects\Department\DepartmentData;
use App\DataObjects\Employee\EmployeeData;
use App\DataObjects\Position\PositionData;
use App\Exceptions\OperationException;
use App\Exports\Employee\EmployeeExport;
use App\Filters\Employee\EmployeeFilter;
use App\Filters\Employee\EmployeeSearchFilter;
use App\Imports\Employee\EmployeeImport;
use App\Models\Employee;
use App\Services\BranchService;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\FileService;
use App\Services\PositionService;
use App\ViewModels\Admin\Branch\BranchViewModel;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use App\ViewModels\Admin\Position\PositionViewModel;
use App\ViewModels\Employee\EmployeeViewModel;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{

    function __construct(
        protected EmployeeService   $service,
        protected PositionService   $positionService,
        protected BranchService     $branchService,
        protected DepartmentService $departmentService,
    )
    {

    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $branches = $this->branchService->getBranches()->transform(fn(BranchData $branchData) => BranchViewModel::fromDataObject($branchData));
        $positions = $this->positionService->getPositions()->transform(fn(PositionData $positionData) => PositionViewModel::fromDataObject($positionData));
        $departments = $this->departmentService->getDepartments()->transform(fn(DepartmentData $departmentData) => DepartmentViewModel::fromDataObject($departmentData));
        $filters[] = EmployeeFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        return (new PaginationViewModel($collection, EmployeeViewModel::class))->toView('admin.employees.index', compact('branches', 'positions', 'departments'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $branches = $this->branchService->getBranches()->transform(fn(BranchData $branchData) => BranchViewModel::fromDataObject($branchData));
        $positions = $this->positionService->getPositions()->transform(fn(PositionData $positionData) => PositionViewModel::fromDataObject($positionData));
        return view('admin.employees.create', compact('branches', 'positions'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws ActionDataException
     */
    public function store(Request $request): RedirectResponse
    {
        $actionData = CreateEmployeeActionData::createFromRequest($request);
        $this->service->createEmployee($actionData);
        return redirect()->route('employees.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.employees.employee')]),
        ]);
    }


    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $branches = $this->branchService->getBranches()->transform(fn(BranchData $branchData) => BranchViewModel::fromDataObject($branchData));
        $positions = $this->positionService->getPositions()->transform(fn(PositionData $positionData) => PositionViewModel::fromDataObject($positionData));
        $employee = new EmployeeViewModel(EmployeeData::createFromEloquentModel($this->service->getEmployee($id)));
        return view('admin.employees.edit', compact('employee', 'branches', 'positions'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ActionDataException
     * @throws ValidationException
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $actionData = UpdateEmployeeActionData::createFromRequest($request);
        $this->service->updateEmployee($actionData, $id);
        return redirect()->route('employees.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.employees.employee')]),
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws OperationException
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteEmployee($id);
        return redirect()->route('employees.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.employees.employee')]),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        $filters[] = EmployeeSearchFilter::getRequest($request);
        $employees = $this->service->getEmployees(filters: $filters);
        $employees->transform(fn($employee) => EmployeeViewModel::fromDataObject($employee));
        return response()->json($employees->toArray());
    }

    public function export(Request $request)
    {
        $filters[] = EmployeeFilter::getRequest($request);
        $employees = $this->service->getEmployees(filters: $filters)->transform(fn(EmployeeData $data) => EmployeeViewModel::fromDataObject($data));
        $fileName = trans('form.employees.employees') . "(" . Carbon::now()->format('d-m-Y') . ").xlsx";
        return Excel::download(new EmployeeExport($employees), $fileName);

    }

    /**
     * @param ImportEmployeeActionData $actionData
     * @return RedirectResponse
     */
    public function import(ImportEmployeeActionData $actionData):RedirectResponse
    {
        $this->service->import($actionData);
        $this->service->importToJob();
        return redirect()->route('employees.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_import', ['attribute' => trans('form.employees.employee')]),
        ]);
    }
    public function fileDelete(int $id): RedirectResponse
    {
        $documentId = FileService::fileDelete(diskName: 'profile',id: $id);
        return redirect()->route('employees.edit',[$documentId])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('validation.attributes.file')])
        ]);
    }
}
