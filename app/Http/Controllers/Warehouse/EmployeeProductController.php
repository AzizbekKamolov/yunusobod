<?php

namespace App\Http\Controllers\Warehouse;

use App\ActionData\Warehouse\EmployeeProduct\EmployeeProductActionData;
use App\Http\Controllers\Controller;
use App\Services\Warehouse\EmployeeProductService;
use App\Services\Warehouse\WarehouseService;
use Illuminate\Http\RedirectResponse;

class EmployeeProductController extends Controller
{
    public function __construct(
        protected EmployeeProductService $service,
        protected WareHouseService $warehouseService
    )
    {
    }
    public function store(EmployeeProductActionData $actionData): RedirectResponse
    {
        if (
            !$this->service->createEmployeeProduct($actionData)
        ){
            return redirect()->route('warehouse.show',[$actionData->warehouse_id])->with('res', [
                'method' => 'error',
                'msg' => trans('messages.quantity_error')
            ]);
        }
        return redirect()->route('warehouse.show',[$actionData->warehouse_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.warehouse.employee_product')
        ]);
    }

    public function update(EmployeeProductActionData $actionData, int $id): RedirectResponse
    {
        if(
            !$this->service->updateEmployeeProduct($actionData, $id)
        )
        {
            return redirect()->route('warehouse.show',[$actionData->warehouse_id])->with('res', [
                'method' => 'error',
                'msg' => trans('messages.quantity_error')
            ]);
        }
        return redirect()->route('warehouse.show',[$actionData->warehouse_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.warehouse.employee_product')
        ]);

    }
    public function delete(int $id): RedirectResponse
    {
        $warehouse_id = $this->service->delete($id);
        return redirect()->route('warehouse.show',[$warehouse_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.warehouse.employee_product')])
        ]);
    }
}
