<?php
declare(strict_types = 1);
namespace App\ActionData\Page;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class CreatePageActionData extends ActionDataBase
{
    public ?string $action;
    public ?UploadedFile $photo;
    public ?string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;

    protected array $rules = [
        'action' => "required|string",
        'description_uz' => "required|string",
        'description_ru' => "required|string",
        'description_en' => "required|string",
    ];
}
