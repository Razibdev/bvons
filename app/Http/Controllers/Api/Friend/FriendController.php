<?php

namespace App\Http\Controllers\Api\Friend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class FriendController extends Controller
{
    public function sendFriendRequest(Request $request, User $recipient) {
        return auth()->user()->befriend($recipient);
    }

    public function acceptFriendRequest(Request $request, User $sender) {
        return auth()->user()->acceptFriendRequest($sender);
    }

    public function denyFriendRequest(Request $request, User $sender) {
        return auth()->user()->denyFriendRequest($sender);
    }
    public function unFriend(Request $request, User $friend) {
        return auth()->user()->unfriend($friend);
    }
}
