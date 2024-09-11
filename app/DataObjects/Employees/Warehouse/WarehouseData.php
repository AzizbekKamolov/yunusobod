<?php

namespace App\DataObjects\Employees\Warehouse;

use Akbarali\DataObject\DataObjectBase;

class WarehouseData extends DataObjectBase
{
    public int $id;
    public array $name;
    public ?string $description_ru;
    public ?string $description_uz;
    public int $quantity = 1;
    public int $remaining_quantity = 1;
}
