<?php
declare(strict_types=1);
namespace App\DataObjects\Medical\MedicalStatus;
use Akbarali\DataObject\DataObjectBase;

class MedicalStatusData extends DataObjectBase
{
    public int $id;
    public array $name;
    public $medical_results;
}
