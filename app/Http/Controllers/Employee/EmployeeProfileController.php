<?php

namespace App\Http\Controllers\Employee;

use Akbarali\ActionData\ActionDataException;
use App\ActionData\Employees\EmployeeProfile\UpdateEmployeeActionData;
use App\Http\Controllers\Controller;
use App\Services\EmployeeService;
use App\ViewModels\Employee\EmployeeViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use function App\Helpers\employee;

class EmployeeProfileController extends Controller
{
    public function __construct(
        protected EmployeeService $service,
    )
    {
    }

    public function index():View
    {
        $id =  employee()->id;
        $viewModel = EmployeeViewModel::fromDataObject($this->service->edit($id));
        return $viewModel->toView('employee.profile.profile');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ActionDataException
     * @throws ValidationException
     */
    public function edit(Request $request):RedirectResponse
    {
        $id =  employee()->id;
        $this->service->updateProfile(UpdateEmployeeActionData::createFromRequest($request),$id);
        return to_route('profile.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_update',['attribute' => trans('form.employees.employee')])
        ]);
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

    public function logout(Request $request): RedirectResponse
    {
        auth('employee')->logout();
        return to_route('login')->with('res', [
            'method' => 'success',
            'msg' => trans('messages.auth.logout')
        ]);
    }
}
