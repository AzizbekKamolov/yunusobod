<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SliderService;
use App\ViewModels\Slider\SliderViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebController extends Controller
{
    public function home(): View
    {
        $sliders = (new SliderService())->getAllSliders()->transform(fn ($slider) => SliderViewModel::fromDataObject($slider));
        return view('web.home', compact('sliders'));
    }
}
