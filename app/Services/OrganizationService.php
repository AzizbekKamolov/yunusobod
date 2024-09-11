<?php
declare(strict_types=1);
namespace App\Services;



use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Organization\CreateOrganizationActionData;
use App\DataObjects\Organization\OrganizationData;
use App\Exceptions\OperationException;
use App\Models\Organization;
use App\Utils\Phone;

class OrganizationService
{


    public  function paginate(int $page = 1 ,int $limit = 10, ?iterable $filters = null):DataObjectCollection
    {
        $query = Organization::applyEloquentFilters($filters);
        $total = $query->count();
        $skip = ($page - 1) * $limit;
        $items = $query->skip($skip)->take($limit)->get();
        $items->transform(fn (Organization $employee) => OrganizationData::fromModel($employee));
        return new DataObjectCollection($items,$total, $limit, $page)  ;
    }

    /**
     * @param CreateOrganizationActionData $actiondata
     * @return OrganizationData
     * @throws OperationException
     */
    public function createOrganization(CreateOrganizationActionData $actiondata): OrganizationData
    {
        $organizations = Organization::query()->count();
        if ($organizations > 0) {
            throw new OperationException("Organization already exists");
        }
        $phone = new Phone($actiondata->phone);

        $organization = Organization::find($actiondata->id);
        $data = $actiondata->all();
        $data['phone'] = $phone->getFull();
//        dd($data);
        if ($organization) {
            $organization->update($data);
        } else {
            unset($data['id']);
            $organization = Organization::create($data);
        }
        return OrganizationData::createFromEloquentModel($organization);
    }


    /**
     * @param int $id
     * @return void
     * @throws OperationException
     */
    public function deleteOrganization(int $id): bool
    {
        $organization = Organization::query()->find($id);
        if (!$organization) {
            throw new OperationException("Organization not found");
        }
        if ($organization->branches()->count() > 0) {
            return false;
        }
        $organization->delete();
        return true;
    }


    public function updateOrganization(CreateOrganizationActionData $actionData,int $id):void
    {
        $organization = $this->getOrganization($id);

        $data = $actionData->all();
        $phone = new Phone($actionData->phone);
        $data['phone'] = $phone->getFull();
        $organization->fill($data);
        $organization->save();

    }

    public function getOrganization(int $id): Organization
    {
       return  Organization::query()->find($id);
    }
    public function edit(int $id): OrganizationData
    {
        $organization = $this->getOrganization($id);
        return OrganizationData::fromModel($organization);
    }

}
