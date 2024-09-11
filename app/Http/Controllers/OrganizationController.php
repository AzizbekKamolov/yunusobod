<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\DataObjects\Organization\OrganizationData;
use App\Exceptions\OperationException;
use App\Models\Organization;
use App\ViewModels\Admin\Organization\OrganizationViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\OrganizationService;
use App\ActionData\Organization\CreateOrganizationActionData;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        protected OrganizationService $service
    ) {
    }
    public function index()
    {
        $organizations = $this->service->paginate();
        return (new PaginationViewModel($organizations,OrganizationViewModel::class))->toView('admin.organizations.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('admin.organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws OperationException
     * @throws ValidationException
     */
    public function store(Request $request):RedirectResponse
    {
        // dd($request);
        $organization = $this->service->createOrganization(CreateOrganizationActionData::createFromRequest($request));
        return redirect()->route('organizations.index')->with('res', [
            "method" => "success",
            "msg" =>  trans('form.success_create',['attribute' => trans('form.organizations.organization')]),
        ]);
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id):View
    {
        $organization = $this->service->edit($id);
        $viewModel =  OrganizationViewModel::fromDataObject($organization);
       return $viewModel->toView('admin.organizations.edit');
    }

    /**
     * @throws OperationException
     * @throws ValidationException
     */
    public function update(Request $request, int $id):RedirectResponse
    {
        $this->service->updateOrganization(CreateOrganizationActionData::createFromRequest($request),$id);
        return redirect()->route('organizations.index')->with('res', [
            "method" => "success",
            "msg" =>  trans('form.success_update',['attribute' => trans('form.organizations.organization')]),
        ]);
    }

    /**
     * @throws OperationException
     */
    public function delete(int $id):RedirectResponse
    {
        if(!$this->service->deleteOrganization($id)){
            return redirect()->route('organizations.index')->with('res', [
                "method" => "success",
                "msg" =>  trans('form.success_delete',['attribute' => trans('form.organizations.organization')]),
            ]);
        }
        return redirect()->route('organizations.index')->with('res', [
            "method" => "success",
            "msg" =>  trans('form.success_delete',['attribute' => trans('form.organizations.organization')]),
        ]);
    }
}
