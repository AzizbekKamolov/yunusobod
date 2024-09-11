<?php

namespace App\Http\Controllers;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Document\CreateDocumentActionData;
use App\ActionData\Document\UpdateDocumentActionData;
use App\DataObjects\Document\DocumentData;
use App\DataObjects\FileCategory\FileCategoryData;
use App\Filters\Document\DocumentFilter;
use App\Models\Document;
use App\Services\DocumentService;
use App\Services\FileCategoryService;
use App\Services\FileService;
use App\ViewModels\Document\DocumentUpdateViewModel;
use App\ViewModels\Document\DocumentViewModel;
use App\ViewModels\FileCategory\FileCategoryViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function __construct(
        protected DocumentService     $service,
        protected FileCategoryService $categoryService
    )
    {

    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters [] = DocumentFilter::getRequest($request);
        $collection = $this->service->paginate(page: (int)$request->get('page'), filters: $filters);
        return (new PaginationViewModel($collection, DocumentViewModel::class))->toView('admin.documents.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = $this->categoryService->allCategories()->transform(fn(FileCategoryData $categoryData) => FileCategoryViewModel::fromDataObject($categoryData));
        return view('admin.documents.create', compact('categories'));
    }

    /**
     * @param CreateDocumentActionData $actionData
     * @return RedirectResponse
     */
    public function store(CreateDocumentActionData $actionData): RedirectResponse
    {
        $this->service->createDocument($actionData);
        return redirect()->route('documents.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.documents.document')]),
        ]);

    }


    public function show(Document $document)
    {
        //
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $document = $this->service->getOne($id);
        $categories = $this->categoryService->allCategories()->transform(fn(FileCAtegoryData $categoryData) => FileCategoryViewModel::fromDataObject($categoryData));
        $viewModel = new DocumentUpdateViewModel(DocumentData::fromModel($document));
        return $viewModel->toView('admin.documents.edit', compact('categories'));
    }

    /**
     * @param UpdateDocumentActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateDocumentActionData $actionData, int $id): RedirectResponse
    {
//        dd($actionData->all());
        $this->service->updateDocument($actionData, $id);
        return redirect()->route('documents.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.documents.document')]),
        ]);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteDocument($id);
        return redirect()->route('documents.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.documents.document')]),
        ]);
    }
    public function fileDelete(int $id): RedirectResponse
    {
        $documentId = FileService::fileDelete('document',$id);
        return redirect()->route('documents.edit', [$documentId])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.documents.document')]),
        ]);
    }
}
