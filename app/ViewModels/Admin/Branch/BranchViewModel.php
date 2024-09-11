<?php
declare(strict_types=1);
namespace App\ViewModels\Admin\Branch;


use Akbarali\ViewModel\BaseViewModel;

class BranchViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public string $address;
    public $employees = [];
    protected function populate():void
    {
        $this->employees = count($this->employees);
    }
}
