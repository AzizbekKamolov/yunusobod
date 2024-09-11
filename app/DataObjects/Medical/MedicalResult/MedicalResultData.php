<?php
declare(strict_types=1);
namespace App\DataObjects\Medical\MedicalResult;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\File\FileData;
use App\DataObjects\Medical\MedicalStatus\MedicalStatusData;

class MedicalResultData extends DataObjectBase
{
    public ?int $id;
    public ?int $employee_id;
    public ?int $medical_order_id;
    public ?string $date;
    public ?int $medical_status_id;
    public array|FileData $files;
}
