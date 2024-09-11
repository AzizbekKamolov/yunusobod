<?php
declare(strict_types=1);
namespace App\ViewModels\Employee;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Admin\Branch\BranchViewModel;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use App\ViewModels\Admin\Position\PositionViewModel;
use App\ViewModels\File\FileViewModel;
use Carbon\Carbon;

class EmployeeViewModel extends BaseViewModel
{
    public int $id;
    public string $fullname;
    public string $username;
    public string $pinfl;
    public string $birthdate;
    public string $passport;
    public ?string $photo;
    public ?string $created_at;
    public $files  = [];
    public $file = null ;
    public $department = null;
    public $branch = null ;
    public  $position = null ;
    protected function populate():void
    {
//        dd($this);
        $this->created_at = Carbon::parse($this->created_at)->format('d-m-y H:i');
        if (isset($this->branch)){
            $this->branch = new BranchViewModel($this->branch);
        }
        $this->department = DepartmentViewModel::fromDataObject($this->department);
        $this->position =  PositionViewModel::fromDataObject($this->position);


        $this->file = $this->files[0] ?? null;

    }
}
