<?php

namespace App\Http\Controllers\Warehouse;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Warehouse\Warehouse\ExportWarehouseActionData;
use App\ActionData\Warehouse\Warehouse\WarehouseActionData;
use App\DataObjects\Warehouse\EmployeeProduct\EmployeeProductData;
use App\DataObjects\Warehouse\Warehouse\WarehouseData;
use App\DataObjects\Warehouse\WarehouseCategory\WarehouseCategoryData;
use App\Exports\Warehouse\EmployeeProductExport;
use App\Exports\Warehouse\WarehouseExport;
use App\Filters\Warehouse\WarehouseFilter;
use App\Http\Controllers\Controller;
use App\Services\EmployeeService;
use App\Services\Warehouse\EmployeeProductService;
use App\Services\Warehouse\WarehouseCategoryService;
use App\Services\Warehouse\WarehouseService;
use App\ViewModels\Warehouse\EmployeeProduct\EmployeeProductViewModel;
use App\ViewModels\Warehouse\Warehouse\WarehouseViewModel;
use App\ViewModels\Warehouse\WarehouseCategory\WarehouseCategoryViewModel;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class WarehouseController extends Controller
{
    public function __construct(
        protected WarehouseCategoryService $categoryService,
        protected WarehouseService         $service,
        protected  EmployeeService         $employeeService,
        protected EmployeeProductService   $employeeProductService,
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters = [];
        $filters[] = WarehouseFilter::getRequest($request);
        $categories = $this->categoryService->getWareHouseCategories()->transform(fn(WarehouseCategoryData $data) => WarehouseCategoryViewModel::fromDataObject($data));
        $collection = $this->service->paginate(page: $request->query('page',1),limit: $request->query('limit',15), filters: $filters);
        return (new PaginationViewModel($collection, WareHouseViewModel::class))
            ->toView('admin.warehouse.warehouse.index',compact('categories'));
    }
    /**
     * @return View
     */
    public function create(): View
    {
        $categories = $this->categoryService->getWareHouseCategories()->transform(fn(WarehouseCategoryData $data) => WarehouseCategoryViewModel::fromDataObject($data));
        return view('admin.warehouse.warehouse.create', compact('categories'));
    }

    /**
     * @param WarehouseActionData $actionData
     * @return RedirectResponse
     */
    public function store(WareHouseActionData $actionData): RedirectResponse
    {
        $this->service->createWareHouse($actionData);
        return redirect()->route('warehouse.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.warehouse.warehouse')])
        ]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $categories = $this->categoryService->getWareHouseCategories()->transform(fn(WarehouseCategoryData $data) => WarehouseCategoryViewModel::fromDataObject($data));
        $viewModel = WareHouseViewModel::fromDataObject($this->service->edit($id));
        return $viewModel->toView('admin.warehouse.warehouse.edit', compact('categories'));
    }

    /**
     * @param WarehouseActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(WareHouseActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateWareHouse($actionData, $id);
        return redirect()->route('warehouse.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.warehouse.warehouse')])
        ]);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteWareHouse($id);
        return redirect()->route('warehouse.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.warehouse.warehouse')])
        ]);
    }

    public function show(int $id):View
    {
        $viewModel = WareHouseViewModel::fromDataObject($this->service->edit($id));
        $employee_products =  $this->employeeProductService->getEmployeeProductsById($id)->transform(fn(EmployeeProductData $data) => EmployeeProductViewModel::fromDataObject($data));
        return $viewModel->toView('admin.warehouse.warehouse.show',compact('employee_products'));
    }

    public function export(ExportWarehouseActionData $actionData)
    {
        $warehouses = $this->service->exportWarehouses($actionData)->transform(fn(WarehouseData $data) => WarehouseViewModel::fromDataObject($data));
        $fileName = trans('form.warehouse.products')."(" . Carbon::now()->format('d-m-Y') . ").xlsx";
        return Excel::download(new WarehouseExport($warehouses),$fileName);
    }

    public function exportProductEmployees(int $id){
        $viewModel = WareHouseViewModel::fromDataObject($this->service->edit($id));
        $employee_products =  $this->employeeProductService->getEmployeeProductsById($id)
            ->transform(fn(EmployeeProductData $data) => EmployeeProductViewModel::fromDataObject($data));
        $fileName = $viewModel->hname."(" . Carbon::now()->format('d-m-Y') . ").xlsx";
        return Excel::download(new EmployeeProductExport($employee_products), $fileName);
    }
}
