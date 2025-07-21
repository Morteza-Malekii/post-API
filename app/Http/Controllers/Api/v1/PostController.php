<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\StorePostRequest;
use App\Http\Requests\api\v1\UpdatePostRequest;
use App\Http\Resources\v1\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = Post::latest()->paginate(2);
        return PostResource::collection($posts)
        ->additional([
            'meta' => [
                'apiVersion' => 'v1',
            ],
        ])
        ->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $data = $request->validated();
        $post = Post::create($data);
        return (new PostResource($post))
        ->additional([
            'meta' => [
                'message'=>'data created successfully',
                'apiVersion'=>'v1'
            ]
        ])
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update($data);
        return (new PostResource($post->refresh()))
        ->additional([
            'meta'=>[
                'message'=>'post updated successfuly',
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'meta' => [
                'message'    => 'Post deleted successfully',
                'deletedId'  => $post->id,
                'apiVersion' => 'v1',
            ]
        ], 200);
    }
}
