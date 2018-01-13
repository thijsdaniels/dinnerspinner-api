<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Recipe
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $directions
 * @property int $duration_preparation
 * @property int $duration_cooking
 * @property int $difficulty
 * @property float $rating
 * @property Image $image
 * @property object $duration
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
        'directions',
        'duration_preparation',
        'duration_cooking',
        'difficulty',
        'rating',
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
    public function image()
    {
        return $this->hasMany(Image::class);
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