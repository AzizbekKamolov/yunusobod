<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property string $name;
 * @property string $photo;
 * @property array $about;
 * @property int $order;
 * @property bool $status;
 * @property string $created_at;
 * @property string $updated_at;
 */
class PartnerModel extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'partners';
    protected $fillable = [
      "id",
      "name",
      "photo",
      "about",
      "order",
      "status",
      "created_at",
      "updated_at",
    ];
}
