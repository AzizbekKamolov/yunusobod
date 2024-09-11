<?php
declare(strict_types=1);
namespace App\ViewModels\Employee;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Admin\Branch\BranchViewModel;
use App\ViewModels\Admin\Department\DepartmentViewModel;
use App\ViewModels\Admin\Position\PositionViewModel;
use App\ViewModels\Medical\MedicalResult\MedicalResultViewModel;
use Carbon\Carbon;

class EmployeeWithMedicalResultViewModel extends BaseViewModel
{
    public int $id;
    public string $fullname;
    public string $pinfl;
    public string $birthdate;
    public string $passport;
    public ?string $created_at;
    public $medicalResult = null;
    public $department = null;
    public $branch = null ;
    public  $position = null ;
    protected function populate():void
    {
//        dd($this);
        $this->created_at = Carbon::parse($this->created_at)->format('d-m-y H:i');
        $this->department = DepartmentViewModel::fromDataObject($this->department);
        $this->branch = new BranchViewModel($this->branch);
        $this->position =  PositionViewModel::fromDataObject($this->position);
        if ($this->medicalResult) {
            $this->medicalResult = MedicalResultViewModel::fromDataObject($this->medicalResult);
        }
    }
}
