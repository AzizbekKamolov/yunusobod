<?php
declare(strict_types=1);
namespace App\ViewModels\Employees\Warehouse;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Warehouse\WarehouseCategory\WarehouseCategoryViewModel;
use Carbon\Carbon;

class EmployeeProductViewModel extends BaseViewModel
{

    public int $id;
    public int $warehouse_category_id;
    public int $quantity;
    public $warehouse;
    public $warehouse_category;
    public $date_given;
    public $entry_date;
    protected function populate():void
    {
        $this->date_given = Carbon::parse($this->date_given)->format('d-m-y');
        $this->entry_date = Carbon::parse($this->entry_date)->format('d-m-y');
        $this->warehouse_category = WarehouseCategoryViewModel::fromDataObject($this->warehouse_category);
        $this->warehouse = WarehouseViewModel::fromDataObject($this->warehouse);
    }
}
