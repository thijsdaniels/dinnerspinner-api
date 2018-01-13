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
 * @property Carbon $cooked_at
 * @property Carbon $canceled_at
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
        'cooked_at',
        'canceled_at',
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