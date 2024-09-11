<?php
declare(strict_types=1);
namespace App\DataObjects\Warehouse\Warehouse;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Warehouse\EmployeeProduct\EmployeeProductData;
use App\DataObjects\Warehouse\WarehouseCategory\WarehouseCategoryData;
use Carbon\Carbon;

class WarehouseData extends  DataObjectBase
{
    public int $id;
    public array $name;
    public ?string $description_ru;
    public ?string $description_uz;
    public int $quantity = 1;
    public int $remaining_quantity = 1;
    public int $warehouse_category_id;
    public ?WarehouseCategoryData $warehouse_category;
    public ?int $organization_id = 1;
    public string $date_entered;
    public ?string $expiry_date;
    public Carbon $created_at;
}
