<?php
declare(strict_types=1);
namespace App\ViewModels\Medical\MedicalStatus;
use Akbarali\ViewModel\BaseViewModel;

class MedicalStatusViewModel extends BaseViewModel
{
    public int $id;
    public array $name;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $hname;
    public $medical_results = [];
    protected function populate()
    {
        $this->hname = $this->trans($this->name);
        $this->name_uz = $this->trans($this->name,'uz');
        $this->name_uz = $this->trans($this->name,'ru');
        $this->medical_results = count($this->medical_results);
    }
}
