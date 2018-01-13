<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class Ingredient
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 */
class Ingredient extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany
     */
    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    /**
     * @return HasManyThrough
     */
    public function recipes()
    {
        return $this->hasManyThrough(Recipe::class, Requirement::class);
    }
}