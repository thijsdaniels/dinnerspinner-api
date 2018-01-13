<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Api\Errors\NotFoundError;
use App\Http\Controllers\Api\V1\ApiController;
use App\Models\Selection;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RequirementController
 *
 * @package App\Http\Controllers\Api\V1\User
 */
class SelectionController extends ApiController
{
    /**
     * @param Request $request
     * @param string $username
     * @return JsonResponse
     */
    public function index(Request $request, $username)
    {
        $perPage = $request->get('per_page');

        $selections = Selection::forUser($username)
            ->simplePaginate($perPage);

        return $this->successResponse($selections);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $selectionId
     * @return JsonResponse
     */
    public function show(Request $request, $username, $selectionId)
    {
        $selection = Selection::forUser($username)
            ->find($selectionId);

        if (!$selection) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        return $this->successResponse($selection);
    }

    /**
     * @param Request $request
     * @param string $username
     * @return JsonResponse
     */
    public function store(Request $request, $username)
    {
        /** @var User $user */
        $user = User::query()->where('username', $username)->first();

        if (!$user) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        // TODO: Validate $request.

        $selection = $user->selections()->create($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($selection);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $selectionId
     * @return JsonResponse
     */
    public function update(Request $request, $username, $selectionId)
    {
        $selection = Selection::forUser($username)
            ->find($selectionId);

        if (!$selection) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        // TODO: Validate $request.

        $selection->update($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($selection);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $selectionId
     * @return JsonResponse
     */
    public function destroy(Request $request, $username, $selectionId)
    {
        $selection = Selection::forUser($username)
            ->find($selectionId);

        if (!$selection) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $selection->delete();

        // TODO: Handle exceptions.

        return $this->successResponse();
    }
}