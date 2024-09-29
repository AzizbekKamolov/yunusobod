<?php
declare(strict_types=1);

namespace App\ActionData\Direction;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class UpdateDirectionActionData extends ActionDataBase
{
    public ?UploadedFile $icon;
    public ?array $title;
    public ?array $description;
    public ?bool $status = false;
    public ?UploadedFile $photo;

    protected array $rules = [
        'icon' => "nullable|mimes:jpeg,png,jpg,gif,svg|max:10000",
        'photo' => "nullable|mimes:jpeg,png,jpg,gif,svg|max:10000",
        'title' => "required|array",
        'title.uz' => "required",
        'description' => "required|array",
        'status' => "bool",
        'description.uz' => "required",
    ];
}
