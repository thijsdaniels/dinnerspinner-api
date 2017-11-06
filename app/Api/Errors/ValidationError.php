<?php

namespace App\Api\Errors;

use Illuminate\Contracts\Support\MessageBag;

/**
 * Class ValidationError
 *
 * @package App
 */
class ValidationError extends Error
{
    /**
     * ApiError constructor.
     *
     * @param $data
     */
    public function __construct(MessageBag $data)
    {
        return parent::__construct(1002, $data);
    }
}