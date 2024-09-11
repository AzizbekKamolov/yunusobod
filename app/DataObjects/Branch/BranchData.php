<?php
declare(strict_types=1);
namespace App\DataObjects\Branch;

use Akbarali\DataObject\DataObjectBase;

class BranchData extends DataObjectBase
{
    public int $id;
    public string $name;
    public string $address;
    public int $organizationId;
    public $employees;



}
