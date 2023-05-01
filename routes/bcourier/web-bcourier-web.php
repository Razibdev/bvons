<?php
use Illuminate\Support\Facades\Route;

Route::group([
    "namespace" => "Bcourier\Web",
    "prefix" => '/bcourier/delivery_boy'
], function() {
    Route::get('/', 'BcoDeliveryBoyController@index')->name('bco.delivery_boy.index');
    Route::get('/datatables', 'BcoDeliveryBoyController@indexDatatables')->name('bco.delivery_boy.index.datatables');
    Route::get('/{delivery_boy}', 'BcoDeliveryBoyController@show')->name('bco.delivery_boy.show');
    Route::patch('/{delivery_boy}/change_status','BcoDeliveryBoyController@changeStatus')->name('bco.delivery_boy.change_status');
});


Route::group([
    "namespace" => "Bcourier\Web",
    "prefix" => '/bcourier/parcel_type'
], function() {
    Route::get('/', 'BcoPercelTypeController@index')->name('bco.percel_type.index');
    Route::get('/datatables', 'BcoPercelTypeController@indexDatatables')->name('bco.percel_type.index.datatables');
    Route::get('/create', 'BcoPercelTypeController@create')->name('bco.percel_type.create');
    Route::get('/{bcoPercelType}/edit', 'BcoPercelTypeController@edit')->name('bco.percel_type.edit');
    Route::patch('/{bcoPercelType}/update', 'BcoPercelTypeController@update')->name('bco.percel_type.update');
    Route::post('/store', 'BcoPercelTypeController@store')->name('bco.percel_type.store');
});

Route::group([
    "namespace" => "Bcourier\Web",
    "prefix" => '/bcourier/parcel'
], function() {
    Route::get('/', 'BcoPercelController@index')->name('bco.percel.index');
    Route::get('/datatables', 'BcoPercelController@indexDatatables')->name('bco.percel.index.datatables');
    Route::get('/{parcel}', 'BcoPercelController@show')->name('bco.parcel.show');
});
