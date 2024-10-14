<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Direction\CreateDirectionActionData;
use App\ActionData\Direction\UpdateDirectionActionData;
use App\DataObjects\Direction\DirectionData;
use App\Models\DirectionModel;
use Illuminate\Support\Facades\Storage;

class DirectionService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = DirectionModel::applyEloquentFilters($filters)
            ->orderBy('directions.order');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (DirectionModel $data) {
            return DirectionData::createFromEloquentModel($data);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param int $id
     * @return void
     */
    public function setOrder(int $id): void
    {
        $direction = $this->getOne(abs($id));
        if ($id < 0) {
            $direction2 = DirectionModel::query()->where('order', '<', $direction->order)->orderByDesc('order')->first();
        } else {
            $direction2 = DirectionModel::query()->where('order', '>', $direction->order)->orderBy('order')->first();
        }
        if ($direction2) {
            $ord = $direction->order;
            $direction->order = $direction2->order;
            $direction2->order = $ord;
            $direction->update();
            $direction2->update();
        }
    }


    /**
     * @param CreateDirectionActionData $actionData
     * @return DirectionData
     */
    public function createDirection(CreateDirectionActionData $actionData): DirectionData
    {
        $data = $actionData->all();
        unset($data['photo']);
        unset($data['icon']);
        if ($actionData->photo) {
            $data['photo'] = $actionData->photo->hashName();
            $actionData->photo->move(public_path('sliders'), $data['photo']);
//            Storage::disk('local')->put('sliders/' . $data['photo'], file_get_contents($actionData->photo->getRealPath()));
        }
        if ($actionData->icon) {
            $data['icon'] = $actionData->icon->hashName();
            $actionData->icon->move(public_path('sliders'), $data['icon']);
//            Storage::disk('local')->put('sliders/' . $data['icon'], file_get_contents($actionData->icon->getRealPath()));
        }
        $direction = DirectionModel::query()->create($data);
        $direction->update(['order' => $direction->id]);
        return DirectionData::createFromEloquentModel($direction);
    }


    /**
     * @param UpdateDirectionActionData $actionData
     * @param int $id
     * @return void
     */
    public function updateDirection(UpdateDirectionActionData $actionData, int $id): void
    {
        $direction = $this->getOne($id);
        $data = $actionData->all();

        unset($data['photo']);
        unset($data['icon']);
        if ($actionData->photo) {
            if (file_exists(public_path("sliders/$direction->photo"))){
                unlink(public_path("sliders/$direction->photo"));
            }
//            Storage::disk('local')->delete('sliders/' . $direction->photo);
            $data['photo'] = $actionData->photo->hashName();
            $actionData->photo->move(public_path('sliders'), $data['photo']);
//            Storage::disk('local')->put('sliders/' . $data['photo'], file_get_contents($actionData->photo->getRealPath()));
        }
        if ($actionData->icon) {
            if (file_exists(public_path("sliders/$direction->icon"))){
                unlink(public_path("sliders/$direction->icon"));
            }
//            Storage::disk('local')->delete('sliders/' . $direction->icon);
            $data['icon'] = $actionData->icon->hashName();
            $actionData->icon->move(public_path('sliders'), $data['icon']);
//            Storage::disk('local')->put('sliders/' . $data['icon'], file_get_contents($actionData->icon->getRealPath()));
        }
        $direction->fill($data);
        $direction->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteDirection(int $id): void
    {
        $data = $this->getOne($id);
        if (file_exists(public_path("sliders/$data->photo"))){
            unlink(public_path("sliders/$data->photo"));
        }
        if (file_exists(public_path("sliders/$data->icon"))){
            unlink(public_path("sliders/$data->icon"));
        }
        $data->delete();
    }

    /**
     * @param int $id
     * @return DirectionModel
     */
    protected function getOne(int $id): DirectionModel
    {
        return DirectionModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return DirectionData
     */
    public function getDirection(int $id): DirectionData
    {
        return DirectionData::fromModel($this->getOne($id));
    }

    public function getAllDirections()
    {
        $directions = DirectionModel::query()->orderBy('order')->where('status', true)->get();
        return $directions->transform(fn (DirectionModel $data) => DirectionData::fromModel($data));
    }
}
