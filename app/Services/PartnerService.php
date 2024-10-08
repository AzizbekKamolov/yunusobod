<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Partner\updatePartnerActionData;
use App\ActionData\Permission\CreatePermissionActionData;
use App\ActionData\Partner\CreatePartnerActionData;
//use App\ActionData\Partner\UpdatePartnerActionData;
use App\DataObjects\Partner\PartnerData;
use App\Models\PartnerModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PartnerService
{

    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = PartnerModel::applyEloquentFilters($filters)
            ->orderBy('partners.order');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (PartnerModel $data) {
            return PartnerData::createFromEloquentModel($data);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param int $id
     * @return void
     */
    public function setOrder(int $id): void
    {
        $partner = $this->getOne(abs($id));
        if ($id < 0) {
            $partner2 = PartnerModel::query()->where('order', '<', $partner->order)->orderByDesc('order')->first();
        } else {
            $partner2 = PartnerModel::query()->where('order', '>', $partner->order)->orderBy('order')->first();
        }
        if ($partner2) {
            $ord = $partner->order;
            $partner->order = $partner2->order;
            $partner2->order = $ord;
            $partner->update();
            $partner2->update();
        }
    }


    /**
     * @param CreatePartnerActionData $actionData
     * @return PartnerData
     * @throws ValidationException
     */
    public function createPartner(CreatePartnerActionData $actionData): PartnerData
    {
        $data = $actionData->all();
        $data['photo'] = $actionData->photo->hashName();
        Storage::disk('local')->put('sliders/' . $data['photo'], file_get_contents($actionData->photo->getRealPath()));
        $partner = PartnerModel::query()->create($data);
        $partner->update(['order' => $partner->id]);
        return PartnerData::createFromEloquentModel($partner);
    }


    /**
     * @param updatePartnerActionData $actionData
     * @param int $id
     * @return void
     */
    public function updatePartner(updatePartnerActionData $actionData, int $id): void
    {
        $partner = $this->getOne($id);
        $data = $actionData->all();

        unset($data['photo']);
        if ($actionData->photo) {
            Storage::disk('local')->delete('sliders/' . $partner->file);
            $data['photo'] = $actionData->photo->hashName();
            Storage::disk('local')->put('sliders/' . $data['photo'], file_get_contents($actionData->photo->getRealPath()));
        }
        $partner->fill($data);
        $partner->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deletePartner(int $id): void
    {
        $data = $this->getOne($id);
        Storage::disk('local')->delete('sliders/' . $data->photo);
        $data->delete();
    }

    /**
     * @param int $id
     * @return PartnerModel
     */
    protected function getOne(int $id): PartnerModel
    {
        return PartnerModel::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return PartnerData
     */
    public function getPartner(int $id): PartnerData
    {
        return PartnerData::fromModel($this->getOne($id));
    }

    public function getAllPartners()
    {
        $partners = PartnerModel::query()->orderBy('order')->where('status', true)->get();
        return $partners->transform(fn (PartnerModel $data) => PartnerData::fromModel($data));
    }
}
