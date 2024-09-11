<?php
declare(strict_types=1);

namespace App\Services\Medical\MedicalOrder;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Medical\MedicalOrder\CreateMedicalOrderActionData;
use App\ActionData\Medical\MedicalOrder\UpdateMedicalOrderActionData;
use App\DataObjects\Employee\EmployeeWithMedicalResultData;
use App\DataObjects\Medical\MedicalOrder\MedicalOrderData;
use App\DataObjects\Medical\MedicalOrder\UpdateMedicalOrderData;
use App\Models\Employee;
use App\Models\MedicalOrder;
use App\Models\MedicalOrderEmployee;
use App\Models\MedicalResult;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MedicalOrderService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 15, ?iterable $filters = []): DataObjectCollection
    {
        $model = MedicalOrder::applyEloquentFilters($filters)->withCount('order_employees')
            ->orderBy('id', 'desc');
        $totalCount = $model->count();
        $skip = $limit * ($page - 1);
        $items = $model->skip($skip)->take($limit)->get();
        $items->transform(function (MedicalOrder $medical_order) {
            return MedicalOrderData::createFromEloquentModel($medical_order);
        });
        return new DataObjectCollection($items, $totalCount, $limit, $page);
    }

    /**
     * @param CreateMedicalOrderActionData $actionData
     * @return void
     */
    public function createMedicalOrder(CreateMedicalOrderActionData $actionData): void
    {
        DB::beginTransaction();
        try {
            $data = $actionData->all();
            $user = auth()->user();
            $user = User::query()->findOrFail($user->id);
            $medical_order = $user->medical_orders()->create($data);
            $this->add($data, $medical_order);
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error($th);
        }
    }

    /**
     * @param UpdateMedicalOrderActionData $actionData
     * @param int $id
     * @return MedicalOrderData
     */
    public function updateMedicalOrder(UpdateMedicalOrderActionData $actionData, int $id): MedicalOrderData
    {
        $data = $actionData->all();
        $medical_order = $this->getMedicalOrder($id);
        $medical_order->update($data);
        $medical_order->order_employees()->delete();
        $this->add($data, $medical_order);
        return MedicalOrderData::createFromEloquentModel($medical_order);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteMedicalOrder(int $id): void
    {
        $medical_order = $this->getMedicalOrder($id);
        $medical_order->order_employees()->delete();
        foreach ($medical_order->files as $file) {
            FileService::fileDelete(diskName: 'medicals', id: $file->id);
        }
        $medical_order->delete();
    }

    /**
     * @return DataObjectCollection
     */
    public function getMedicalOrders(): DataObjectCollection
    {
        $medicalOrders = MedicalOrder::all();
        return $medicalOrders->transform(fn(MedicalOrder $medicalOrder) => MedicalOrderData::fromModel($medicalOrder));
    }

    /**
     * @param int $id
     * @return MedicalOrder
     */
    public function getMedicalOrder(int $id): MedicalOrder
    {
        return MedicalOrder::query()->with(['order_employees', 'files'])->findOrFail($id);
    }

    /**
     * @param int $id
     * @return UpdateMedicalOrderData
     */
    public function edit(int $id): UpdateMedicalOrderData
    {
        $medical_order = $this->getMedicalOrder($id);
        return UpdateMedicalOrderData::fromModel($medical_order);
    }

    /**
     * @param array $data
     * @param $model
     * @return void
     */
    public function add(array $data, $model): void
    {

        if (isset($data['employees'])) {
            foreach ($data['employees'] as $employee) {
                MedicalOrderEmployee::query()->updateOrCreate([
                    'medical_order_id' => $model->id,
                    'employee_id' => $employee
                ]);
            }
        }
        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                if (isset($file['file'])) {
                    FileService::uploadFile(file: $file['file'], model: $model, lang: $file['lang'], diskName: 'medicals', filePath: 'orders/', uploaded_at: $file['uploaded_at']);

                }
            }
        }
    }

    public function getOrderWithEmployees(int $id)
    {
//        $medical_order = MedicalOrder::query()->findOrFail($id);

        $query = Employee::query()->whereHas('medicalOrderEmployees', function ($query) use ($id) {
            $query->where('medical_order_id', $id);
        })->with(['department', 'branch', 'position', 'medicalResult' => function($query) use($id){
            $query->with(['files'])->where('medical_order_id', '=', $id);
        }]);

        $employees = $query->get();
        return $employees->transform(function (Employee $employee) {
            return EmployeeWithMedicalResultData::createFromEloquentModel($employee);
        });
    }

    /**
     * @param int $id
     * @return Employee|Collection
     */
    public function getMedicalOrderEmployees(int $id):Employee|Collection
    {
        $query = Employee::query()->whereHas('medicalOrderEmployees', function ($query) use ($id) {
            $query->where('medical_order_id', $id);
        })->with(['department', 'branch', 'position']);

        $employees = $query->get();

        return $employees->transform(function (Employee $employee) {
            return EmployeeWithMedicalResultData::createFromEloquentModel($employee);
        });
    }

    public function lastMedicalOrder()
    {
        $medicalOder = MedicalOrder::query()->withCount('order_employees','medical_results')->orderBy('id', 'desc')->first();
        if($medicalOder){

            return  MedicalOrderData::fromModel($medicalOder);
        }
    }

}
