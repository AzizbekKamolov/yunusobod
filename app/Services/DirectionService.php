<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Direction\CreateDirectionActionData;
use App\ActionData\Permission\CreatePermissionActionData;
use App\ActionData\Direction\UpdateDirectionActionData;
use App\DataObjects\Direction\DirectionData;
use App\Models\DirectionModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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
        $direction = DirectionModel::query()->create($actionData->all());
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

        $direction->fill($actionData->all());
        $direction->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteDirection(int $id): void
    {
        $data = $this->getOne($id);
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
