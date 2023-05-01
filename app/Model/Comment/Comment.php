<?php

namespace App\Model\Comment;

use App\CommentReaction;
use App\Model\CommentRepliy;
use App\Model\CommonModel;
use App\Model\Post\Post;
use App\User;
use Multicaret\Acquaintances\Traits\CanBeLiked;

class Comment extends CommonModel
{
    use CanBeLiked, CommentRelationship;
    protected $guarded = ['id'];
    protected $appends = ['is_liked', 'total_likes'];
    public function getIsLikedAttribute()
    {
        return $this->isLikedBy(auth()->user());
    }

    public function getTotalLikesAttribute()
    {
        return [
            "total_like" => $this->likers_count,
            "human_readable_like" => $this->likersCountReadable()
        ];
    }


    public function user(){
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'profile_pic');
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function replies(){
        return $this->hasMany(CommentRepliy::class, 'comment_id', 'id');

    }

    public function getTotalRepliesAttribute()
    {
        return $this->replies()->count();
    }
    public function commentrection(){
        return $this->hasMany(CommentReaction::class, 'comment_id');
    }

    public function commentreactiongroup(){
        return $this->commentrection()->groupBy('type');
    }

}
