<?php


Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'Api\Friend',
    'prefix' => 'friend'
], function () {
    Route::post('/send-friend-request/{recipient}', 'FriendController@sendFriendRequest');
    Route::post('/accept-friend-request/{sender}', 'FriendController@acceptFriendRequest');
    Route::post('/deny-friend-request/{sender}', 'FriendController@denyFriendRequest');
    Route::post('/unfriend-friend-request/{friend}', 'FriendController@unFriend');
});
