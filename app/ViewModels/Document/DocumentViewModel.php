<?php

namespace App\ViewModels\Document;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\FileCategory\FileCategoryViewModel;

class DocumentViewModel extends BaseViewModel
{
    public int $id;
    public array $title;
    public ?string $title_uz;
    public ?string $title_ru;
    public ?string $htitle;
    public ?int $file_category_id;

    public $category ;
    public ?string $category_name ;
    public $files = [];
    protected function populate(): void
    {
        $this->title_uz = $this->trans($this->title, 'uz');
        $this->title_ru = $this->trans($this->title, 'ru');
        $this->htitle = $this->trans($this->title);
        $this->files = count($this->files);
        if ($this->category){

            $this->category_name =$this->trans($this->category->name) ;
        }

    }
}
