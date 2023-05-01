<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'Api\Comment',
], function () {
    Route::get('/comment/like/{comment}', 'CommentController@getLike');
    Route::post('/comment/like/{comment}', 'CommentController@like');
    Route::post('/comment/unlike/{comment}', 'CommentController@unlike');
    Route::post('/comment/toggle_like/{comment}', 'CommentController@toggleLike');
    Route::get('/comment/{post}', 'CommentController@get');
    Route::post('/comment/{post}', 'CommentController@create');
    Route::delete('/comment/{comment_id}', 'CommentController@destroy');
});
