<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\Services\RequestService;
use App\ViewModels\Request\RequestViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function __construct(protected RequestService $service)
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters = [];
//        $filters[] = PermissionsFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), limit: (int)$request->get('limit', 10), filters: $filters);
        return (new PaginationViewModel($collection, RequestViewModel::class))->toView('admin.requests.index');
    }


    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->service->edit($id);
        $viewModel = RequestViewModel::fromDataObject($data);

        return $viewModel->toView('admin.requests.edit');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteRequest($id);
        return redirect()->route('requests.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('form.requests.requests')]));
    }
}
