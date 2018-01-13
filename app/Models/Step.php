<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Step
 *
 * @package App\Models
 * @property int $id
 * @property int $recipe_id
 * @property int $position
 * @property string $instruction
 */
class Step extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'recipe_id',
        'position',
        'instruction',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'recipe_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Requirement::class);
    }
}