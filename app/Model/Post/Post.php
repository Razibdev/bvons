<?php

namespace App\Model\Post;
use App\Model\Comment\Comment;
use App\Model\CommentRepliy;
use App\Model\CreatePage;
use App\Model\Like;
use App\User;
use Illuminate\Support\Facades\Storage;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use App\Model\CommonModel;

use Qirolab\Laravel\Reactions\Traits\Reactable;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;


class Post extends CommonModel implements ReactableInterface
{
    use CanBeLiked, PostRelationship, Reactable;

    protected $guarded = ['id'];
    protected $appends = ['is_liked', 'likes_count', 'total_comment', 'media_url'];
    public function user(){
        return $this->belongsTo(User::class,  'user_id')->select('id', 'name', 'profile_pic', 'verified');
    }

    public function comment(){
        return $this->hasMany(Comment::class,  'post_id');
    }

    public function likes(){
        return $this->hasMany(Like::class,  'post_id');
    }

    public function likeCount(){
        return $this->hasMany(Like::class,  'post_id');
    }
    public function replies(){
        return $this->hasMany(CommentRepliy::class, 'post_id' );
    }

    public function page(){
        return $this->belongsTo(CreatePage::class, 'page_id');
    }

//    public function totalComment(){
//        $total =  $this->replies()->count();
//        return $total;
//    }


    public function getTotalCommentRepliyAttribute()
    {
        return $this->replies->count();
    }

    public function totalCommentRepliy($id){
        return $cartCount = CommentRepliy::where('post_id', $id)->count();
    }


    public function getIsLikedAttribute()
    {
        return $this->isLikedBy(auth()->user());
    }

    public function getMediaUrlAttribute()
    {
        return $this->generateMediaUrl();
    }

    public function getLikesCountAttribute()
    {
        return $this->likers_count;
    }

    public function getTotalCommentAttribute()
    {
        return $this->comment->count();
    }

    public function commentWithUser()
    {
        return $this->comments()->with(['user' => function($query){
            return $query->select('id', 'name', 'phone', 'profile_pic', 'verified');
        }]);
    }

    public function generateMediaUrl()
    {
        if($this->media) {
            $media_file_list = json_decode($this->media);
            $media_url_list = [];
//            foreach ($media_file_list as $media) {
//                $media_url_list[] = Storage::disk('post')->url("/{$this->user->id}/{$this->id}/" . $media);
//            }

            return $media_url_list;
        }
        return null;
    }


}
