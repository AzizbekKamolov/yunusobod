<?php
declare(strict_types=1);

namespace App\ActionData\Direction;

use Akbarali\ActionData\ActionDataBase;

class UpdateDirectionActionData extends ActionDataBase
{
    public ?array $title;
    public ?array $description;
    public ?bool $status = false;

    protected array $rules = [
        'title' => "required|array",
        'title.uz' => "required",
        'description' => "required|array",
        'status' => "bool",
        'description.uz' => "required",
    ];
}
