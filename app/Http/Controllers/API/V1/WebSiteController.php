<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WebSiteResource;
use App\Models\WebSite;
use Exception;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class WebSiteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/websites",
     *     summary="List all websites",
     *     operationId="websites-listing",
     *     tags={"WebSites"},
     *     @OA\Response(
     *        response=200,
     *        description="OK",
     *     ),
     *     @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="Page not found",
     *     ),
     *     @OA\Response(
     *        response=500,
     *        description="Internal server error",
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Validation Failed",
     *     ),
     * ),
     */
    public function index()
    {
        try {
            $websites = WebSite::query()->get();
            return $this->successResponse(
                WebSiteResource::collection($websites),
                'websites fetched successfully',
            );
        } catch (Exception $exception) {
            logger()->critical('website:fetching ->' . $exception->getMessage());
            return $this->errorResponse('websites fetching failed');
        }
    }
}
