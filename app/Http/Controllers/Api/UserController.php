<?php

namespace App\Http\Controllers\Api;

use App\Api\Errors\NotFoundError;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController
{
    /**
     * @param Request $request
     * @param string $username
     * @return JsonResponse
     */
    public function show(Request $request, $username)
    {
        $user = User::where('username', $username)
            ->first();

        if (!$user)
            return $this->errorResponse(new NotFoundError(), 404);

        return $this->successResponse($user);
    }
}