<?php
declare(strict_types=1);
namespace App\DataObjects\FileCategory;

use Akbarali\DataObject\DataObjectBase;

class FileCategoryData extends DataObjectBase
{
    public int $id;
    public ?array $name;
    public $documents = [];
}
