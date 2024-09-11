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

        return view('dashboard.dashboard');

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
