<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Errors\NotFoundError;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IngredientController
 *
 * @package App\Http\Controllers\Api\V1
 */
class IngredientController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $recipes = Ingredient::query()
            ->get();

        return $this->successResponse($recipes);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $recipe = Ingredient::query()
            ->find($id);

        if (!$recipe) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        return $this->successResponse($recipe);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // TODO: Validate $request.

        $ingredient = Ingredient::firstOrCreate($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($ingredient);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::query()
            ->find($id);

        if (!$ingredient) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        // TODO: Validate $request.

        $ingredient->update($request->input());

        // TODO: Handle exceptions.

        return $this->successResponse($ingredient);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $ingredient = Ingredient::query()
            ->find($id);

        if (!$ingredient) {
            return $this->errorResponse(new NotFoundError(), 404);
        }

        $ingredient->delete();

        // TODO: Handle exceptions.

        return $this->successResponse();
    }
}