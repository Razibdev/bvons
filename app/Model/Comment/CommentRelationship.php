<?php
namespace App\Model\Comment;

use App\Model\Post\Post;
use App\User;

trait CommentRelationship {
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
