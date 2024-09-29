<?php
declare(strict_types=1);
namespace App\ViewModels\Page;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class PageViewModel extends BaseViewModel
{
    public int $id;
    public string $action;
    public ?string $photo;
    public ?string $description;
    public ?string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;
    public string|Carbon $created_at;

    protected function populate():void
    {
        $lang = app()->getLocale();
        if (isset($this->{"description_" . $lang})){
            $this->description = $this->{"description_" . $lang};
        }
//        $this->created_at = $this->created_at->format('d-m-Y H-i');
    }
}
