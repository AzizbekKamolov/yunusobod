<?php
declare(strict_types=1);

namespace App\ActionData\Slider;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class UpdateSliderActionData extends ActionDataBase
{
    public ?array $title = [];
    public ?array $content = [];
    public ?array $body = [];
    public ?UploadedFile $file = null;
    public ?bool $active = false;

    protected array $rules = [
        'title' => "required|array",
        'title.*' => "required",
        'content' => "required|array",
        'content.*' => "required",
        'body' => "required|array",
        'body.*' => "required",
        'active' => "required|bool",
        'file' => "nullable|mimes:jpeg,png,jpg,gif,svg|max:10000",
    ];
}
