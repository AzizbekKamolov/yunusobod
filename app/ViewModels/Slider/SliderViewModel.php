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
    public array $content;
    public ?string $contentH;
    public array $body;
    public ?string $bodyH;
    public string $file;
    public int $order;
    public bool $active = true;
    public ?string $activeName;
    public string|Carbon $created_at;
    protected function populate():void
    {
        $this->titleH = $this->trans($this->title);
        $this->contentH = $this->trans($this->content);
        $this->bodyH = $this->trans($this->body);
        $this->activeName = $this->active ? trans('form.active') : trans('form.inactive');
//        $this->created_at = $this->created_at->format('d-m-Y H-i');
    }
}
