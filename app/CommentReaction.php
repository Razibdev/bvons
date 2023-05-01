<?php

namespace App;

use App\Model\Comment\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentReaction extends Model
{

    public function reactions()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public static function reactionSummary()
    {

        return static::groupBy('type')->map(function ($val) {
            return $val->count();
        });
    }

    public function getReactionSummaryAttribute()
    {
        return $this->reactionSummary();
    }

}
