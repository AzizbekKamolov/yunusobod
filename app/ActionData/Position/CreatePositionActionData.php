<?php
declare(strict_types = 1);
namespace App\ActionData\Position;

use Akbarali\ActionData\ActionDataBase;

class CreatePositionActionData extends ActionDataBase{

    public ?int $id;

    public ?array $name;

    public ?int $department_id;

    protected array $rules = [
        'name' => "required|array|max:255",
        'name.*' => "required|string|max:255",
        'department_id' => "required|int|exists:departments,id",
    ];
}
