<?php

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'Api\User',
], function () {

    Route::get('/user/random', 'UserController@random');

    Route::post('/user/follow/{user}', 'UserController@follow');
    Route::post('/user/unfollow/{user}', 'UserController@unfollow');
    Route::post('/user/toggle_follow/{user}', 'UserController@toggleFollow');
    Route::get('/user/followings/{user}', 'UserController@followings');
    Route::get('/user/followers/{user}', 'UserController@followers');
    Route::get('/user/total_followings/{user}', 'UserController@totalFollowings');
    Route::get('/user/total_followers/{user}', 'UserController@totalFollowers');

    Route::get('/user/is_followed/{user}', 'UserController@isFollowed');

    Route::get('/user/profile/{user_id?}', 'UserController@getProfile');
    Route::post('user/timeline', 'UserController@getTimeline');
    Route::get('user/s', 'UserController@search');
    Route::patch('/user/profile', 'UserController@updateProfile');

    Route::post('user/apply_for_verification', 'UserController@applyForVerification');


    Route::get('user/get_transaction', 'UserController@getTransaction');
    Route::get('user/get_cash_back_transaction', 'UserController@getCashBackTransaction');
    Route::get('user/payment_methods', 'UserController@getUserPaymentMethods');
    Route::post('user/payment_methods', 'UserController@createUserPaymentMethods');
    Route::patch('user/payment_methods/{payment_method_id}', 'UserController@updateUserPaymentMethods');

    Route::get('/user/verification', 'UserController@getVerification');

    Route::post('user/apply_for_withdrawal', 'UserController@applyForWithdrawal');

    Route::get('user/balance', 'UserController@getBalance');
    Route::get('user/cash_back_balance', 'UserController@getCashBackBalance');
    Route::get('user/cash_back_pending_balance', 'UserController@getCashBackPendingBalance');

    Route::get('user/addresses', 'UserController@getAddress');
    Route::post('user/address/create', 'UserController@createAddress');
    Route::patch('user/address/update/{id}', 'UserController@updateAddress');
    Route::delete('user/address/delete/{id}', 'UserController@deleteAddress');


});


Route::get('ajax_call/get_premimum_user', 'Api\User\UserController@getPremiumUser')->name('jobed_user');

