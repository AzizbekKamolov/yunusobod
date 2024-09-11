<?php
declare(strict_types=1);
namespace App\DataObjects\Employee;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Branch\BranchData;
use App\DataObjects\Department\DepartmentData;
use App\DataObjects\File\FileData;
use App\DataObjects\Position\PositionData;

class EmployeeData extends DataObjectBase
{
    public int $id;
    public string $fullname;
    public string $username;
    public  string $pinfl;
    public string $birthdate;
    public string $passport;
    public ?string $photo;
    public int $branchId;
    public int $positionId;

    public ?DepartmentData $department;
    public ?BranchData $branch;
    public ?PositionData $position;
    public ?array $files;

}
