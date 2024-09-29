<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DirectionService;
use App\Services\EmployeeService;
use App\Services\SliderService;
use App\ViewModels\Direction\DirectionViewModel;
use App\ViewModels\Employee\EmployeeViewModel;
use App\ViewModels\Slider\SliderViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebController extends Controller
{
    public function home(): View
    {
        $sliders = (new SliderService())->getAllSliders()->transform(fn($slider) => SliderViewModel::fromDataObject($slider));
        return view('web.home', compact('sliders'));
    }

    public function about(): View
    {
        return view('web.pages.about');
    }
    public function activity(): View
    {
        return view('web.pages.about');
    }
    public function statistics(): View
    {
        return view('web.pages.about');
    }
    public function partners(): View
    {
        return view('web.pages.about');
    }
    public function contact(): View
    {
        return view('web.pages.contact');
    }

    public function ourTeams(): View
    {
        $employees = (new EmployeeService())->getAllEmployees()->transform(fn($employee) => EmployeeViewModel::fromDataObject($employee));
        $directions = (new DirectionService())->getAllDirections()->transform(fn($direction) => DirectionViewModel::fromDataObject($direction));
        return view('web.pages.our_teams', compact('employees', 'directions'));
    }
}
