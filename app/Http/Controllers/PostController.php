<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * #### `GET` `/api/posts`
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'post' => $this->postRepository->getAllPosts(),
        ]);
    }

    /**
     * #### `POST` `/api/posts`
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $this->authorize('store', Post::class);

        $postDetails = $request->all();

        return response()->json([
            'post' => $this->postRepository->createPost($postDetails),
        ], Response::HTTP_CREATED);
    }

    /**
     * #### `PATCH` `api/posts/{post}`
     */
    public function update(Post $post, UpdatePostRequest $request): JsonResponse
    {
        $this->authorize('update', Post::class);

        $newPostDetails = $request->all();

        return response()->json([
            'post' => $this->postRepository->updatePost($post, $newPostDetails),
        ]);
    }

    /**
     * #### `DELETE` `api/posts/{post}`
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->authorize('destroy', Post::class);

        $this->postRepository->deletePost($post);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
