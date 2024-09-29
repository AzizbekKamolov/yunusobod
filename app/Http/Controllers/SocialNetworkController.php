<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\SocialNetwork\SocialNetworkActionData;
use App\ActionData\SocialNetwork\UpdateSocialNetworkActionData;
use App\Services\SocialNetworkService;
use App\ViewModels\SocialNetwork\SocialNetworkViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SocialNetworkController extends Controller
{
    public function __construct(protected SocialNetworkService $service)
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
        return (new PaginationViewModel($collection, SocialNetworkViewModel::class))->toView('admin.social_networks.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $viewModel = SocialNetworkViewModel::createEmpty();
        return $viewModel->toView('admin.social_networks.create');
    }

    /**
     * @param SocialNetworkActionData $actionData
     * @return RedirectResponse
     */
    public function store(SocialNetworkActionData $actionData): RedirectResponse
    {
        $this->service->createSocialNetwork($actionData);
        return redirect()->route('social_networks.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('form.social_networks.social_networks')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function setOrder(int $id): RedirectResponse
    {
        $this->service->setOrder($id);
        return redirect()->route('social_networks.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.social_networks.social_networks')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->service->getSocialNetwork($id);
        $viewModel = SocialNetworkViewModel::fromDataObject($data);

        return $viewModel->toView('admin.social_networks.edit');
    }

    /**
     * @param UpdateSocialNetworkActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateSocialNetworkActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateSocialNetwork($actionData, $id);
        return redirect()->route('social_networks.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.social_networks.social_network')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteSocialNetwork($id);
        return redirect()->route('social_networks.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('form.social_networks.social_network')]));
    }
}
