<?php
declare(strict_types=1);

namespace App\ActionData\Direction;

use Akbarali\ActionData\ActionDataBase;

class CreateDirectionActionData extends ActionDataBase
{
    public ?array $title;
    public int $status = 1;
    public ?array $description;

    protected array $rules = [
        'title' => "required|array",
        'title.uz' => "required",
        'description' => "required|array",
        'description.uz' => "required",
    ];
}
