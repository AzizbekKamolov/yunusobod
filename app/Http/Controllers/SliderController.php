<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Slider\SliderActionData;
use App\ActionData\Slider\UpdateSliderActionData;
use App\Services\SliderService;
use App\ViewModels\Slider\SliderViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SliderController extends Controller
{

    public function __construct(protected SliderService $service)
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
        return (new PaginationViewModel($collection, SliderViewModel::class))->toView('admin.sliders.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $viewModel = SliderViewModel::createEmpty();
        return $viewModel->toView('admin.sliders.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(SliderActionData $actionData): RedirectResponse
    {
        $this->service->createSlider($actionData);
        return redirect()->route('sliders.index')
            ->with('success', trans('form.success_create', ['attribute' => trans('form.sliders.sliders')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function setOrder(int $id): RedirectResponse
    {
        $this->service->setOrder($id);
        return redirect()->route('sliders.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.sliders.sliders')]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->service->getSlider($id);
        $viewModel = SliderViewModel::fromDataObject($data);

        return $viewModel->toView('admin.sliders.edit');
    }

    /**
     * @param UpdateSliderActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateSliderActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateSlider($actionData, $id);
        return redirect()->route('sliders.index')
            ->with('success', trans('form.success_update', ['attribute' => trans('form.sliders.slider')]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteSlider($id);
        return redirect()->route('sliders.index')
            ->with('success', trans('form.success_delete', ['attribute' => trans('form.sliders.slider')]));
    }
}
