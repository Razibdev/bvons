<?php

namespace App\Http\Controllers\Api\Comment;

use App\Model\Comment\Comment;

trait CommentLike {
    public function like(Comment $comment)
    {
        return auth()->user()->like($comment);
    }

    public function unlike(Comment $comment)
    {
        return auth()->user()->unlike($comment);
    }

    public function toggleLike(Comment $comment)
    {
        return auth()->user()->toggleLike($comment);
    }

    public function getLike(Comment $comment)
    {
        return [
            "total_like" => $comment->likers_count,
            "human_readable_like" => $comment->likersCountReadable()
        ];
    }

}
