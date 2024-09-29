<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\SocialNetwork\SocialNetworkActionData;
use App\ActionData\SocialNetwork\UpdateSocialNetworkActionData;
use App\DataObjects\SocialNetwork\SocialNetworkData;
use App\Models\SocialNetworkModel;

class SocialNetworkService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = SocialNetworkModel::applyEloquentFilters($filters)
            ->orderBy('social_networks.order');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (SocialNetworkModel $data) {
            return SocialNetworkData::createFromEloquentModel($data);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param int $id
     * @return void
     */
    public function setOrder(int $id): void
    {
        $socialNetwork = $this->getOne(abs($id));
        if ($id < 0) {
            $socialNetwork2 = SocialNetworkModel::query()->where('order', '<', $socialNetwork->order)->orderByDesc('order')->first();
        } else {
            $socialNetwork2 = SocialNetworkModel::query()->where('order', '>', $socialNetwork->order)->orderBy('order')->first();
        }
        if ($socialNetwork2) {
            $ord = $socialNetwork->order;
            $socialNetwork->order = $socialNetwork2->order;
            $socialNetwork2->order = $ord;
            $socialNetwork->update();
            $socialNetwork2->update();
        }
    }

    /**
     * @param SocialNetworkActionData $actionData
     * @return SocialNetworkData
     */
    public function createSocialNetwork(SocialNetworkActionData $actionData): SocialNetworkData
    {
        $socialNetwork = SocialNetworkModel::query()->create($actionData->all());
        $socialNetwork->update(['order' => $socialNetwork->id]);
        return SocialNetworkData::createFromEloquentModel($socialNetwork);
    }


    /**
     * @param UpdateSocialNetworkActionData $actionData
     * @param int $id
     * @return void
     */
    public function updateSocialNetwork(UpdateSocialNetworkActionData $actionData, int $id): void
    {
        $socialNetwork = $this->getOne($id);
        $socialNetwork->fill($actionData->all());
        $socialNetwork->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteSocialNetwork(int $id): void
    {
        $data = $this->getOne($id);
        $data->delete();
    }

    /**
     * @param int $id
     * @return SocialNetworkModel
     */
    protected function getOne(int $id): SocialNetworkModel
    {
        return SocialNetworkModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return SocialNetworkData
     */
    public function getSocialNetwork(int $id): SocialNetworkData
    {
        return SocialNetworkData::fromModel($this->getOne($id));
    }

    public function getAllSocialNetworks()
    {
        $socialNetworks = SocialNetworkModel::query()->orderBy('order')->where('active', true)->get();
        return $socialNetworks->transform(fn(SocialNetworkModel $data) => SocialNetworkData::fromModel($data));
    }
}
