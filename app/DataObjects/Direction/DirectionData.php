<?php
declare(strict_types=1);

namespace App\DataObjects\Direction;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class DirectionData extends DataObjectBase
{
    public int $id;
    public array $title;
    public array $description;
    public int $status;
    public int $order;
    public Carbon $created_at;
}
