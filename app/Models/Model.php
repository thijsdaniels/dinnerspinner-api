<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Model
 *
 * @package App\Models
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Model extends BaseModel
{
    protected $dateFormat = 'U';
}