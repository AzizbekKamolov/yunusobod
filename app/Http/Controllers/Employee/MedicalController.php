<?php

namespace App\Http\Controllers\Employee;

use Akbarali\ViewModel\PaginationViewModel;
use App\DataObjects\Medical\MedicalStatus\MedicalStatusData;
use App\Http\Controllers\Controller;
use App\Services\Employee\MedicalService;
use App\Services\Medical\MedicalStatus\MedicalStatusService;
use App\ViewModels\Employees\Medical\MedicalOrderViewModel;
use App\ViewModels\Medical\MedicalStatus\MedicalStatusViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicalController extends Controller
{
    public function __construct(
        protected MedicalService       $service,
        protected MedicalStatusService $medicalStatusService,
    )
    {
    }

    public function index(Request $request): View
    {
        $medical_orders = $this->service->getmedicalOrders();
        $medical_statuses = $this->medicalStatusService->getMedicalStatuses()->transform(fn(MedicalStatusData $data) => MedicalStatusViewModel::fromDataObject($data));
        return (new PaginationViewModel($medical_orders, MedicalOrderViewModel::class))
            ->toView('employee.medical.index',compact('medical_statuses'));
    }
}
