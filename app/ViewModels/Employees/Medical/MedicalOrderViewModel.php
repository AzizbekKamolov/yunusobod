<?php

declare(strict_types=1);
namespace App\ViewModels\Employees\Medical;
use Carbon\Carbon;

class MedicalOrderViewModel extends \Akbarali\ViewModel\BaseViewModel
{

    public int $id;
    public ?string $content;
    public ?string $date;
    public $medical_results;
    public  $files;
    protected function populate():void
    {
       $this->date = Carbon::parse($this->date)->format('d-m-y');
    }
}
