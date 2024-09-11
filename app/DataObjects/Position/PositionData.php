<?php
declare(strict_types=1);
namespace App\DataObjects\Position;
use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Department\DepartmentData;

class PositionData extends DataObjectBase
{
    public int $id;
    public ?array  $name;
    public int $departmentId;

    public ?string $created_at;
    public $employees;
    public ?DepartmentData $department;
}
