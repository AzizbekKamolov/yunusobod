<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DirectionService;
use App\Services\EmployeeService;
use App\Services\PageService;
use App\Services\SliderService;
use App\Services\SocialNetworkService;
use App\ViewModels\Direction\DirectionViewModel;
use App\ViewModels\Employee\EmployeeViewModel;
use App\ViewModels\Page\PageViewModel;
use App\ViewModels\Slider\SliderViewModel;
use App\ViewModels\SocialNetwork\SocialNetworkViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebController extends Controller
{
    public function __construct(
        protected PageService          $service,
        protected DirectionService     $directionService,
        protected EmployeeService      $employeeService,
        protected SocialNetworkService $networkService,
    )
    {
    }

    public function home(): View
    {
        $sliders = (new SliderService())->getAllSliders()->transform(fn($slider) => SliderViewModel::fromDataObject($slider));
        $directions = $this->directionService->getAllDirections()->transform(fn($direction) => DirectionViewModel::fromDataObject($direction));
        $employees = $this->employeeService->getAllEmployees(3)->transform(fn($employee) => EmployeeViewModel::fromDataObject($employee));
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.home', compact('sliders', 'directions', 'employees', 'socialNetworks'));
    }

    /**
     * @return View
     */
    public function about(): View
    {
        $page = $this->service->getPage();
        $item = PageViewModel::fromDataObject($page);
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.about', compact('item', 'socialNetworks'));
    }

    public function activity(): View
    {
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.contact', compact('socialNetworks'));
    }

    public function statistics(): View
    {
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.contact', compact('socialNetworks'));
    }

    public function partners(): View
    {
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.contact', compact('socialNetworks'));
    }

    public function contact(): View
    {
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.contact', compact('socialNetworks'));
    }

    public function ourTeams(): View
    {
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        $employees = $this->employeeService->getAllEmployees()->transform(fn($employee) => EmployeeViewModel::fromDataObject($employee));
        $directions = $this->directionService->getAllDirections()->transform(fn($direction) => DirectionViewModel::fromDataObject($direction));
        return view('web.pages.our_teams', compact('employees', 'directions', 'socialNetworks'));
    }
}
