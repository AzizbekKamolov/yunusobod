<?php
declare(strict_types=1);

namespace App\ViewModels\Direction;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class DirectionViewModel extends BaseViewModel
{
    public int $id;
    public array $title;
    public ?string $titleH;
    public ?string $title_uz;
    public ?string $title_ru;
    public ?string $title_en;
    public array $description;
    public ?string $descriptionH;
    public ?string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;
    public int $status;
    public ?string $statusName;
    public int $order;
    public Carbon|string $created_at;

    protected function populate(): void
    {
        $this->titleH = $this->trans($this->title);
        $this->descriptionH = $this->trans($this->description);


        $this->title_en = $this->trans($this->title, 'en');
        $this->description_en = $this->trans($this->description, 'en');

        $this->title_ru = $this->trans($this->title, 'ru');
        $this->description_ru = $this->trans($this->description, 'ru');

        $this->title_uz = $this->trans($this->title, 'uz');
        $this->description_uz = $this->trans($this->description, 'uz');

        $this->created_at = $this->created_at->format('d-m-Y H-i');
        $this->statusName = $this->status ? trans('form.active') : trans('form.inactive');

    }
}
