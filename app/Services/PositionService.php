<?php

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Position\CreatePositionActiondata;
use App\DataObjects\Position\PositionData;
use App\Exceptions\OperationException;
use App\Models\Position;
use App\ViewModels\Admin\Position\PositionViewModel;
use Ramsey\Collection\Collection;


class PositionService
{
    public function paginate(int $page =1, int $limit =10 ,?iterable $filters = [] ):DataObjectCollection
    {
        $model = Position::applyEloquentFilters($filters)->with(['employees','department'])
            ->orderBy('positions.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Position $position) {
            return PositionData::createFromEloquentModel($position);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @param CreatePositionActiondata $actionData
     * @return PositionData
     */
    public function createPosition(CreatePositionActiondata $actionData): PositionData
    {
        $data = $actionData->all();
        $position = Position::create($data);
        return PositionData::fromModel($position);

    }

    /**
     * @throws OperationException
     */
    public function updatePosition(CreatePositionActiondata $actionData, $id): PositionData
    {
        $data = $actionData->all();
        $position = Position::query()->findOrFail($id);
        if (is_null($position)) {
            throw new OperationException('Position not found');
        }
        $position->update($data);
        return PositionData::createFromEloquentModel($position);
    }

    /**
     * @throws OperationException
     */
    public function deletePosition(int $id): void
    {
        $position = Position::query()->findOrFail($id);
        if (is_null($position)) {
            throw new OperationException('Position not found');
        }
        $position->delete();
    }


    public function getPositions()
    {
        $positions = Position::query()->with('employees','department')->get();
        return $positions->transform(fn(Position $position) => PositionData::fromModel($position));
    }
}
