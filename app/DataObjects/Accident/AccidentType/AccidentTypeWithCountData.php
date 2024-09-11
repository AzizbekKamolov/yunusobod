<?php

namespace App\DataObjects\Accident\AccidentType;

use Akbarali\DataObject\DataObjectBase;

class AccidentTypeWithCountData extends DataObjectBase
{

    public  int $id;
    public  array $name;
    public int $accidentRecords_count;
}
