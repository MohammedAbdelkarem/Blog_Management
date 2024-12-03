<?php

namespace App\Http\Controllers;

use App\Constants\Resources;
use Illuminate\Http\Request;
use App\Constants\ApiMessages;
use App\Http\Services\PostService;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->index();

        $response = PostResource::collection($posts);

        return $this->okResponse(
            $response,
            messageHandler(
                ApiMessages::MSG_FETCHED_SUCCESSFULLY,
                Resources::RES_POSTS
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $this->postService->store(
            $request->validated()
        );

        return $this->createdResponse(
            [],
            messageHandler(
                ApiMessages::MSG_Created_SUCCESSFULLY,
                Resources::RES_POST
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->show($id);

        $response = PostResource::make($post);

        return $this->okResponse(
            $response,
            messageHandler(
                ApiMessages::MSG_FETCHED_SUCCESSFULLY,
                Resources::RES_POST
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $this->postService->update(
            $id,
            $request->validated()
        );

        return $this->okResponse(
            [],
            messageHandler(
                ApiMessages::MSG_UPDATED_SUCCESSFULLY,
                Resources::RES_POST
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->postService->destroy($id);

        return $this->okResponse(
            [],
            messageHandler(
                ApiMessages::MSG_DELETED_SUCCESSFULLY,
                Resources::RES_POST
            )
        );
    }

    public function getPublishedPosts()
    {
        $posts = $this->postService->getPublished();

        $response = PostResource::collection($posts);

        return $this->okResponse(
            $response,
            messageHandler(
                ApiMessages::MSG_FETCHED_SUCCESSFULLY,
                Resources::RES_PUBLISHED_POSTS
            )
        );
    }

    public function changeStatus(string $postId)
    {
        $this->postService->changeStatus($postId);

        return $this->okResponse(
            [],
            messageHandler(
                ApiMessages::MSG_STATUS_CHANGED_SUCCESSFULLY,
                Resources::RES_POST
            )
        );
    }
}
