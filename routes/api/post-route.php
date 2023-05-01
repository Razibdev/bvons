<?php

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'Api\Post',
], function () {

    Route::get('/post/like/{post}', 'PostController@getLike');
    Route::post('/post/like/{post}', 'PostController@like');
    Route::post('/post/unlike/{post}', 'PostController@unlike');
    Route::post('/post/toggle_like/{post}', 'PostController@toggleLike');
    Route::post('/post/{post}/is_liked', 'PostController@isLiked');
    Route::post('/post/{post}/has_liked_by_user/{user_id?}', 'PostController@hasLikedByUser');
    Route::get('post/user/{user_id?}', 'PostController@index');
    Route::apiResource('/post', 'PostController');

});
