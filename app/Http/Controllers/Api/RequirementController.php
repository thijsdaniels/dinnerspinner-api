<?php

namespace App\Http\Controllers\Api;

use App\Api\Errors\NotFoundError;
use App\Models\Recipe;
use App\Models\Requirement;
use App\Models\Selection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RequirementsController
 *
 * @package App\Http\Controllers\Api
 */
class RequirementController extends ApiController
{
    /**
     * @param Request $request
     * @param string $username
     * @return JsonResponse
     */
    public function index(Request $request, $username)
    {
        $requirements = Requirement::forUser($username)
            ->get();

        return $this->successResponse($requirements);
    }
}