<?php

namespace App\Http\Controllers\Employee;

use Akbarali\ViewModel\PaginationViewModel;
use App\Http\Controllers\Controller;
use App\Services\Employee\WarehouseService;
use App\Services\Warehouse\WarehouseCategoryService;
use App\ViewModels\Employees\Warehouse\EmployeeProductViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WarehouseController extends Controller
{
    public function __construct(
        protected WarehouseService $service,
    )
    {
    }

    public function index(Request $request):View
    {
        $employee_products = $this->service->getEmployeeProducts();
        return (new PaginationViewModel($employee_products,EmployeeProductViewModel::class))
            ->toView('employee.warehouse.index');
    }
}
