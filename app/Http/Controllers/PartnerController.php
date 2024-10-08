<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Partner\CreatePartnerActionData;
use App\ActionData\Partner\updatePartnerActionData;
use App\Services\PartnerService;
use App\ViewModels\Partner\PartnerViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function __construct(protected PartnerService $service)
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
        return (new PaginationViewModel($collection, PartnerViewModel::class))->toView('admin.partners.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $viewModel = PartnerViewModel::createEmpty();
        return $viewModel->toView('admin.partners.create');
    }

    /**
     * @param createPartnerActionData $actionData
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(createPartnerActionData $actionData): RedirectResponse
    {
        $this->service->createPartner($actionData);
        return redirect()->route('partners.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('form.partners.partners')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function setOrder(int $id): RedirectResponse
    {
        $this->service->setOrder($id);
        return redirect()->route('partners.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.partners.partners')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->service->getPartner($id);
        $viewModel = PartnerViewModel::fromDataObject($data);

        return $viewModel->toView('admin.partners.edit');
    }

    /**
     * @param createPartnerActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(updatePartnerActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updatePartner($actionData, $id);
        return redirect()->route('partners.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.partners.partner')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deletePartner($id);
        return redirect()->route('partners.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('form.partners.partner')]));
    }
}
