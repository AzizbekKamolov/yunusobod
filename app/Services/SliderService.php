<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Permission\CreatePermissionActionData;
use App\ActionData\Slider\SliderActionData;
use App\DataObjects\Slider\SliderData;
use App\Models\Permission;
use App\Models\SliderModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SliderService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = SliderModel::applyEloquentFilters($filters)
            ->orderBy('sliders.order');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (SliderModel $data) {
            return SliderData::createFromEloquentModel($data);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @param CreatePermissionActionData $actionData
     * @return SliderData
     * @throws ValidationException
     */
    public function createSlider(SliderActionData $actionData): SliderData
    {
        $data = $actionData->all();
        $data['file'] = $actionData->file->hashName();
        Storage::disk('local')->put('sliders/' . $data['file'], file_get_contents($actionData->file->getRealPath()));
        $slider = SliderModel::query()->create($data);
        $slider->update(['order' => $slider->id]);
        return SliderData::createFromEloquentModel($slider);
    }


    /**
     * @param CreatePermissionActionData $actionData
     * @param int $id
     * @return void
     * @throws ValidationException
     */
    public function updatePermission(CreatePermissionActionData $actionData, int $id): void
    {
        $actionData->addValidationRule('name', "unique:permissions,name,$id");
        $actionData->validateException();
        $data = $this->getOne($id);
        $data->fill($actionData->all());
        $data->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePermission(int $id): void
    {
        $data = $this->getOne($id);
        $data->delete();
    }

    /**
     * @param int $id
     * @return SliderModel
     */
    protected function getOne(int $id): SliderModel
    {
        return SliderModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return SliderData
     */
    public function getSlider(int $id): SliderData
    {
        return SliderData::fromModel($this->getOne($id));
    }
}
