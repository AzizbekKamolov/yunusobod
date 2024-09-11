<?php

namespace App\DataObjects\Employees\Warehouse;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Warehouse\WarehouseCategory\WarehouseCategoryData;

class EmployeeProductData extends DataObjectBase
{

    public int $id;
    public int $warehouse_category_id;
    public ?WarehouseData $warehouse;
    public ?WarehouseCategoryData $warehouse_category;
    public int $quantity;
    public $date_given;
    public $entry_date;
}
