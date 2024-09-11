<?php
declare(strict_types = 1);
namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\FileCategory\CreateFileCategoryActionData;
use App\DataObjects\FileCategory\FileCategoryData;
use App\Models\FileCategory;
use App\ViewModels\FileCategory\FileCategoryViewModel;

class FileCategoryService
{
    public function paginate(int $page =1, int $limit =10 ,?iterable $filters = [] ):DataObjectCollection
    {
        $model = FileCategory::applyEloquentFilters($filters)->with(['documents',])
            ->orderBy('file_categories.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (FileCategory $position) {
            return FileCategoryData::createFromEloquentModel($position);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CreateFileCategoryActionData $actionData
     * @return FileCategoryData
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createFilecCategory(CreateFileCategoryActionData $actionData):FileCategoryData
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:file_categories,name->uz',
            'name.ru' => 'required|string|unique:file_categories,name->ru'
        ]);
        $actionData->validateException();
        $data = FileCategory::query()->create($actionData->all());
        return FileCategoryData::fromModel($data);
    }

    /**
     * @param CreateFileCategoryActionData $actionData
     * @param int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateFileCategory(CreateFileCategoryActionData $actionData, int $id):void
    {
        $actionData->addValidationRules([
            'name.uz' => 'required|string|unique:file_categories,name->uz'.$id,
            'name.ru' => 'required|string|unique:file_categories,name->ru'.$id
        ]);
        $actionData->validateException();
        $this->getFileCategory($id)->update($actionData->all());

    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteFileCategory(int $id):void
    {
        $this->getFileCategory($id)->delete();
    }

    /**
     * @param int $id
     * @return FileCategory
     */
    public function getFileCategory(int $id):FileCategory
    {
        return FileCategory::query()->findOrFail($id);
    }

    public function allCategories()
    {
        $fileCategories = FileCategory::query()->with('documents')->get();
        return $fileCategories->transform(fn(FileCategory $category) => FileCategoryData::fromModel($category));
    }
}
