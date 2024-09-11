<?php

namespace App\ViewModels\Accident\AccidentType;
class AccidentTypeViewModel extends \Akbarali\ViewModel\BaseViewModel
{

    public int $id;
    public array $name;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $hname;
    public $accidentRecords = [];
    protected function populate()
    {
        $this->hname = $this->trans($this->name);
        $this->name_uz = $this->trans($this->name,'uz');
        $this->name_uz = $this->trans($this->name,'ru');
        $this->accidentRecords = count($this->accidentRecords);
    }
}
