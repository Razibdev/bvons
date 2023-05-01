<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group([
    "namespace" => "Bcourier\Api",
    "prefix" => '/bcourier/delivery_boy'
], function() {
    Route::post('/register', 'BcoDeliveryBoyController@register');
    Route::get('/status', 'BcoDeliveryBoyController@status');
    Route::get('/', 'BcoDeliveryBoyController@index');
    Route::get('/parcel', 'BcoDeliveryBoyController@parcel');

});

Route::group([
    "namespace" => "Bcourier\Api",
    "prefix" => '/bcourier/parcel_type'
], function() {
    Route::get('/', 'BcoPercelTypeController@index');
});


Route::group([
    "namespace" => "Bcourier\Api",
    "prefix" => '/bcourier/parcel'
], function() {
    Route::get('/', 'BcoPercelController@index');
    Route::post('/create', 'BcoPercelController@create');
    Route::get('/p_request', 'BcoPercelController@p_request');
});

Route::group([
    "namespace" => "Bcourier\Api",
    "prefix" => '/bcourier/p_request'
], function() {
    Route::post('/create', 'BcoRequestController@create');
});


