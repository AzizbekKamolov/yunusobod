<?php

namespace App\DataObjects\Medical\MedicalOrder;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\File\FileData;

class UpdateMedicalOrderData extends DataObjectBase
{
    public int $id;
    public ?string $content;
    public ?string $description;
    public ?string $date;
    public ?array $order_employees;
    public array| FileData $files;

}
