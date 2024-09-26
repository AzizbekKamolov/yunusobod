<?php
declare(strict_types=1);

namespace App\DataObjects\Employee;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class EmployeeData extends DataObjectBase
{
    public int $id;
    public string $fio;
    public string $photo;
    public int $direction_id;
    public int $experience;
    public array $about;
    public bool $status;
    public int $order;
    public ?Carbon $created_at;
    public ?string $updated_at;
}
