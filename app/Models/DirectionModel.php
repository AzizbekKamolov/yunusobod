<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property array $title;
 * @property array $description;
 * @property int $status;
 * @property int $order;
 * @property string $created_at;
 */
class DirectionModel extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'directions';
    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'order',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
      "title" => "array",
      "description" => "array"
    ];
}
