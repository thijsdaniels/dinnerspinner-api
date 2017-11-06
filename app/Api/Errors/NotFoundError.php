<?php

namespace App\Api\Errors;

/**
 * Class NotFoundEError
 *
 * @package App
 */
class NotFoundError extends Error
{
    /**
     * ApiError constructor.
     */
    public function __construct()
    {
        return parent::__construct(1001);
    }
}