<?php
declare(strict_types=1);
namespace App\DataObjects\Partner;

use Akbarali\DataObject\DataObjectBase;
use Illuminate\Support\Carbon;

class PartnerData extends  DataObjectBase
{
    public int $id;
    public ?string $name;
    public ?string $photo;
    public ?array $about;
    public ?bool $status = true;
    public string $created_at;
}
