<?php

namespace App\ViewModels\Warehouse\WarehouseCategory\Api;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class WarehouseCategoryViewModel extends BaseViewModel
{
    public int $id;
    public array $name;
    public ?string $hname;
    public $warehouses;
    public $y = 0;
    protected function populate():void
    {
        $this->hname = $this->trans($this->name);
        foreach ($this->warehouses as $warehouse){
            $this->y += $warehouse['remaining_quantity'];
        }
    }
}
