<?php
declare(strict_types=1);
namespace App\DataObjects\Accident\AccidentRecord;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\Accident\AccidentType\AccidentTypeData;
use App\DataObjects\Employee\EmployeeData;
use App\DataObjects\File\FileData;

class AccidentRecordData extends DataObjectBase
{
    public int $id;
    public ?array $name;
    public ?AccidentTypeData $accidentType;
    public ?EmployeeData $employee;
    public array|FileData $files;
    public ?string $begin_date;
    public ?string $end_date;
}
