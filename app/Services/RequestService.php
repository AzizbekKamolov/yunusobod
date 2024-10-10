<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\DataObjects\Request\RequestData;
use App\Models\RequestModel;

class RequestService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = RequestModel::applyEloquentFilters($filters)
            ->orderByDesc('id');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (RequestModel $requestModel) {
            return RequestData::createFromEloquentModel($requestModel);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @param int $id
     * @return void
     */
    public function deleteRequest(int $id): void
    {
        $page = $this->getOne($id);
        $page->delete();
    }

    /**
     * @param int $id
     * @return RequestModel
     */
    protected function getOne(int $id): RequestModel
    {
        return RequestModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return RequestData
     */
    public function edit(int $id): RequestData
    {
        return RequestData::fromModel($this->getOne($id));
    }

    public function check(int $id): void
    {
        $data = $this->getOne($id);
        if ($data->status == 0) {
            $data->update(['status' => 1]);
        }
    }
}
