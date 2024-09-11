<?php

namespace App\Http\Controllers\Accident;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Accident\AccidentType\CreateAccidentTypeActionData;
use App\Http\Controllers\Controller;
use App\Services\Accident\AccidentTypeService;
use App\ViewModels\Accident\AccidentType\AccidentTypeViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AccidentTypeController extends Controller
{
    public function __construct(
        protected AccidentTypeService $service
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
        return (new PaginationViewModel($collection, AccidentTypeViewModel::class))
            ->toView('admin.accident.accidenttype.index');
    }

    /**
     * @return View
     */
    public function create():View
    {
        return view('admin.accident.accidenttype.create');
    }

    /**
     * @param CreateAccidentTypeActionData $actionData
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(CreateAccidentTypeActionData $actionData):RedirectResponse
    {
        $this->service->createAccidentType($actionData);
        return redirect()->route('accident.accidenttype.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_create',['attribute' => trans('form.accident.accidenttype')])
        ]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id):View
    {
        $viewModel = AccidentTypeViewModel::fromDataObject($this->service->edit($id));
        return $viewModel->toView('admin.accident.accidenttype.edit');
    }

    /**
     * @param CreateAccidentTypeActionData $actionData
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(CreateAccidentTypeActionData $actionData, int $id):RedirectResponse
    {
        $this->service->updateAccidentType($actionData, $id);
        return redirect()->route('accident.accidenttype.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_update',['attribute' => trans('form.accident.accidenttype')])
        ]);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id):RedirectResponse
    {
        $this->service->deleteAccidentType($id);
        return redirect()->route('accident.accidenttype.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_delete',['attribute' => trans('form.accident.accidenttype')])
        ]);
    }
}
