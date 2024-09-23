<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Permission\CreatePermissionActionData;
use App\ActionData\Slider\SliderActionData;
use App\ActionData\Slider\UpdateSliderActionData;
use App\DataObjects\Slider\SliderData;
use App\Models\SliderModel;
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
     * @param int $id
     * @return void
     */
    public function setOrder(int $id): void
    {
        $slider = $this->getOne(abs($id));
        if ($id < 0) {
            $slider2 = SliderModel::query()->where('order', '<', $slider->order)->orderByDesc('order')->first();
        } else {
            $slider2 = SliderModel::query()->where('order', '>', $slider->order)->orderBy('order')->first();
        }
        if ($slider2) {
            $ord = $slider->order;
            $slider->order = $slider2->order;
            $slider2->order = $ord;
            $slider->update();
            $slider2->update();
        }
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
     * @param UpdateSliderActionData $actionData
     * @param int $id
     * @return void
     */
    public function updateSlider(UpdateSliderActionData $actionData, int $id): void
    {
        $slider = $this->getOne($id);
        $data = $actionData->all();

        unset($data['file']);
        if ($actionData->file) {
            Storage::disk('local')->delete('sliders/' . $slider->file);
            $data['file'] = $actionData->file->hashName();
            Storage::disk('local')->put('sliders/' . $data['file'], file_get_contents($actionData->file->getRealPath()));
        }
        $slider->fill($data);
        $slider->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteSlider(int $id): void
    {
        $data = $this->getOne($id);
        Storage::disk('local')->delete('sliders/' . $data->file);
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

    public function getAllSliders()
    {
        $sliders = SliderModel::query()->orderBy('order')->where('active', true)->get();
        return $sliders->transform(fn (SliderModel $data) => SliderData::fromModel($data));
    }
}
