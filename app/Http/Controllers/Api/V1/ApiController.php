<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Errors\Error;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\AbstractPaginator;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers\Api\V1
 */
abstract class ApiController extends Controller
{
    /**
     * @param mixed $data
     * @return JsonResponse
     */
    public function successResponse($data = null)
    {
        $body = [
            'success' => true,
            'error' => null,
        ];

        if ($data instanceof AbstractPaginator) {
            $body = array_merge($body, $data->toArray());
        } else {
            $body = array_merge($body, [
                'data' => $data,
            ]);
        }

        return response()->json($body);
    }

    /**
     * @param mixed Error $error
     * @param int $status
     * @return JsonResponse
     */
    public function errorResponse(Error $error, $status = 500)
    {
        $body = [
            'success' => false,
            'error' => $error->toArray(),
            'data' => null,
        ];

        return response()->json($body, $status);
    }
}