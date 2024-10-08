<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Setting\CreateSettingActionData;
use App\DataObjects\Setting\SettingData;
use App\Models\SettingModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class SettingService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = SettingModel::applyEloquentFilters($filters)
            ->orderBy('settings.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (SettingModel $permission) {
            return SettingData::createFromEloquentModel($permission);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @return Builder[]|Collection
     */
    public function getSettings(): Collection|array
    {
        return SettingModel::query()->get()->chunk(4);
    }


    /**
     * @param CreateSettingActionData $actionData
     * @return SettingData
     * @throws ValidationException
     */
    public function createSetting(CreateSettingActionData $actionData): SettingData
    {
        $actionData->addValidationRule('name', 'unique:permissions,name');
        $actionData->validateException();
        $data = $actionData->all();
        $permission = SettingModel::query()->create($data);
        return SettingData::createFromEloquentModel($permission);
    }

    /**
     * @param int $id
     * @return SettingData
     */
    public function edit(int $id): SettingData
    {
        return SettingData::fromModel($this->getOne($id));
    }

    /**
     * @param CreateSettingActionData $actionData
     * @param int $id
     * @return void
     * @throws ValidationException
     */
    public function updateSetting(CreateSettingActionData $actionData, int $id): void
    {
        $actionData->addValidationRule('name', "unique:permissions,name,$id");
        $actionData->validateException();
        $permission = $this->getOne($id);
        $permission->fill($actionData->all());
        $permission->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteSetting(int $id): void
    {
        $permission = $this->getOne($id);
        $permission->delete();
    }

    /**
     * @param int $id
     * @return SettingModel
     */
    protected function getOne(int $id): SettingModel
    {
        return SettingModel::query()->findOrFail($id);
    }
}
