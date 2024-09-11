<?php

namespace App\DataObjects\Employees\Accident;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\File\FileData;

class AccidentRecordData extends DataObjectBase
{

    public int $id;
    public ?array $name;
    public int $accident_type_id;
    public array|FileData $files;
    public ?string $begin_date;
    public ?string $end_date;
}
