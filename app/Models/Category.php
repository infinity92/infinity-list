<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property Carbon $start_date
 * @property Carbon $notification
 * @property Carbon $deadline
 * @property Carbon $completion_date
 * @property string $completion_status
 * @property int $sort
 * @property boolean $is_complete
 * @property boolean $is_someday
 * @property Collection $tasks
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'notification',
        'deadline',
        'sort',
        'is_someday',
    ];

    protected $dates = [
        'start_date',
        'notification',
        'deadline',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id', 'id');
    }
}
