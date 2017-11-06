<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Selection
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $recipe_id
 * @property Carbon $bought_at
 * @property Carbon $cooked_at
 * @method static Builder forUser(string $username)
 */
class Selection extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'recipe_id',
        'bought_at',
        'cooked_at',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'user_id',
        'recipe_id',
        'updated_at'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'bought_at' => 'dateTime',
        'cooked_at' => 'dateTime',
    ];

    /**
     * @var array
     */
    protected $with = [
        'recipe',
    ];

    /**
     * @return BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $query
     * @param string $username
     * @return Builder
     */
    public function scopeForUser(Builder $query, $username)
    {
        return $query->whereHas('user', function (Builder $query) use ($username) {
            return $query->where('username', $username);
        });
    }
}