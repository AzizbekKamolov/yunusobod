<?php
declare(strict_types = 1);
namespace App\ActionData\Warehouse\WarehouseCategory;

use Akbarali\ActionData\ActionDataBase;

class WarehouseCategoryActionData extends ActionDataBase
{
    public ?array $name;
    public ?int $organization_id = 1;

    protected array $rules = [
        'name' => "required|array",
    ];
}
