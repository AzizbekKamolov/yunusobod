<?php
declare(strict_types=1);
namespace App\DataObjects\Accident\AccidentType;

use Akbarali\DataObject\DataObjectBase;

class AccidentTypeData extends DataObjectBase
{
    public  int $id;
    public  array $name;
    public $accidentRecords;
}
