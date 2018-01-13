<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Api\Errors\NotFoundError;
use App\Http\Controllers\Api\V1\ApiController;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RecipeController
 *
 * @package App\Http\Controllers\Api\V1\User
 */
class RecipeController extends ApiController
{
    /**
     * @param Request $request
     * @param int $username
     * @return JsonResponse
     */
    public function index(Request $request, $username)
    {
        $perPage = $request->get('per_page');

        $recipes = Recipe::forUser($username)
            ->simplePaginate($perPage);

        return $this->successResponse($recipes);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @return JsonResponse
     */
    public function show(Request $request, $username, $recipeId)
    {
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        return $this->successResponse($recipe);
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

        $recipe = $user->recipes()->create($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($recipe);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @return JsonResponse
     */
    public function update(Request $request, $username, $recipeId)
    {
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        // TODO: Validate $request.

        $recipe->update($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($recipe);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @return JsonResponse
     */
    public function destroy(Request $request, $username, $recipeId)
    {
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $recipe->delete();

        // TODO: Handle exceptions.

        return $this->successResponse();
    }
}