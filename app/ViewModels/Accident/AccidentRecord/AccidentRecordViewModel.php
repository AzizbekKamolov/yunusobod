<?php

namespace App\ViewModels\Accident\AccidentRecord;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Accident\AccidentType\AccidentTypeViewModel;
use App\ViewModels\File\FileViewModel;
use Carbon\Carbon;

class AccidentRecordViewModel extends BaseViewModel
{
    public int $id;
    public ?array $name;
    public $accidentType;
    public $employee;
    public $files;
    public ?string $begin_date;
    public ?string $hname;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $end_date;

    protected function populate():void
    {
        $this->accidentType = AccidentTypeViewModel::fromDataObject($this->accidentType);
        $this->begin_date = Carbon::parse($this->begin_date)->format('Y-m-d');
        $this->end_date = Carbon::parse($this->end_date)->format('Y-m-d');
        $this->hname = $this->trans($this->name);
        $this->name_uz = $this->trans($this->name,'uz');
        $this->name_ru = $this->trans($this->name,'ru');
    }
}
