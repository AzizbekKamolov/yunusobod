<?php

namespace App\DataObjects\Medical\MedicalOrder;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\File\FileData;

class MedicalOrderData extends DataObjectBase
{
    public int $id;
    public ?string $content;
    public ?string $description;
    public ?string $date;
    public ?int $order_employees_count;
    public ?int $medical_results_count = 0;
    public array| FileData $files;



}
