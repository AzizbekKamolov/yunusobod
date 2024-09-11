<?php
declare(strict_types=1);
namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Branch\CreateBranchActionData;
use App\DataObjects\Branch\BranchData;
use App\Exceptions\OperationException;
use App\Models\Branch;
use App\ViewModels\Admin\Branch\BranchViewModel;
use Illuminate\Validation\ValidationException;

class BranchService
{


    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $model = Branch::applyEloquentFilters($filters)->with('employees')
            ->orderBy('branches.id', 'desc');

        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (Branch $permission) {
            return BranchData::createFromEloquentModel($permission);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }


    /**
     * @throws OperationException
     */
    public function getBranchById(int $id): Branch
    {
        $branch = Branch::query()->with('employees')->find($id);

        if (is_null($branch)) {
            throw new OperationException('Branch not found');
        }
        return $branch;
    }


    /**
     * @throws ValidationException
     */
    public function createBranch(CreateBranchActionData $branchActionData): BranchData
    {
        $data = $branchActionData->all();
        $branchActionData->addValidationRule('name', 'required|unique:branches,name');
        $branchActionData->validateException();
        $branch = Branch::query()->create($data);
        return BranchData::createFromEloquentModel($branch);
    }

    /**
     * @throws ValidationException
     */
    public function updateBranch(CreateBranchActionData $branchActionData, int $id): BranchData
    {
        $branch = Branch::query()->findOrFail($id);
        $branchActionData->addValidationRule('name', 'required|unique:branches,name,' . $id);
        $branchActionData->validateException();
        $data = $branchActionData->all();
        $branch->update($data);
        return BranchData::createFromEloquentModel($branch);
    }

    /**
     * @throws OperationException
     */
    public function deleteBranch(int $id): bool
    {
        $branch = $this->getBranchById($id);
        if ($branch->employees()->exists()){
            return false;
        }
        $branch->delete();
        return true;
    }

    public function getBranches()
    {
        $branches = Branch::query()->with('employees')->get();
        return $branches->transform(fn(Branch $branch) => BranchData::fromModel($branch));
    }

}
