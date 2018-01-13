<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Recipe
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $duration_preparation
 * @property int $duration_cooking
 * @property int $difficulty
 * @property float $rating
 * @property int $servings
 * @property Collection $steps
 * @property Collection $images
 * @method static Builder forUser(string $username)
 */
class Recipe extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'duration_preparation',
        'duration_cooking',
        'difficulty',
        'rating',
        'servings',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $with = [
        'requirements',
        'images',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    /**
     * @return HasMany
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    /**
     * @return MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
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