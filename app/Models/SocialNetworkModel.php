<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property string $name;
 * @property string $icon;
 * @property string $url;
 * @property bool $status;
 * @property int $order;
 * @property string $created_at;
 * @property string $updated_at;
 */
class SocialNetworkModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'social_networks';
    protected $fillable = [
        "id",
        "name",
        "icon",
        "url",
        "status",
        "order",
        "created_at",
        "updated_at",
    ];
}
