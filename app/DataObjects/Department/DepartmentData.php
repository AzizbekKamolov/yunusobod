<?php
declare(strict_types=1);
namespace App\DataObjects\Department;
use Akbarali\DataObject\DataObjectBase;


class DepartmentData extends DataObjectBase
{
    public int $id;
    public ?array $name;

    public $employees;
}
