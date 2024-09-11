<?php

namespace App\DataObjects\File;

use Akbarali\DataObject\DataObjectBase;

class FileData extends DataObjectBase
{
    public ?int $id;
    public ?string $path;
    public ?string $lang;
    public ?string $type;
    public ?float $size;
    public string $uploaded_at;
}
