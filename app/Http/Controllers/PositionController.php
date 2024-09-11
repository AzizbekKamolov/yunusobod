<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Position\CreatePositionActionData;
use App\DataObjects\Department\DepartmentData;
use App\DataObjects\Position\PositionData;
use App\Exceptions\OperationException;
use App\Models\Position;
use App\Services\DepartmentService;
use App\Services\PositionService;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use App\ViewModels\Admin\Position\PositionViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct(
        protected PositionService   $service,
        protected DepartmentService $departmentService,
    )
    {

    }

    public function index(Request $request): View
    {
        $filters = [];
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, PositionViewModel::class))->toView('admin.positions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $departments = $this->departmentService->getDepartments()->transform(fn(DepartmentData $data) => DepartmentViewModel::fromDataObject($data));
        return view('admin.positions.create', compact('departments'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $actionData = CreatePositionActionData::createFromRequest($request);
        $this->service->createPosition($actionData);
        return redirect()->route('positions.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.positions.position')]),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $position = Position::query()->with('department')->findOrFail($id);

        $departments = $this->departmentService->getDepartments()->transform(fn(DepartmentData $data) => DepartmentViewModel::fromDataObject($data));

        $viewModel = new PositionViewModel(PositionData::fromModel($position));

        return $viewModel->toView('admin.positions.edit', compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     * @throws OperationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $actionData = CreatePositionActionData::createFromRequest($request);
        $this->service->updatePosition($actionData, $id);
        return redirect()->route('positions.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.positions.position')]),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id):RedirectResponse
    {
        $this->service->deletePosition($id);
        return redirect()->route('positions.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.positions.position')]),
        ]);
    }
}
