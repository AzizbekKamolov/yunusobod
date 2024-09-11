<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\FileCategory\CreateFileCategoryActionData;
use App\DataObjects\FileCategory\FileCategoryData;
use App\Models\FileCategory;
use App\Services\FileCategoryService;
use App\ViewModels\FileCategory\FileCategoryViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class FileCategoryController extends Controller
{
    public function __construct(
        protected FileCategoryService $service
    )
    {
    }

    public function index(Request $request): View
    {
        $collection = $this->service->paginate(page: (int)$request->get('page', 1));
        return (new PaginationViewModel($collection, FileCategoryViewModel::class))->toView('admin.categories.index');
    }


    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * @param CreateFileCategoryActionData $actionData
     * @return RedirectResponse
     * @throws ValidationException
     */

    public function store(CreateFileCategoryActionData $actionData): RedirectResponse
    {
        $this->service->createFilecCategory($actionData);
        return redirect()->route('categories.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.categories.category')]),
        ]);
    }


    public function show(FileCategory $fileCategory)
    {
        //
    }

    public function edit(int $id): View
    {
        $viewModel = new FileCategoryViewModel(FileCategoryData::fromModel($this->service->getFileCategory($id)));
        return $viewModel->toView('admin.categories.edit');
    }

    /**
     * @param CreateFileCategoryActionData $actionData
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(CreateFileCategoryActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateFileCategory($actionData, $id);
        return redirect()->route('categories.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.categories.category')]),
        ]);
    }


    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteFileCategory($id);
        return redirect()->route('categories.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.categories.category')]),
        ]);
    }
}
