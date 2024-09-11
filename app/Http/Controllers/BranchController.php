<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\Exceptions\OperationException;
use App\Models\Branch;
use App\ViewModels\Admin\Branch\BranchViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\BranchService;
use App\ActionData\Branch\CreateBranchActionData;
use App\Filters\Branch\BranchFilter;
use App\Models\Organization;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(protected BranchService $service){

    }
    public function index(Request $request):View
    {
        $filters = [];
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, BranchViewModel::class))->toView('admin.branches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $organizations = Organization::all();
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request):RedirectResponse
    {
        $actionData = CreateBranchActionData::createFromRequest($request);
        $this->service->createBranch($actionData);
        return redirect()->route('branches.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_create',['attribute' => trans('form.branches.branch')]),
        ]);

    }

    public function show(Branch $branch)
    {
        //
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id):View
    {
        $branch = Branch::query()->find($id);
        $organizations = Organization::all();
        return view('admin.branches.edit',compact('branch', 'organizations')  );
    }

    /**
     * Update the specified resource in storage.
     * @throws OperationException
     * @throws ValidationException
     */
    public function update(Request $request ,int $id ):RedirectResponse
    {
        $actionData = CreateBranchActionData::createFromRequest($request);
        $this->service->updateBranch($actionData ,$id);
        return redirect()->route('branches.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_update',['attribute' => trans('form.branches.branch')]),
        ]);
    }


    /**
     * @throws OperationException
     */
    public function delete(int $id):RedirectResponse
    {
        if (
            !$this->service->deleteBranch($id)
        ){
            return redirect()->route('branches.index')->with('res',[
                'method' => 'error',
                'msg' => trans('form.success_delete',['attribute' => trans('form.branches.branch')]),
//                'msg' => trans('form.success_delete',['attribute' => trans('form.branches.branch')]),
            ]);        }
        return redirect()->route('branches.index')->with('res',[
            'method' => 'success',
            'msg' => trans('form.success_delete',['attribute' => trans('form.branches.branch')]),
        ]);
    }


}
