<?php

namespace App\ViewModels\Accident\AccidentType;

use Akbarali\ViewModel\BaseViewModel;

class AccidentTypeWithCountViewModel extends BaseViewModel
{
    public int $id;
    public array $name;
    public ?string $hname;
    public $accidentRecords_count;
    protected function populate()
    {
        $this->hname = $this->trans($this->name);
    }
}
