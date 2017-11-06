<?php

namespace App\Http\Controllers\Api;

use App\Api\Errors\NotFoundError;
use App\Models\Recipe;
use App\Models\Selection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class SelectionController
 *
 * @package App\Http\Controllers\Api
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
        $selections = Selection::forUser($username)
            ->get();

        return $this->successResponse($selections);
    }
}