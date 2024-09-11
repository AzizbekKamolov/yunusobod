<?php

namespace App\ViewModels\Employee;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Admin\Branch\BranchViewModel;
use App\ViewModels\Admin\Position\PositionViewModel;
use Carbon\Carbon;

class EmployeeWithProductViewvModel extends BaseViewModel
{

    public int $id;
    public string $fullname;
    public string $pinfl;
    public string $birthdate;
    public string $passport;
    public ?string $created_at;
    public $branch = null ;
    public  $position = null ;
    protected function populate():void
    {
        $this->created_at = Carbon::parse($this->created_at)->format('d-m-y H:i');
        if (isset($this->branch)){
            $this->branch = new BranchViewModel($this->branch);
        }
        $this->position =  PositionViewModel::fromDataObject($this->position);

    }
}
