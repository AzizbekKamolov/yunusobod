<?php
declare(strict_types=1);
namespace App\DataObjects\Employee;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Branch\BranchData;
use App\DataObjects\Department\DepartmentData;
use App\DataObjects\Employees\EmployeeExamAttempt\EmployeeExamAttemptData;
use App\DataObjects\Position\PositionData;

class EmployeeWithExamAttemptData extends DataObjectBase
{
    public int $id;
    public string $fullname;
    public string $username;
    public  string $pinfl;
    public string $birthdate;
    public string $passport;
    public int $branchId;
    public int $positionId;

    public ?DepartmentData $department;
    public ?BranchData $branch;
    public ?PositionData $position;
    public  array|EmployeeExamAttemptData $employeeExamAttempts = [];

}
