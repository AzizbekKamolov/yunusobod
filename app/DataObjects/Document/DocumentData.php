<?php
declare(strict_types=1);
namespace App\DataObjects\Document;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\File\FileData;
use App\DataObjects\FileCategory\FileCategoryData;
class DocumentData extends DataObjectBase
{
    public int $id;
    public array $title;
    public int $file_category_id;
    public ?FileCategoryData $category;
    public array| FileData $files;
    public ?string $created_at;
}
