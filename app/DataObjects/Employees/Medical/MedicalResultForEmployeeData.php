<?php

namespace App\DataObjects\Employees\Medical;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\File\FileData;
use Carbon\Carbon;

class MedicalResultForEmployeeData extends DataObjectBase
{
    public int $id;
    public string $date;
    public  int $medical_status_id;
    public array|FileData $files;
}
