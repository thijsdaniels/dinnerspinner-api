<?php

namespace App\Http\Controllers\Api\V1\User\Recipe;

use App\Api\Errors\NotFoundError;
use App\Http\Controllers\Api\V1\ApiController;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class StepController
 *
 * @package App\Http\Controllers\Api\V1\User\Recipe
 */
class StepController extends ApiController
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

        return $this->successResponse($recipe->steps);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @param int $stepId
     * @return JsonResponse
     */
    public function show(Request $request, $username, $recipeId, $stepId)
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $step = $recipe->steps()->find($stepId);

        if (!$step) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        return $this->successResponse($step);
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

        $step = $recipe->steps()->create($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($step);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @param int $stepId
     * @return JsonResponse
     */
    public function update(Request $request, $username, $recipeId, $stepId)
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $step = $recipe->steps()->find($stepId);

        if (!$step) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        // TODO: Validate $request.

        $step->update($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($step);
    }

    /**
     * @param Request $request
     * @param string $username
     * @param int $recipeId
     * @param int $stepId
     * @return JsonResponse
     */
    public function destroy(Request $request, $username, $recipeId, $stepId)
    {
        /** @var Recipe $recipe */
        $recipe = Recipe::forUser($username)
            ->find($recipeId);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $step = $recipe->steps()->find($stepId);

        if (!$step) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $step->delete();

        // TODO: Handle exceptions.

        return $this->successResponse();
    }
}