<?php

namespace App\ActionData\Warehouse\Warehouse;

use Akbarali\ActionData\ActionDataBase;

class ExportWarehouseActionData extends ActionDataBase
{
    public ?string $select = null;
    public ?string $from;
    public ?string $to;
    protected array $rules = [
        'from' => 'required|before:to',
        'to' => 'required|after:from',
    ];
}
