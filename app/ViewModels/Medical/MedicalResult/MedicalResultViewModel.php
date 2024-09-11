<?php
declare(strict_types=1);
namespace App\ViewModels\Medical\MedicalResult;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Medical\MedicalStatus\MedicalStatusViewModel;
use Carbon\Carbon;

class MedicalResultViewModel extends BaseViewModel
{
    public ?int $id;
    public ?int $employee_id;
    public ?int $medical_order_id;
    public ?string $date;
    public $medical_status = null;
    public $medical_status_id;
    public $files;
    protected function populate()
    {
//        $this->medical_status = MedicalStatusViewModel::fromDataObject($this->medical_status);
        $this->date = Carbon::parse($this->date)->format('Y-m-d');
    }
}
