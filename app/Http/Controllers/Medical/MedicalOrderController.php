<?php

namespace App\Http\Controllers\Medical;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Medical\MedicalOrder\CreateMedicalOrderActionData;
use App\ActionData\Medical\MedicalOrder\UpdateMedicalOrderActionData;
use App\DataObjects\Branch\BranchData;
use App\DataObjects\Department\DepartmentData;
use App\DataObjects\Employee\EmployeeData;
use App\DataObjects\Employee\EmployeeWithMedicalResultData;
use App\DataObjects\Medical\MedicalStatus\MedicalStatusData;
use App\DataObjects\Position\PositionData;
use App\Exports\Medical\MedicalOrderExport;
use App\Filters\Employee\EmployeeFilter;
use App\Http\Controllers\Controller;
use App\Services\BranchService;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\FileService;
use App\Services\Medical\MedicalOrder\MedicalOrderService;
use App\Services\Medical\MedicalStatus\MedicalStatusService;
use App\Services\PositionService;
use App\ViewModels\Admin\Branch\BranchViewModel;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use App\ViewModels\Admin\Position\PositionViewModel;
use App\ViewModels\Employee\EmployeeViewModel;
use App\ViewModels\Employee\EmployeeWithMedicalResultViewModel;
use App\ViewModels\Medical\MedicalOrder\MedicalOrderViewModel;
use App\ViewModels\Medical\MedicalOrder\UpdateMedicalOrderViewModel;
use App\ViewModels\Medical\MedicalStatus\MedicalStatusViewModel;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class MedicalOrderController extends Controller
{
    public function __construct(
        protected MedicalOrderService  $service,
        protected EmployeeService      $employeeService,
        protected BranchService        $branchService,
        protected PositionService      $positionService,
        protected DepartmentService    $departmentService,
        protected MedicalStatusService $medicalStatusService,
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $collection = $this->service->paginate();
        return (new PaginationViewModel($collection, MedicalOrderViewModel::class))
            ->toView('admin.medical.medicalorder.index');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {


        $departments = $this->departmentService->getDepartments()->transform(fn(DepartmentData $departmentData) => DepartmentViewModel::fromDataObject($departmentData));
        $positions = $this->positionService->getPositions()->transform(fn(PositionData $positionData) => PositionViewModel::fromDataObject($positionData));

        $filters[] = EmployeeFilter::getRequest($request);
        $employees = $this->employeeService->paginate((int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        $viewModel = new PaginationViewModel($employees, EmployeeViewModel::class);
        if ($request->has('employee')){
            return $viewModel
                ->toView('admin.medical.medicalorder.employees', compact('employees', 'departments', 'positions'));
        }
        return $viewModel
            ->toView('admin.medical.medicalorder.create', compact('employees', 'departments', 'positions'));
    }

    /**
     * @param CreateMedicalOrderActionData $actionData
     * @return RedirectResponse
     */
    public function store(CreateMedicalOrderActionData $actionData): RedirectResponse
    {
//        dd($actionData->all());
        $this->service->createMedicalOrder($actionData);
        return redirect()->route('medical.orders.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.medical_orders.medical_order')])
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function edit(Request $request, int $id): View
    {
        $branches = $this->branchService->getBranches()->transform(fn(BranchData $branchData) => BranchViewModel::fromDataObject($branchData));
        $departments = $this->departmentService->getDepartments()->transform(fn(DepartmentData $departmentData) => DepartmentViewModel::fromDataObject($departmentData));
        $positions = $this->positionService->getPositions()->transform(fn(PositionData $positionData) => PositionViewModel::fromDataObject($positionData));

        $filters[] = EmployeeFilter::getRequest($request);
        $allEmployees = $this->employeeService->paginate((int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        $viewModel = new PaginationViewModel($allEmployees, EmployeeViewModel::class);
        $employees = $this->service->getMedicalOrderEmployees($id)->transform(fn($employee) => EmployeeViewModel::fromDataObject($employee));

        $item = UpdateMedicalOrderViewModel::fromDataObject($this->service->edit($id));

        if ($request->has('employee')){
            return $viewModel
                ->toView('admin.medical.medicalorder.employee_edit', compact('employees', 'branches', 'departments', 'positions', 'item'));
        }

        return $viewModel->toView('admin.medical.medicalorder.edit', compact('employees', 'branches', 'departments', 'positions', 'item'));

    }

    /**
     * @param CreateMedicalOrderActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateMedicalOrderActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateMedicalOrder($actionData, $id);
        return redirect()->route('medical.orders.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.medical_orders.medical_order')])
        ]);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteMedicalOrder($id);
        return redirect()->route('medical.orders.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.medical_orders.medical_order')])
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function fileDelete(int $id): RedirectResponse
    {
        $documentId = FileService::fileDelete(diskName: 'medicals', id: $id);
        return redirect()->route('medical.orders.edit', [$documentId])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.documents.document')]),
        ]);
    }

    public function show(int $id)
    {
        $employees = $this->service->getOrderWithEmployees($id);
        $employees = $employees->transform(function (EmployeeWithMedicalResultData $data) {
            return EmployeeWithMedicalResultViewModel::fromDataObject($data);
        });
        $medicalStatuses = $this->medicalStatusService->getMedicalStatuses();

        $medicalStatuses = $medicalStatuses->transform(fn(MedicalStatusData $data) => MedicalStatusViewModel::fromDataObject($data));

        $viewModel =  UpdateMedicalOrderViewModel::fromDataObject($this->service->edit($id));
        return $viewModel->toView('admin.medical.medicalresult.index', compact('employees', 'medicalStatuses'));

    }

    public function export(int $id)
    {
        $medicalOrder = MedicalOrderViewModel::fromDataObject($this->service->edit($id));
        $fileName = "$medicalOrder->content (" . Carbon::now()->format('d-m-Y') . ").xlsx";
        $statuses = $this->medicalStatusService->getMedicalStatuses()->transform(fn(MedicalStatusData $data) => MedicalStatusViewModel::fromDataObject($data));
        $employees = $this->service->getOrderWithEmployees($id)->transform(fn(EmployeeWithMedicalResultData $data) => EmployeeWithMedicalResultViewModel::fromDataObject($data));

         return Excel::download(new MedicalOrderExport($medicalOrder, $employees,$statuses), $fileName);
    }
}
