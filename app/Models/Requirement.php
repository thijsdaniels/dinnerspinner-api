<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Requirement
 *
 * @package App\Models
 * @property int $id
 * @property int $recipe_id
 * @property int $ingredient_id
 * @property float $quantity
 * @property string $unit
 * @property Carbon $bought_at
 * @method static Builder forUser(string $username)
 */
class Requirement extends Model
{
    /**
     * Unit constants.
     */
    const UNIT_GRAMS = 'grams';
    const UNIT_LITERS = 'liters';
    const UNIT_PIECES = 'pieces';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'recipe_id',
        'ingredient_id',
        'quantity',
        'unit',
        'bought_at',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'recipe_id',
        'ingredient_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $with = [
        'ingredient',
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
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    /**
     * @param Builder $query
     * @param string $username
     * @return Builder|static
     */
    public function scopeForUser(Builder $query, $username)
    {
        return $query->whereHas('recipe', function (Builder $query) use ($username) {
            return $query->whereHas('user', function (Builder $query) use ($username) {
                return $query->where('username', $username);
            });
        });
    }
}