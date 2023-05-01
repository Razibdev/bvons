<?php

namespace App\Http\Controllers\Api\Post;

use App\Model\Post\Post;
use App\User;

trait PostLike {
    public function like(Post $post)
    {
        return auth()->user()->like($post);
    }

    public function unlike(Post $post)
    {
        return auth()->user()->unlike($post);
    }

    public function toggleLike(Post $post)
    {
        $toggleLike = auth()->user()->toggleLike($post);
        $postLikeCount = $this->getLike($post);
        return response()->json([$toggleLike, $postLikeCount], 200);
    }

    public function getLike(Post $post)
    {
        return [
            "total_like" => $post->likers_count,
            "human_readable_like" => $post->likersCountReadable()
        ];
    }

    public function isLiked(Post $post)
    {
        return $post->isLikedBy(auth()->user());
    }

    public function hasLikedByUser(Post $post, $user_id = null)
    {
        if(!$post) return response()->json('invalid post id', 200);

        if($user_id === null) return auth()->user()->hasLiked($post);

        $user = User::find($user_id);

        if($user) return $user->hasLiked($post);
    }


}
