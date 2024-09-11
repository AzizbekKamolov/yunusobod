<?php
declare(strict_types=1);
namespace App\ViewModels\Warehouse\WarehouseCategory;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class WarehouseCategoryViewModel extends BaseViewModel
{
    public int $id;
    public array $name;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $hname;
    public $warehouses = [];
    public $all_quantity = 0;
    public $all_remaining = 0;
    public Carbon|string $created_at = "";
    protected function populate():void
    {
        $this->created_at = $this->created_at->format('d-m-Y H-i');
        $this->name_uz = $this->trans($this->name,'uz');
        $this->name_ru = $this->trans($this->name,'ru');
        $this->hname = $this->trans($this->name);
        foreach ($this->warehouses as $warehouse){
            $this->all_remaining += $warehouse['remaining_quantity'];
        }
        foreach ($this->warehouses as $warehouse){
            $this->all_quantity += $warehouse['quantity'];
        }
    }
}
