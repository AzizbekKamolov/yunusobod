<?php
declare(strict_types=1);
namespace App\DataObjects\Slider;

use Akbarali\DataObject\DataObjectBase;
use Illuminate\Support\Carbon;

class SliderData extends  DataObjectBase
{
    public int $id;
    public array $title;
    public array $content;
    public array $body;
    public string $file;
    public int $order;
    public bool $active = true;
    public string $created_at;
}
