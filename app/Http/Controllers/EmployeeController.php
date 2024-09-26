<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Employee\CreateEmployeeActionData;
use App\ActionData\Employee\UpdateEmployeeActionData;
use App\Services\DirectionService;
use App\Services\EmployeeService;
use App\ViewModels\Direction\DirectionViewModel;
use App\ViewModels\Employee\EmployeeViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters = [];
//        $filters[] = PermissionsFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        return (new PaginationViewModel($collection, EmployeeViewModel::class))->toView('admin.employees.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $directions = (new DirectionService())->getAllDirections()->transform(fn($data) => DirectionViewModel::fromDataObject($data));
        $viewModel = EmployeeViewModel::createEmpty();
        return $viewModel->toView('admin.employees.create', compact('directions'));
    }

    /**
     * @param CreateEmployeeActionData $actionData
     * @return RedirectResponse
     */
    public function store(CreateEmployeeActionData $actionData): RedirectResponse
    {
        $this->service->createEmployee($actionData);
        return redirect()->route('employees.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('form.employees.employees')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function setOrder(int $id): RedirectResponse
    {
        $this->service->setOrder($id);
        return redirect()->route('employees.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.employees.employees')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $directions = (new DirectionService())->getAllDirections()->transform(fn($data) => DirectionViewModel::fromDataObject($data));
        $data = $this->service->getEmployee($id);
        $viewModel = EmployeeViewModel::fromDataObject($data);
        return $viewModel->toView('admin.employees.edit', compact('directions'));
    }

    /**
     * @param UpdateEmployeeActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateEmployeeActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateEmployee($actionData, $id);
        return redirect()->route('employees.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.employees.slider')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteEmployee($id);
        return redirect()->route('employees.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('form.employees.direction')]));
    }
}
