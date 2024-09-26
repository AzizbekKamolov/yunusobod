<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Direction\CreateEmployeeActionData;
use App\ActionData\Direction\UpdateEmployeeActionData;
use App\Services\DirectionService;
use App\ViewModels\Direction\EmployeeViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DirectionController extends Controller
{
    public function __construct(protected DirectionService $service)
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
        return (new PaginationViewModel($collection, EmployeeViewModel::class))->toView('admin.directions.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $viewModel = EmployeeViewModel::createEmpty();
        return $viewModel->toView('admin.directions.create');
    }

    /**
     * @param CreateEmployeeActionData $actionData
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(CreateEmployeeActionData $actionData): RedirectResponse
    {
        $this->service->createDirection($actionData);
        return redirect()->route('directions.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('form.directions.directions')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function setOrder(int $id): RedirectResponse
    {
        $this->service->setOrder($id);
        return redirect()->route('directions.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.directions.directions')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->service->getDirection($id);
        $viewModel = EmployeeViewModel::fromDataObject($data);

        return $viewModel->toView('admin.directions.edit');
    }

    /**
     * @param UpdateEmployeeActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateEmployeeActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateDirection($actionData, $id);
        return redirect()->route('directions.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.directions.slider')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteDirection($id);
        return redirect()->route('directions.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('form.directions.direction')]));
    }
}
