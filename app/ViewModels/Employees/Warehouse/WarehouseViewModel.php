<?php

namespace App\ViewModels\Employees\Warehouse;

use Akbarali\ViewModel\BaseViewModel;

class WarehouseViewModel extends BaseViewModel
{

    public int $id;
    public array $name;
    public ?string $hname;
    public int $quantity = 1;
    public int $remaining_quantity = 1;

    protected function populate(): void
    {
        $this->hname = $this->trans($this->name);
    }
}
