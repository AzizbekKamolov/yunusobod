<?php
declare(strict_types=1);
namespace App\ActionData\FileCategory;


use Akbarali\ActionData\ActionDataBase;

class CreateFileCategoryActionData extends ActionDataBase
{
    public ?int $id ;

    public ?array $name;

    protected  array $rules = [
        "name" => "required|array|max:255",
        'name.*' => "required|string|max:255",
    ];
}
