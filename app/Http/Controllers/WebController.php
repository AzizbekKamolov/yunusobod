<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DirectionService;
use App\Services\EmployeeService;
use App\Services\PageService;
use App\Services\PartnerService;
use App\Services\SliderService;
use App\Services\SocialNetworkService;
use App\ViewModels\Direction\DirectionViewModel;
use App\ViewModels\Employee\EmployeeViewModel;
use App\ViewModels\Page\PageViewModel;
use App\ViewModels\Partner\PartnerViewModel;
use App\ViewModels\Slider\SliderViewModel;
use App\ViewModels\SocialNetwork\SocialNetworkViewModel;
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
        $page = $this->service->getPage('activity');
        $item = PageViewModel::fromDataObject($page);
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.activity', compact('socialNetworks', 'item'));
    }

    public function statistics(): View
    {
        $page = $this->service->getPage('statistics');
        $item = PageViewModel::fromDataObject($page);
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.statistics', compact('socialNetworks', 'item'));
    }

    public function partners(): View
    {
        $page = $this->service->getPage('our_partners');
        $item = PageViewModel::fromDataObject($page);
        $partners = (new PartnerService())->getAllPartners()->transform(fn($data) => PartnerViewModel::fromDataObject($data));
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.partners', compact('socialNetworks', 'item', 'partners'));
    }

    public function contact(): View
    {
        $page = $this->service->getPage('contact_us');
        $item = PageViewModel::fromDataObject($page);
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        return view('web.pages.contact', compact('socialNetworks', 'item'));
    }

    public function ourTeams(): View
    {
        $page = $this->service->getPage('our_teams');
        $item = PageViewModel::fromDataObject($page);
        $socialNetworks = $this->networkService->getAllSocialNetworks()->transform(fn($socialNetwork) => SocialNetworkViewModel::fromDataObject($socialNetwork));

        $employees = $this->employeeService->getAllEmployees()->transform(fn($employee) => EmployeeViewModel::fromDataObject($employee));
        $directions = $this->directionService->getAllDirections()->transform(fn($direction) => DirectionViewModel::fromDataObject($direction));
        return view('web.pages.our_teams', compact('employees', 'directions', 'socialNetworks', 'item'));
    }
}
