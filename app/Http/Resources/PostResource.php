<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'user' => $this->user,
            'post_url' => $this->post_url,
            'body' => $this->body,
            'media' => $this->media,
            'premium_post' => $this->premium_post,
            'now_date' => $this->now_date,
            'action_page' => $this->action_page,
            'created_at' => $this->created_at->diffForHumans(),
//            'likes' => $this->likes,
//            'comment' => $this->comment,
//            'replies' => $this->replies,
//            'like_count' => $this->likes->count(),
            'comment_count' => $this->comment->count(),
            'reply_count' => $this->replies->count(),
            'user_id' => $this->user_id
        ];
    }
}
