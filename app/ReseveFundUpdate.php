<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReseveFundUpdate extends Model
{
    protected  $fillable = ['post_like_reserve','post_comment_reserve', 'post_share_reserve'];
}
