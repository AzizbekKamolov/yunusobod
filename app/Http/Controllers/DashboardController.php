<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\RequestModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __construct
    ()
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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function feedback(Request $request): RedirectResponse
    {
        $data = $request->validate([
            "fio" => "required",
            "email" => "required|email",
            "phone" => "required|max:20",
            "title" => "required|max:255",
            "content" => "required|max:255",
        ]);
        RequestModel::query()->create($data);
        return redirect()->back()->with("success", trans('web.feedback'));
    }
}
