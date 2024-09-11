<?php
declare(strict_types=1);
namespace App\ViewModels\FileCategory;


use Akbarali\ViewModel\BaseViewModel;

class FileCategoryViewModel extends BaseViewModel
{
    public int $id;
    public ?array $name;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $hname;
    public $documents = null;
    protected function populate():void
    {
        $this->name_uz = $this->trans($this->name,'uz');
        $this->name_ru = $this->trans($this->name,'ru');
        $this->hname = $this->trans($this->name);
        $this->documents = count($this->documents);
    }
}