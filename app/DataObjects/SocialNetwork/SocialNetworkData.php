<?php
declare(strict_types=1);

namespace App\DataObjects\SocialNetwork;

use Akbarali\DataObject\DataObjectBase;
use Illuminate\Support\Carbon;

class SocialNetworkData extends DataObjectBase
{
    public int $id;
    public ?string $name;
    public ?string $icon;
    public ?string $url;
    public bool $status = true;
    public int $order;

    public Carbon $created_at;
}
