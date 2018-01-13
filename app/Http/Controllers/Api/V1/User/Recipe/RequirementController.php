<?php

namespace App\Http\Controllers\Api\V1\User\Recipe;

use App\Api\Errors\NotFoundError;
use App\Http\Controllers\Api\V1\ApiController;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RequirementController
 *
 * @package App\Http\Controllers\Api\V1\User\Recipe
 */
class RequirementController extends ApiController
{
    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @return JsonResponse
     */
    public function index(Request $request, $username, $recipeId)
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        return $this->successResponse($recipe->requirements);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @param int $requirementId
     * @return JsonResponse
     */
    public function show(Request $request, $username, $recipeId, $requirementId)
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $requirement = $recipe->requirements()->find($requirementId);

        if (!$requirement) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        return $this->successResponse($requirement);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @return JsonResponse
     */
    public function store(Request $request, $username, $recipeId)
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        // TODO: Validate $request.

        $requirement = $recipe->requirements()->create($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($requirement);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @param int $requirementId
     * @return JsonResponse
     */
    public function update(Request $request, $username, $recipeId, $requirementId)
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $requirement = $recipe->requirements()->find($requirementId);

        if (!$requirement) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        // TODO: Validate $request.

        $requirement->update($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($requirement);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @param int $requirementId
     * @return JsonResponse
     */
    public function destroy(Request $request, $username, $recipeId, $requirementId)
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $requirement = $recipe->requirements()->find($requirementId);

        if (!$requirement) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $requirement->delete();

        // TODO: Handle exceptions.

        return $this->successResponse();
    }
}