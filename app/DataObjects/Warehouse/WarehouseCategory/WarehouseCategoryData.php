<?php
declare(strict_types=1);
namespace App\DataObjects\Warehouse\WarehouseCategory;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class WarehouseCategoryData extends  DataObjectBase
{
    public int $id;
    public array $name;
    public $warehouses;
    public Carbon $created_at;
}
