<?php

namespace App\ViewModels\Warehouse\EmployeeProduct;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Employee\EmployeeWithProductViewvModel;
use App\ViewModels\Warehouse\WarehouseCategory\WarehouseCategoryViewModel;

class EmployeeProductViewModel extends BaseViewModel
{
    public int $id ;
    public int $employee_id;
    public int $warehouse_id;
    public int $warehouse_category_id;
    public ?string $description;
    public int $quantity;
    public ?string $date_given;
    public  $employee;
    public $warehouse_category;
    public ?string $entry_date;
    protected function populate()
    {
        $this->employee = EmployeeWithProductViewvModel::fromDataObject($this->employee);
    }
}
