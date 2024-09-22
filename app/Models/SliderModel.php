<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property array $title;
 * @property array $content;
 * @property array $body;
 * @property int $order;
 * @property boolean $active;
 * @property string $file;
 * @property string $created_at;
 * @property string $updated_at;
 */
class SliderModel extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'sliders';
    protected $fillable = [
      'title',
      'content',
      'body',
      'order',
      'file',
      'active',
      'created_at',
      'updated_at',
    ];
    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'body' => 'array',
    ];
}
