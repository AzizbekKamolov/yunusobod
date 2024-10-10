<?php
declare(strict_types=1);

namespace App\DataObjects\Request;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class RequestData extends DataObjectBase
{
    public int $id;
    public ?string $fio;
    public ?string $email;
    public ?string $phone;
    public ?string $title;
    public ?string $content;
    public ?int $status;
    public ?string $created_at;
}
