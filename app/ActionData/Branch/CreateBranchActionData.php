<?php
declare(strict_types=1);
namespace App\ActionData\Branch;
use Akbarali\ActionData\ActionDataBase;
use App\Models\Organization;

class CreateBranchActionData extends ActionDataBase
{
    public ?int $id = null;  // nullable if updating an existing record
    public ?string $name;
    public ?string $address;
    public ?int $organization_id = 1;

    protected array $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
    ];
}
