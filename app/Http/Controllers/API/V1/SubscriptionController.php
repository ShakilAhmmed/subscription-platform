<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SubscriptionRequest;
use App\Http\Resources\V1\SubscriberResource;
use App\Models\Subscriber;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{
    /**
     * @param SubscriptionRequest $request
     * @param Subscriber $subscriber
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/api/v1/subscriptions",
     *     summary="Create a new subscriber",
     *     operationId="subscriber-create",
     *     tags={"subscriptions"},
     * @OA\RequestBody(
     *          required=true,
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *               type="object",
     *               required={"website_id","user_id"},
     *               @OA\Property(property="website_id", type="text",description="Associate Website"),
     *               @OA\Property(property="user_id", type="text",description="Associate User"),
     *            ),
     *        ),
     *    ),
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
    public function store(SubscriptionRequest $request, Subscriber $subscriber)
    {
        try {
            $subscriber->fill($request->fields())->save();
            return $this->successResponse(
                new SubscriberResource($subscriber),
                'subscription created successfully',
                Response::HTTP_CREATED
            );
        } catch (Exception $exception) {
            logger()->critical('subscription:creating ->' . $exception->getMessage());
            return $this->errorResponse('subscription creating failed');
        }
    }
}
