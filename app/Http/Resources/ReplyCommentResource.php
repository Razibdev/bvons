<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
            'comment_id' => $this->comment_id,
            'user_id' => $this->user_id,
            'user' => $this->user,
//            'post' => $this->post,
            'post_id' => $this->post_id,
            'message' => $this->message,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
