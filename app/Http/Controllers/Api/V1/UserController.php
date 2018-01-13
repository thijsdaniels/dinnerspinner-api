<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Errors\NotFoundError;
use App\Api\Errors\ValidationError;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api\V1
 */
class UserController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @todo Obviously this shouldn't be public.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->get();

        return $this->successResponse($users);
    }

    /**
     * @param Request $request
     * @param string $username
     * @return JsonResponse
     */
    public function show(Request $request, $username)
    {
        $user = User::query()
            ->where('username', $username)
            ->first();

        if (!$user) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        return $this->successResponse($user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // TODO: Validate $request.

        $user = User::create($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($user);
    }

    /**
     * @param Request $request
     * @param string $username
     * @return JsonResponse
     */
    public function update(Request $request, $username)
    {
        $user = User::query()
            ->where('username', $username)
            ->first();

        if (!$user) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        // TODO: Validate $request.
        $user->update($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($user);
    }

    /**
     * @param Request $request
     * @param string $username
     * @return JsonResponse
     */
    public function destroy(Request $request, $username)
    {
        $user = User::query()
            ->where('username', $username)
            ->first();

        if (!$user) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $user->delete();

        // TODO: Handle exceptions.

        return $this->successResponse();
    }
}