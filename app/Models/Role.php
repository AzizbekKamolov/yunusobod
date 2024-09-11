<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as RoleModel;

/**
 * @property string $name
 * @property string $guard_name
 */

class Role extends RoleModel
{
    use HasFactory ,EloquentFilterTrait;

    protected $fillable = [
        'name',
        'guard_name',
    ];
}
