<?php

namespace App\Http\Controllers\Api;

use App\Api\Errors\NotFoundError;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IngredientController
 *
 * @package App\Http\Controllers\Api
 */
class IngredientController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $recipes = Ingredient::all();

        return $this->successResponse($recipes);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $recipe = Ingredient::find($id);

        if (!$recipe)
            return $this->errorResponse(new NotFoundError(), 404);

        return $this->successResponse($recipe);
    }
}