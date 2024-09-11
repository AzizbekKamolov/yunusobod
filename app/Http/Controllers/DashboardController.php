<?php
declare(strict_types=1);
namespace App\Http\Controllers;


use App\DataObjects\Accident\AccidentType\AccidentTypeWithCountData;
use App\Services\Accident\AccidentTypeService;
use App\Services\EmployeeService;
use App\Services\Medical\MedicalOrder\MedicalOrderService;
use App\Services\Quiz\ExamService;
use App\ViewModels\Accident\AccidentType\AccidentTypeWithCountViewModel;
use App\ViewModels\Medical\MedicalOrder\MedicalOrderViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __construct
    (
        protected EmployeeService $employeeService,
        protected AccidentTypeService $accidentTypeService,
        protected MedicalOrderService $medicalOrderService,
        protected ExamService  $examService,
    )
    {

    }
    public function index():View
    {
        $employeesCount = $this->employeeService->employeesCount();
        $accidentTypes  = $this->accidentTypeService->getTypesWithCount()->transform(fn(AccidentTypeWithCountData $data) => AccidentTypeWithCountViewModel::fromDataObject($data));
        $exams = $this->examService->all();
        if ($this->medicalOrderService->lastMedicalOrder() != null){

            $medicalOrder = MedicalOrderViewModel::fromDataObject( $this->medicalOrderService->lastMedicalOrder());
            return view('dashboard.dashboard',compact('employeesCount','accidentTypes','exams','medicalOrder'));
        }
        return view('dashboard.dashboard',compact('employeesCount','accidentTypes','exams'));

    }

    public function changeLang($lang):RedirectResponse

    {

        if (in_array($lang, config('app.locales'),true))
        {
            Session::put('locale', $lang);
            app()->setLocale($lang);
        }
        return redirect()->back();
    }
}
