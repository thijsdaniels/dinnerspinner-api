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
 * @property string $image_path
 * @property string $directions
 * @property int $duration_preparation
 * @property int $duration_cooking
 * @property int $difficulty
 * @property float $rating
 * @property object $image
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
        'image_path',
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
        'image_path',
        'duration_preparation',
        'duration_cooking',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $with = [
        'requirements',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'image',
        'duration',
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

    /**
     * @return object
     */
    public function getImageAttribute()
    {
        if (!$this->image_path)
            return null;

        return (object) [
            'url' => url()->to($this->image_path),
        ];
    }

    /**
     * @return object
     */
    public function getDurationAttribute()
    {
        return (object) [
            'preparation' => $this->duration_preparation,
            'cooking' => $this->duration_cooking,
        ];
    }
}