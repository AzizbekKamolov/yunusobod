<?php
declare(strict_types=1);
namespace App\Http\Controllers\Medical;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Medical\MrdicalResult\CreateMedicalResultActionData;
use App\ActionData\Medical\MrdicalResult\UpdateMedicalResultActionData;
use App\Http\Controllers\Controller;
use App\Services\FileService;
use App\Services\Medical\MedicalOrder\MedicalOrderService;
use App\Services\Medical\MedicalResult\MedicalResultService;
use App\ViewModels\Medical\MedicalResult\MedicalResultViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicalResultController extends Controller
{
    public function __construct(
        protected MedicalResultService $service,
        protected MedicalOrderService $medicalOrderService,
    )
    {
    }

    /**
     * @param CreateMedicalResultActionData $actionData
     * @return RedirectResponse
     */
    public function store(CreateMedicalResultActionData $actionData): RedirectResponse
    {
        $this->service->createMedicalResult($actionData);
        return redirect()->route('medical.orders.show',[$actionData->medical_order_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.medical.medical_results')])
        ]);
    }


    /**
     * @param UpdateMedicalResultActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateMedicalResultActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateMedicalResult($actionData, $id);
        return redirect()->route('medical.orders.show',[$actionData->medical_order_id])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.medical.medical_results')])
        ]);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function fileDelete(int $id): RedirectResponse
    {
        $documentId = FileService::fileDelete(diskName: 'medicals',id: $id);
        $medicalOrder = ($this->service->getMedicalResult($documentId))->medical_order_id;
        return redirect()->route('medical.orders.show',[$medicalOrder])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('validation.attributes.file')])
        ]);
    }
}
