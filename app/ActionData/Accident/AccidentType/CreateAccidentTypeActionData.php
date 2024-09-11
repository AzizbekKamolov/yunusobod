<?php
declare(strict_types=1);
namespace App\ActionData\Accident\AccidentType;
use Akbarali\ActionData\ActionDataBase;

class CreateAccidentTypeActionData extends ActionDataBase
{
    public ? int $id;
    public ?array $name;

    protected  array $rules = [
        'name' => 'required|array',
        'name.*' => 'required|string',
        'name.*uz' => 'required|string',
        'name.*ru' => 'required|string',
    ];
}
