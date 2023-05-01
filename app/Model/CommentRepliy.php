<?php

namespace App\Model;

use App\Model\Post\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class CommentRepliy extends Model
{

    public function user(){
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'profile_pic');
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }
}
