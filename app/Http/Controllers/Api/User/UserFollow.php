<?php
namespace App\Http\Controllers\Api\User;
use App\User;


trait UserFollow {
    public function follow(User $user)
    {
        return auth()->user()->follow($user);
    }

    public function unfollow(User $user)
    {
        return auth()->user()->unfollow($user);
    }

    public function toggleFollow(User $user)
    {
        return auth()->user()->toggleFollow($user);
    }

    public function followings(User $user)
    {
        return $user->followings()
                    ->get(['id', 'phone', 'name', 'profile_pic'])
                    ->makeHidden('pivot');
    }
    public function followers(User $user)
    {
        return $user->followers()
                    ->get(['id', 'phone', 'name', 'profile_pic'])
                    ->makeHidden('pivot');
    }

    public function totalFollowings(User $user)
    {
        return $user->followings()->get()->count();
    }

    public function totalFollowers(User $user)
    {
        return $user->followersCount();
    }

    public function isFollowed(User $user)
    {
        auth()->user()->isFollowing($user);
    }


}
