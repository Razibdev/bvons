<?php
/**
 * Created by PhpStorm.
 * User: Kajal
 * Date: 12/13/2021
 * Time: 12:00 PM
 */


use Illuminate\Support\Facades\Route;
Route::get('/social', 'Api\Vue\PostController@getPost');
Route::get('/post/reaction/summary/{id}', 'Api\Vue\PostController@summaryReactions');
Route::get('/social/user-post-comment/{id}', 'Api\Vue\PostController@getUserMainComment');
Route::get('/social/like-react-user/{id}', 'Api\Vue\PostController@likeReactUser');
Route::get('/social/like-react-user-love/{id}/{reaction}', 'Api\Vue\PostController@likeReactUserLove');

Route::group([
    'middleware' => 'JWT',
    'namespace' => 'Api\Vue',
], function () {
    Route::get('/get-all-users', 'PostController@getAllUser');


    Route::post('/social/auth-user-post/{id}', 'PostController@authUserCreatePost');
    Route::post('/social/auth-user-post-update/{id}', 'PostController@updateUserPostNow');

    Route::post('/social/delete-post/{id}', 'PostController@deletePost');
    Route::get('/social/auth-user-all-post/{id}', 'PostController@authUserAllPost');
    Route::post('/social/edit/post/{id}', 'PostController@socialEditPost');
    Route::post('/post/{id}/reactions', 'PostController@toggle');
    Route::post('/post/{id}/comment-reactions', 'PostController@toggleCommentReaction');
    Route::get('/post/comment-reactions/{id}/{user}', 'PostController@getCommentReaction');
    Route::get('/post/comment-reaction-users-info/{id}', 'PostController@getCommentReactionAllUsers');


    Route::get('/post/reactions/{id}/{user}', 'PostController@getReaction');
    Route::post('/social/user-per-post', 'PostController@userMainComment');

    Route::get('/social/user-post-single-comment/{id}', 'PostController@getUserSingleComment');
    Route::post('/social/new-reply-comment/{id}', 'PostController@newReplyComment');
    Route::get('/dealer/account', 'Auth\UserController@account');

});

Route::group([
    'middleware' => 'JWT',
    'namespace' => 'FrontEnd/',
], function () {
    Route::get('/dealer/account', 'Auth\UserController@account');

});
