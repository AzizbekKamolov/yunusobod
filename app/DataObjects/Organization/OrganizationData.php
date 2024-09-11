<?php
declare(strict_types=1);
namespace App\DataObjects\Organization;
use Akbarali\DataObject\DataObjectBase;

class OrganizationData extends DataObjectBase {
    public int $id;
    public string $name;
    public ?string $address;
    public ?string $description;

    public string $phone;
    public  $created_at;
}
