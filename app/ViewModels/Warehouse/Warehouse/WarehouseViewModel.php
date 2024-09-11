<?php

namespace App\ViewModels\Warehouse\Warehouse;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Warehouse\EmployeeProduct\EmployeeProductViewModel;
use App\ViewModels\Warehouse\WarehouseCategory\WarehouseCategoryViewModel;
use Carbon\Carbon;

class WarehouseViewModel extends BaseViewModel
{
    public int $id;
    public array $name;
    public ?string $hname;
    public ?string $name_uz;
    public ?string $name_ru;

    public ?string $description_ru;
    public ?string $description_uz;
    public int $quantity = 1;
    public $warehouse_category;
    public int $remaining_quantity = 1;
    public int $warehouse_category_id;
    public ?int $organization_id = 1;
    public string $date_entered;
    public ?string $expiry_date;
    public Carbon|string $created_at = "";

    protected function populate(): void
    {
        $this->created_at = $this->created_at->format('d-m-Y H-i');
        $this->hname = $this->trans($this->name);
        $this->name_uz = $this->trans($this->name,'uz');
        $this->name_ru = $this->trans($this->name,'ru');
        $this->warehouse_category = WarehouseCategoryViewModel::fromDataObject($this->warehouse_category);
    }
}
