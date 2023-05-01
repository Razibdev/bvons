<?php

namespace App\Http\Resources;
use App\Http\Resources\ReplyCommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => $this->user,
            'reply_count' => $this->replies->count(),
            'reply' => ReplyCommentResource::collection($this->replies),
            'post_id' => $this->post_id,
            'body' => $this->body,
            'media' => $this->media,
            'comment_reactions' => $this->commentrection,
            'comment_reactions_group' => $this->commentreactiongroup,
            'comment_reaction_count' => $this->commentrection->count(),
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
