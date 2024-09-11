<?php

namespace App\ViewModels\Medical\MedicalOrder;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class MedicalOrderViewModel extends BaseViewModel
{
    public ?int $id;
    public ?string $content;
    public ?string $description;
    public ?string $date;
    public ?int  $order_employees_count ;
    public ?int  $medical_results_count ;
    public ?int $orderable_id;
    public $files ;

    public ?string $orderable_type;
    protected function populate():void
    {
        $this->date = Carbon::parse($this->date)->format('d-m-Y');
    }
}
