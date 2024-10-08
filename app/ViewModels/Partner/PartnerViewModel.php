<?php
declare(strict_types=1);

namespace App\ViewModels\Partner;

use Akbarali\ViewModel\BaseViewModel;

class PartnerViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public ?string $photo;
    public ?array $about;
    public ?string $aboutH;
    public ?string $about_uz;
    public ?string $about_ru;
    public ?string $about_en;
    public bool $status = true;
    public ?string $statusName;
    public ?string $created_at;

    protected function populate(): void
    {
        $this->aboutH = $this->trans($this->about);

        $this->about_uz = $this->trans($this->about, 'uz');
        $this->about_ru = $this->trans($this->about, 'ru');
        $this->about_en = $this->trans($this->about, 'en');

        $this->statusName = $this->status ? trans('form.active') : trans('form.inactive');
//        $this->created_at = $this->created_at->format('d-m-Y H-i');
    }
}
