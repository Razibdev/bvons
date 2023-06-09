<?php

namespace App\Model;

use App\Model\Post\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user(){
        return $this->belongsTo(User::class,  'user_id');
    }

    public function post(){
        return $this->belongsTo(Post::class,  'post_id');
    }
}
