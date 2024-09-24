<?php
declare(strict_types=1);

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id;
 * @property string $fio;
 * @property int $direction_id;
 * @property int $experience;
 * @property array $about;
 * @property bool $status;
 * @property int $order;
 * @property string $crated_at;
 * @property string $updated_at;
 */
class EmployeeModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'employee';
    protected $fillable = [
        'id',
        'fio',
        'direction_id',
        'experience',
        'about',
        'status',
        'order',
        'created_at',
        'updated_at',
    ];

    public function direction(): BelongsTo
    {
        return $this->belongsTo(DirectionModel::class, 'direction_id');
    }
}
