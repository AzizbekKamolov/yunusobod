<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __construct
    (
    )
    {

    }

    public function index(): View
    {

        return view('dashboard.dashboard');

    }

    /**
     * @param string $lang
     * @return RedirectResponse
     */
    public function changeLang(string $lang): RedirectResponse
    {
        if (in_array($lang, config('app.languages'))) {
            Session::put('locale', $lang);
            app()->setLocale($lang);
        }
        return redirect()->back();
    }
}
