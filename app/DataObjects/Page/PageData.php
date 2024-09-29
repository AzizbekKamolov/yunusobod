<?php
declare(strict_types=1);

namespace App\DataObjects\Page;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class PageData extends DataObjectBase
{
    public int $id;
    public string $action;
    public ?string $photo;
    public ?string $description_uz;
    public ?string $description_ru;
    public ?string $description_en;

    public Carbon $created_at;
}
