<?php
declare(strict_types=1);
namespace App\ViewModels\Employee;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Admin\Branch\BranchViewModel;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use App\ViewModels\Admin\Position\PositionViewModel;
use Carbon\Carbon;

class EmployeeExamAttemptViewModel extends BaseViewModel
{
    public int $id;
    public string $fullname;
    public string $username;
    public string $pinfl;
    public string $birthdate;
    public string $passport;
    public ?string $created_at;
    public $department = null;
    public $branch = null ;
    public  $position = null ;
    public $employeeExamAttempts;
    protected function populate():void
    {
//        dd($this);
        $this->created_at = Carbon::parse($this->created_at)->format('d-m-y H:i');
        if (isset($this->branch)){
            $this->branch = BranchViewModel::fromDataObject($this->branch);
        }
        if (isset($this->position)){
            $this->position = PositionViewModel::fromDataObject($this->position);
        }
    }
}
