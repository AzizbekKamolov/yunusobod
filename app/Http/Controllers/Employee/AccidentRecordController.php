<?php

namespace App\Http\Controllers\Employee;

use Akbarali\ViewModel\PaginationViewModel;
use App\DataObjects\Accident\AccidentType\AccidentTypeData;
use App\Http\Controllers\Controller;
use App\Services\Accident\AccidentTypeService;
use App\Services\Employee\AccidentRecordService;
use App\ViewModels\Accident\AccidentType\AccidentTypeViewModel;
use App\ViewModels\Employees\Accident\AccidentRecordViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccidentRecordController extends Controller
{
    public function __construct(
        protected AccidentRecordService $service,
        protected AccidentTypeService $typeService,
    )
    {
    }

    public function index(Request $request):View
    {
        $types = $this->typeService->getAccidentTypes()->transform(fn(AccidentTypeData $data) => AccidentTypeViewModel::fromDataObject($data));
        $records = $this->service->getEmployeeProducts();
        return ( new PaginationViewModel($records,AccidentRecordViewModel::class))
            ->toView('employee.accident.index',compact('types'));
    }
}
