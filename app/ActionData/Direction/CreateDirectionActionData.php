<?php
declare(strict_types=1);

namespace App\ActionData\Direction;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class CreateDirectionActionData extends ActionDataBase
{
    public ?UploadedFile $icon;
    public ?array $title;
    public int $status = 1;
    public ?array $description;
    public ?UploadedFile $photo;

    protected array $rules = [
        'icon' => "nullable|mimes:jpeg,png,jpg,gif,svg|max:10000",
        'photo' => "nullable|mimes:jpeg,png,jpg,gif,svg|max:10000",
        'title' => "required|array",
        'title.uz' => "required",
        'description' => "required|array",
        'description.uz' => "required",
    ];
}
