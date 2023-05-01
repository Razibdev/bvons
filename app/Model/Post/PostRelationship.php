<?php
namespace App\Model\Post;
use App\Model\Comment\Comment;
use App\User;

trait PostRelationship{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
