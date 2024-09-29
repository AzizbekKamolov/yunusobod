<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Page\CreatePageActionData;
use App\Services\PageService;
use App\ViewModels\Page\PageViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(protected PageService $service)
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
        return (new PaginationViewModel($collection, PageViewModel::class))->toView('admin.pages.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $viewModel = PageViewModel::createEmpty();
        return $viewModel->toView('admin.pages.create');
    }

    /**
     * @param CreatePageActionData $actionData
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(CreatePageActionData $actionData): RedirectResponse
    {
        $this->service->createPage($actionData);
        return redirect()->route('pages.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('form.pages.pages')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->service->edit($id);
        $viewModel = PageViewModel::fromDataObject($data);

        return $viewModel->toView('admin.pages.edit');
    }

    /**
     * @param CreatePageActionData $actionData
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(CreatePageActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updatePage($actionData, $id);
        return redirect()->route('pages.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.pages.page')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deletePage($id);
        return redirect()->route('pages.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('form.pages.pages')]));
    }
}
