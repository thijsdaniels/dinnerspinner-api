<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 */
class User extends Model
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
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}