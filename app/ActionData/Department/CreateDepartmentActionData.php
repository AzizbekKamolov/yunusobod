<?php
declare(strict_types = 1);
namespace App\ActionData\Department;

use Akbarali\ActionData\ActionDataBase;

class CreateDepartmentActionData extends ActionDataBase
{
    public ?int $id = null;
    public ?array $name;

    protected array $rules = [
        'name' => 'required|array|max:255',
        'name.*' => 'required|string|max:255',
    ];
}
