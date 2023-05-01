<?php

namespace App\Model;

use App\Model\Post\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{

    public  function user(){
       return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name', 'profile_pic');
    }

    public function post(){
       return $this->belongsTo(Post::class, 'reactable_id', 'id')->select('id','body');
    }



}
