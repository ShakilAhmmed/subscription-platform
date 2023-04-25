<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PostRequest;
use App\Http\Resources\V1\PostResource;
use App\Jobs\SendMailToSubscribers;
use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/posts",
     *     summary="List all posts",
     *     operationId="posts-listing",
     *     tags={"posts"},
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
            $posts = Post::query()->paginate();
            return $this->successResponse(
                PostResource::collection($posts),
                'posts fetched successfully',
            );
        } catch (Exception $exception) {
            logger()->critical('posts:fetching ->' . $exception->getMessage());
            return $this->errorResponse('posts fetching failed');
        }
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/api/v1/posts",
     *     summary="Create a new post",
     *     operationId="post-create",
     *     tags={"posts"},
     * @OA\RequestBody(
     *          required=true,
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *               type="object",
     *               required={"website_id","title"},
     *               @OA\Property(property="website_id", type="text",description="Associate Website"),
     *               @OA\Property(property="title", type="text",description="Post Title"),
     *               @OA\Property(property="description", type="text",description="Post description"),
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
    public function store(PostRequest $request, Post $post)
    {
        try {
            $post->fill($request->fields())->save();
            SendMailToSubscribers::dispatch($post);
            return $this->successResponse(
                new PostResource($post),
                'post created successfully',
                Response::HTTP_CREATED
            );
        } catch (Exception $exception) {
            logger()->critical('posts:creating ->' . $exception->getMessage());
            return $this->errorResponse('posts creating failed');
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/posts/{id}",
     *     summary="view a post",
     *     operationId="post-view",
     *     tags={"posts"},
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
    public function show(Post $post)
    {
        try {
            return $this->successResponse(
                new PostResource($post),
                'post fetched successfully',
                Response::HTTP_OK
            );
        } catch (Exception $exception) {
            logger()->critical('posts:fetching ->' . $exception->getMessage());
            return $this->errorResponse('post fetching failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
