<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Image
 *
 * @package App\Models
 * @property int $id
 * @property int $image_id
 * @property string $type
 * @property int $width
 * @property int $height
 * @property string $url
 * @property Collection $formats
 */
class Image extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'image_id',
        'type',
        'width',
        'height',
        'url',
    ];

    /**
     * @var array
     */
    protected $with = [
        'formats',
    ];

    /**
     * @return MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * @return HasMany
     */
    public function formats()
    {
        return $this->hasMany(Image::class);
    }
}