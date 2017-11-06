<?php

namespace App\Http\Controllers\Api;

use App\Api\Errors\NotFoundError;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RecipeController
 *
 * @package App\Http\Controllers\Api
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

        if (!$recipe)
            return $this->errorResponse(new NotFoundError(), 404);

        return $this->successResponse($recipe);
    }
}