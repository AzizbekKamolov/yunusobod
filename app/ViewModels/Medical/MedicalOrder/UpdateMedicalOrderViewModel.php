<?php

namespace App\ViewModels\Medical\MedicalOrder;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class UpdateMedicalOrderViewModel extends BaseViewModel
{
    public ?int $id;
    public ?string $content;
    public ?string $description;
    public ?string $date;
    public  $order_employees = [] ;
    public $files ;

    public ?string $orderable_type;
    protected function populate():void
    {
        $this->date = Carbon::parse($this->date)->format('Y-m-d');
    }
}