<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id
        ];

        if($request->routeIs('post.index') ||
           $request->routeIs('post.show') ||
           $request->routeIs('post.get.published')
        )
        {
            $data['title'] = $this->title;
            $data['content'] = $this->content;
            $data['status'] = $this->status;

            if($request->routeIs('post.show'))
            {
                $data['published_at'] = $this->published_at;
            }
        }

        return $data;
    }
}
