<?php
declare(strict_types=1);

namespace App\Services;

use Akbarali\DataObject\DataObjectCollection;
use App\ActionData\Employee\CreateEmployeeActionData;
use App\ActionData\Employee\ImportEmployeeActionData;
use App\ActionData\Employee\UpdateEmployeeActionData;
use App\ActionData\Employees\EmployeeProfile\UpdateEmployeeActionData as UpdateEmployeeProfileActionData;
use App\DataObjects\Employee\EmployeeData;
use App\DataObjects\Employee\EmployeeWithExamAttemptData;
use App\Exceptions\OperationException;
use App\Imports\Employee\EmployeeImport;
use App\Jobs\ImportEmployeesJob;
use App\Models\Employee;
use App\Models\ImportedEmployee;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeService
{
    /**
     * @param int $page
     * @param int $limit
     * @param iterable|null $filters
     * @return DataObjectCollection
     */
    public function paginate(int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $query = Employee::applyEloquentFilters($filters)->with(['position.department', 'branch', 'department','files'])
            ->orderBy('id', 'desc');
        $total = $query->count();
        $skip = ($page - 1) * $limit;
        $items = $query->skip($skip)->take($limit)->get();

        $items->transform(fn(Employee $employee) => EmployeeData::fromModel($employee));
        return new DataObjectCollection($items, $total, $limit, $page);
    }

    public function createEmployee(CreateEmployeeActionData $actionData): EmployeeData
    {
        $data = $actionData->all();
        $position = Position::query()->find($data['position_id']);
        $passport = strtoupper(str_replace(array(' '), '', $data['passport']));
        $employee = Employee::query()->create([
            'fullname' => $data['fullname'],
            'pinfl' => $data['pinfl'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'passport' => $passport,
            'department_id' => $position->department_id,
            'birthdate' => $data['birthdate'],
            'position_id' => $position->id,
            'branch_id' => $data['branch_id'],
        ]);
        if (isset($actionData->photo)) {
            FileService::uploadFile(file: $actionData->photo,model:  $employee,diskName: 'profile',filePath: "/" );
        }
        return EmployeeData::createFromEloquentModel($employee);
    }

    /**
     * @param UpdateEmployeeActionData $actionData
     * @param int $id
     * @return EmployeeData
     * @throws ValidationException
     */
    public function updateEmployee(UpdateEmployeeActionData $actionData, int $id): EmployeeData
    {
        $actionData->addValidationRule('username', 'unique:employees,username,' . $id);
        $actionData->validateException();
        $employee = $this->getEmployee($id);
        $data = $actionData->all();
        $data['passport'] = strtoupper(str_replace(array(' '), '', $data['passport']));
        unset($data['password']);
        unset($data['photo']);
        if ($actionData->password != null && request()->user()->hasPermissionTo('update_password')) {
            $data['password'] = bcrypt($actionData->password);
        }
        $employee->update($data);
        if (isset($actionData->photo)) {
            foreach ($employee->files  as $file) {
                FileService::fileDelete('profile', $file->id);
            }
            FileService::uploadFile(file: $actionData->photo,model:  $employee,diskName: 'profile',filePath: "/" );
        }
        return EmployeeData::createFromEloquentModel($employee);
    }


    /**
     * @param int $id
     * @return void
     * @throws OperationException
     */
    public function deleteEmployee(int $id): void
    {
        $employee = $this->getEmployee($id);
        foreach ($employee->files  as $file) {
            FileService::fileDelete('profile', $file->id);
        }
        if (!$employee) {
            throw new OperationException('Employee not found');
        }
        $employee->delete();
    }

    /**
     * @param int $id
     * @return Model|Builder|Employee
     */
    public function getEmployee(int $id): Model|Builder|Employee
    {
        return Employee::query()->with('branch', 'position', 'department','files')->findOrFail($id);
    }

    public function edit(int $id): EmployeeData
    {
        return EmployeeData::fromModel($this->getEmployee($id));
    }

    public function getEmployees(array $filters)
    {
        $employees = Employee::applyEloquentFilters($filters)->with(['position.department', 'branch', 'department'])->get();
        return $employees->transform(fn(Employee $employee) => EmployeeData::fromModel($employee));
    }

    /**
     * @param UpdateEmployeeProfileActionData $actionData
     * @param $id
     * @return EmployeeData
     * @throws ValidationException
     */
    public function updateProfile(UpdateEmployeeProfileActionData $actionData, $id): EmployeeData
    {
        $actionData->addValidationRule('username', 'unique:employees,username,' . $id);
        $actionData->validateException();
        $employee = $this->getEmployee($id);
        $data = $actionData->all();
        unset($data['password']);
        if ($actionData->password != null && request()->user()->hasPermissionTo('update_password')) {
            $data['password'] = bcrypt($actionData->password);
        }
        $employee->update([
            'fullname' => $actionData->fullname,
            'username' => $actionData->username
        ]);
        if (isset($actionData->photo)) {
            foreach ($employee->files  as $file) {
                FileService::fileDelete('profile', $file->id);
            }
            FileService::uploadFile(file: $actionData->photo,model:  $employee,diskName: 'profile' );
        }
        $employee->update($data);

        return EmployeeData::createFromEloquentModel($employee);
    }


    public function employeesCount(): int
    {
        return Employee::query()->count();
    }


    public function import(ImportEmployeeActionData $actionData): void
    {
        if ($actionData->file->isValid()) {
            Excel::import(new EmployeeImport($actionData), $actionData->file);
        }
    }

    public function importToJob(): void
    {
        Log::info('start  ' . Carbon::now()->format('Y-m-d H:i:s'));
        $employeeFirst = ImportedEmployee::query()->orderBy('id', 'asc')->first();
        $employeeLast = ImportedEmployee::query()->orderBy('id', 'desc')->first();
        for ($i = $employeeFirst->id; $i <= $employeeLast->id; $i += 20) {
            ImportEmployeesJob::dispatch($i);
        }
        Log::info(' end ' . Carbon::now()->format('Y-m-d H:i:s'));
    }

    public function paginateEmployee(int $examId, int $departmentId, int $page = 1, int $limit = 10, ?iterable $filters = null): DataObjectCollection
    {
        $query = Employee::applyEloquentFilters($filters)->with(['position', 'employeeExamAttempts' => function ($query) use ($examId) {
            $query->where('exam_id', '=', $examId)->orderByDesc('correct_answers_count');
        }])->orderBy('id', 'desc')
            ->where('department_id', '=', $departmentId);
        $total = $query->count();
        $skip = ($page - 1) * $limit;
        $items = $query->skip($skip)->take($limit)->get();

        $items->transform(fn(Employee $employee) => EmployeeWithExamAttemptData::fromModel($employee));
        return new DataObjectCollection($items, $total, $limit, $page);
    }

//    public function uploadProfilePhoto(Employee $employee, UploadedFile $file): void
//    {
//        if ($employee->photo != null) {
//            Storage::disk('profile')->delete($employee->photo);
//        }
//        $file_name = time() . "_" . Str::random(10) . "." . $file->getClientOriginalExtension();
//        $directory = $employee->id;
//        $path = $directory . "/" . $file_name;
//
//        Storage::disk('profile')->put($path, $file);
//
//        $employee->update([
//            'photo' => $path
//        ]);
//    }

}
