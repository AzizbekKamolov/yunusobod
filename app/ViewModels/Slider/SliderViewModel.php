<?php
declare(strict_types=1);
namespace App\ViewModels\Slider;

use Akbarali\ViewModel\BaseViewModel;
use Illuminate\Support\Carbon;

class SliderViewModel extends BaseViewModel
{
    public int $id;
    public array $title;
    public ?string $titleH;
    public ?string $title_uz;
    public ?string $title_ru;
    public ?string $title_en;
    public array $content;
    public ?string $contentH;
    public ?string $content_uz;
    public ?string $content_ru;
    public ?string $content_en;
    public array $body;
    public ?string $bodyH;
    public ?string $body_uz;
    public ?string $body_ru;
    public ?string $body_en;
    public string $file;
    public int $order;
    public bool $active = true;
    public ?string $activeName;
    public string|Carbon $created_at;
    protected function populate():void
    {
        $this->title_uz = $this->trans($this->title, 'uz');
        $this->content_uz = $this->trans($this->content, 'uz');
        $this->body_uz = $this->trans($this->body, 'uz');

        $this->title_ru = $this->trans($this->title, 'ru');
        $this->content_ru = $this->trans($this->content, 'ru');
        $this->body_ru = $this->trans($this->body, 'ru');

        $this->title_en = $this->trans($this->title, 'en');
        $this->content_en = $this->trans($this->content, 'en');
        $this->body_en = $this->trans($this->body, 'en');

        $this->titleH = $this->trans($this->title);
        $this->contentH = $this->trans($this->content);
        $this->bodyH = $this->trans($this->body);
        $this->activeName = $this->active ? trans('form.active') : trans('form.inactive');
//        $this->created_at = $this->created_at->format('d-m-Y H-i');
    }
}
