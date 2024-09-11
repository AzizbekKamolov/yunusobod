<?php

namespace App\ActionData\Warehouse\EmployeeProduct;

use Akbarali\ActionData\ActionDataBase;

class EmployeeProductActionData extends ActionDataBase
{
    public ?int $id ;
    public ?int $employee_id;
    public int $warehouse_id;
    public int $warehouse_category_id;
    public ?string $description;
    public ?int $quantity;
    public ?string $date_given;
    public ?string $entry_date;

    public function  prepare():void
    {
        $this->rules = [
            'employee_id' => 'required|int|exists:employees,id',
            'warehouse_id' => 'required|int|exists:warehouses,id',
            'warehouse_category_id' => 'required|int|exists:warehouse_categories,id',
            'quantity' => 'required|int|min:1',
            'date_given' => 'required|date|before:entry_date',
            'entry_date' => 'required|string|after:date_given',
            'description' => 'nullable|string'
        ];
    }
}
