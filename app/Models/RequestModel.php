<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property string $fio;
 * @property string $email;
 * @property string $phone;
 * @property string $title;
 * @property string $content;
 * @property int $status;
 * @property string $created_at;
 * @property string $updated_at;
 */
class RequestModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'requests';
    protected $fillable = [
        "id",
        "fio",
        "email",
        "phone",
        "title",
        "content",
        "status",
        "created_at",
        "updated_at",
    ];
}
