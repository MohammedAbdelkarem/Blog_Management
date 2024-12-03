<?php

namespace App\Http\Services;

use App\Models\Post;
use App\Constants\Resources;
use App\Enums\StatusEnum;
use App\Http\Traits\ModelHelper;
use Illuminate\Support\Facades\DB;

class PostService extends BaseService
{
    public function index()
    {
        return Post::all();
    }

    public function store($data)
    {
        Post::create($data);
    }

    public function show($id)
    {
        $post = ModelHelper::findByIdOrFail(Post::class, $id, 'male', Resources::RES_POST);

        return $post;
    }

    public function update($id , $data)
    {
        $post = ModelHelper::findByIdOrFail(Post::class, $id, 'male', Resources::RES_POST);

        $post->update($data);
    }

    public function destroy($id)
    {
        $post = ModelHelper::findByIdOrFail(Post::class, $id, 'male', Resources::RES_POST);

        $post->delete();
    }

    public function getPublished()
    {
        return Post::published()->ascending()->get();
    }

    public function changeStatus($postId)
    {
        $post = ModelHelper::findByIdOrFail(Post::class, $postId, 'male', Resources::RES_POST);

        $post->update([
            'status' => StatusEnum::PUBLISHED
        ]);
    }
}
