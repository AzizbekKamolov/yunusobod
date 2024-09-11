<?php

namespace App\DataObjects\Warehouse\EmployeeProduct;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Employee\EmployeeData;
use App\DataObjects\Warehouse\WarehouseCategory\WarehouseCategoryData;

class EmployeeProductData extends DataObjectBase
{

    public int $id ;
    public int $employee_id;
    public int $warehouse_id;
    public int $warehouse_category_id;
    public ?string $description;
    public int $quantity;
    public ?string $date_given;
    public ?EmployeeData $employee;
    public ?WarehouseCategoryData $warehouse_category;
    public ?string $entry_date;
}
