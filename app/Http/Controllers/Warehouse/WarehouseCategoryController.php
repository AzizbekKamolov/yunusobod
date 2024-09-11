<?php

namespace App\Http\Controllers\Warehouse;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Warehouse\WarehouseCategory\WarehouseCategoryActionData;
use App\DataObjects\Warehouse\WarehouseCategory\WarehouseCategoryData;
use App\Http\Controllers\Controller;
use App\Services\Warehouse\WarehouseCategoryService;
use App\ViewModels\Warehouse\WarehouseCategory\WarehouseCategoryViewModel;
use App\ViewModels\Warehouse\WarehouseCategory\Api\WarehouseCategoryViewModel as ViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class WarehouseCategoryController extends Controller
{

    public function __construct(
        protected WarehouseCategoryService $service
    )
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request):View
    {
        $collection = $this->service->paginate();
//        dd($collection);
        return (new PaginationViewModel($collection, WareHouseCategoryViewModel::class))
            ->toView('admin.warehouse.warehousecategory.index');
    }

    /**
     * @return View
     */
    public function create():View
    {
        return view('admin.warehouse.warehousecategory.create');
    }


    /**
     * @param WarehouseCategoryActionData $actionData
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(WareHouseCategoryActionData $actionData):RedirectResponse
    {
        $this->service->createWareHouseCategory($actionData);
        return redirect()->route('warehouse.warehousecategory.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_create',['attribute' => trans('form.warehouse.warehousecategory')])
        ]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id):View
    {
        $viewModel =  WareHouseCategoryViewModel::fromDataObject($this->service->edit($id));
        return $viewModel->toView('admin.warehouse.warehousecategory.edit');
    }


    /**
     * @param WarehouseCategoryActionData $actionData
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(WareHouseCategoryActionData $actionData, int $id):RedirectResponse
    {
        $this->service->updateWareHouseCategory($actionData, $id);
        return redirect()->route('warehouse.warehousecategory.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_update',['attribute' => trans('form.warehouse.warehousecategory')])
        ]);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id):RedirectResponse
    {
        $item = $this->service->deleteWareHouseCategory($id);
        if (!$item) {
            return redirect()->route('warehouse.warehousecategory.index')->with('res',[
                'method' => 'error',
                'msg' => trans('form.failed_delete')
            ]);
        }
        return redirect()->route('warehouse.warehousecategory.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_delete',['attribute' => trans('form.warehouse.warehousecategory')])
        ]);
    }

    public function all():JsonResponse
    {
        $categories = $this->service->getWareHouseCategories()->transform(fn(WarehouseCategoryData $data) => ViewModel::fromDataObject($data));
        $categories = $categories->transform(function ($category){
            return [
                'y' => $category->y,
                'name' => $category->hname,

            ];
        });
        return response()->json($categories);
    }
}
