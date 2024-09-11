<?php
namespace App\DataObjects\Employees\Medical;
use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\File\FileData;

class MedicalOrderData extends  DataObjectBase
{
    public int $id;
    public ?string $content;
    public ?string $date;
    public array|MedicalResultForEmployeeData $medical_results;
    public array|FileData $files;
}
