<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $username
 */
class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
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
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    /**
     * @return HasMany
     */
    public function selections()
    {
        return $this->hasMany(Selection::class);
    }

    /**
     * @return HasManyThrough
     */
    public function requirements()
    {
        return $this->hasManyThrough(Requirement::class, Selection::class);
    }
}