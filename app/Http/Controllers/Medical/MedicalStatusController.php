<?php

namespace App\Http\Controllers\Medical;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Medical\MedicalStatus\CreateMedicalStatusActionData;
use App\DataObjects\Medical\MedicalStatus\MedicalStatusData;
use App\Http\Controllers\Controller;
use App\Models\MedicalStatus;
use App\Services\Medical\MedicalStatus\MedicalStatusService;
use App\ViewModels\Medical\MedicalStatus\MedicalStatusViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MedicalStatusController extends Controller
{


    public function __construct(
        protected MedicalStatusService $service
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
        return (new PaginationViewModel($collection, MedicalStatusViewModel::class))
            ->toView('admin.medical.medicalstatus.index');
    }

    /**
     * @return View
     */
    public function create():View
    {
        return view('admin.medical.medicalstatus.create');
    }

    /**
     * @param CreateMedicalStatusActionData $actionData
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(CreateMedicalStatusActionData $actionData):RedirectResponse
    {
        $this->service->createMedicalStatus($actionData);
        return redirect()->route('medical.statuses.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_create',['attribute' => trans('form.medical.medical_status')])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalStatus $medicalStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id):View
    {
        $viewModel =  MedicalStatusViewModel::fromDataObject($this->service->edit($id));
        return $viewModel->toView('admin.medical.medicalstatus.edit');
    }

    /**
     * @param CreateMedicalStatusActionData $actionData
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(CreateMedicalStatusActionData $actionData, int $id):RedirectResponse
    {
        $this->service->updateMedicalStatus($actionData, $id);
        return redirect()->route('medical.statuses.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_update',['attribute' => trans('form.medical.medical_status')])
        ]);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id):RedirectResponse
    {
        $item = $this->service->deleteMedicalStatus($id);
        if(!$item){
            return redirect()->route('medical.statuses.index')->with('res',[
                'method' => 'error',
                'msg' => trans('form.failed_delete')
            ]);
        }
        return redirect()->route('medical.statuses.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_delete',['attribute' => trans('form.medical.medical_status')])
        ]);
    }
}
