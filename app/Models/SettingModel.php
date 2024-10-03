<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property string $name;
 * @property array $value;
 * @property string $created_at;
 * @property string $updated_at;
 *
 */
class SettingModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'settings';
    protected $fillable = [
        'id',
        'name',
        'value',
        'created_at',
        'updated_at',
    ];
}
