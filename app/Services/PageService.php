<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Page\CreatePageActionData;
use App\DataObjects\Page\PageData;
use App\Models\PageModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PageService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = PageModel::applyEloquentFilters($filters)
            ->orderBy('pages.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (PageModel $page) {
            return PageData::createFromEloquentModel($page);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @param CreatePageActionData $actionData
     * @return PageData
     * @throws ValidationException
     */
    public function createPage(CreatePageActionData $actionData): PageData
    {
        $data = $actionData->all();
        unset($data['file']);
        if ($actionData->photo) {
            $data['photo'] = $actionData->photo->hashName();

            $actionData->photo->move(public_path('sliders'), $data['photo']);
//            Storage::disk('local')->put('sliders/' . $data['photo'], file_get_contents($actionData->photo->getRealPath()));

        }
        $page = PageModel::query()->create($data);
        return PageData::createFromEloquentModel($page);
    }


    /**
     * @param CreatePageActionData $actionData
     * @param int $id
     * @return void
     */
    public function updatePage(CreatePageActionData $actionData, int $id): void
    {
        $data = $actionData->all();
        unset($data['photo']);
        $page = $this->getOne($id);
        if ($actionData->photo) {
//            $data['photo'] = Str::uuid()->toString() . '.' . $actionData->photo->getClientOriginalExtension();
            $data['photo'] = $actionData->photo->hashName();
            if (file_exists(public_path("sliders/$page->photo"))){
                unlink(public_path("sliders/$page->photo"));
            }
            $actionData->photo->move(public_path('sliders'), $data['photo']);
//            Storage::disk('local')->put('sliders/' . $data['photo'], file_get_contents($actionData->photo->getRealPath()));
//
//            Storage::disk('local')->delete('sliders/' . $page->photo);
        }
        $page->update($data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePage(int $id): void
    {
        $page = $this->getOne($id);
        $page->delete();
    }

    /**
     * @param int $id
     * @return PageModel
     */
    protected function getOne(int $id): PageModel
    {
        return PageModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return PageData
     */
    public function edit(int $id): PageData
    {
        return PageData::fromModel($this->getOne($id));
    }

    /**
     * @param string $action
     * @return PageData
     */
    public function getPage(string $action = 'about_us'): PageData
    {
        $page = PageModel::query()->where('action', '=', $action)->first();
        return PageData::fromModel($page);
    }
}
