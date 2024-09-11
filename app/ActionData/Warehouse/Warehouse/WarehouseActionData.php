<?php
declare(strict_types=1);

namespace App\ActionData\Warehouse\Warehouse;

use Akbarali\ActionData\ActionDataBase;

class WarehouseActionData extends ActionDataBase
{
    public array $name;
    public ?string $description_ru;
    public ?string $description_uz;
    public ?int $quantity = 1;
    public ?int $remaining_quantity = 1;
    public ?int $warehouse_category_id;
    public ?int $organization_id = 1;
    public ?string $date_entered;
    public ?string $expiry_date;

    public function prepare(): void
    {
        $this->rules = [
            'name' => "required|array",
            'name.ru' => "required|string",
            'name.uz' => "required|string",
            'quantity' => "required|int|min:1",
            'warehouse_category_id' => "required|exists:warehouse_categories,id",
            'date_entered' => "required|date",
            'expiry_date' => "nullable|date|after:date_entered",
        ];
        $this->remaining_quantity = $this->quantity;
    }
}
