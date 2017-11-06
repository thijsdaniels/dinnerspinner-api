<?php

namespace App\Api\Errors;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Translation\Translator;

/**
 * Class Error
 *
 * @package App
 */
class Error implements Arrayable, Jsonable
{
    /**
     * @var
     */
    protected $code;

    /**
     * @var
     */
    protected $data;

    /**
     * ApiError constructor.
     *
     * @param $code
     * @param $data
     */
    public function __construct($code, $data = null)
    {
        $this->code = $code;
        $this->data = $data;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'code' => $this->code,
            'message' => $this->getMessage($this->code),
            'data' => $this->data,
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @param int $code
     * @return array|Translator|null|string
     */
    protected function getMessage($code)
    {
        return trans("errors.{$code}");
    }
}