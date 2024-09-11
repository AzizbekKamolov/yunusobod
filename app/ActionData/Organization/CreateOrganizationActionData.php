<?php
declare(strict_types=1);
namespace App\ActionData\Organization;

use Akbarali\ActionData\ActionDataBase;

class CreateOrganizationActionData extends ActionDataBase
{
    public ?int $id ;
    public ?string $name;
    public ?string $address;

    public ?string $description = null;

    public string $phone;

    protected array $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'description' => 'string|max:255',
        'phone' => 'required|string|max:20',
    ];
}
