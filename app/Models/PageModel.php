<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $action
 * @property string $photo
 * @property string $description_uz
 * @property string $description_ru
 * @property string $description_en
 */
class PageModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'pages';
    protected $fillable = [
        'id',
        'action',
        'photo',
        'description_uz',
        'description_ru',
        'description_en',
    ];
}
