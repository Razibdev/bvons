<?php


use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'Api\PaymentMethod',
], function () {
    Route::apiResource('/payment', 'PaymentMethodController');
});
