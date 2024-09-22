<?php
declare(strict_types=1);

namespace App\ActionData\Slider;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class SliderActionData extends ActionDataBase
{
    public ?array $title = [];
    public ?array $content = [];
    public ?array $body = [];
    public ?UploadedFile $file = null;
    public ?int $order = 1;
    public ?bool $active = true;

    protected array $rules = [
        'title' => "required|array",
        'title.*' => "required",
        'content' => "required|array",
        'content.*' => "required",
        'body' => "required|array",
        'body.*' => "required",
        'active' => "required|bool",
        'file' => "required|mimes:jpeg,png,jpg,gif,svg|max:10000",
    ];
}
