<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// Ecommerce products route


Route::group([
    "middleware" => ["auth:admin"],
    "namespace" => 'Area',
    "prefix"    => "/dashboard"
], function () {
    Route::get('/area', 'AreaController@index')->name('user.area');
    Route::get('/district_thana/create', 'AreaController@districtCreate')->name('b-dealer.distrinct_thana.create');
    Route::post('/district_thana/store', 'AreaController@storeDistrictThana')->name('b-dealer.distrinct_thana.store');

    Route::get('/get_district', 'AreaController@ajaxGetDistricts')->name('ajax.get_district');
    Route::get('/get_thana', 'AreaController@ajaxGetThanas')->name('ajax.get_thana');
    Route::get('/get_village', 'AreaController@ajaxGetVillages')->name('ajax.get_village');


});


Route::group([
    "middleware" => ["auth:admin"],
    "namespace" => 'Bdealer',
    "prefix"    => "/b_dealer/orders"

], function () {
    Route::get('/', 'BdealerController@orders')->name('bdealer.orders');
    Route::get('/datatables', 'BdealerController@ordersDatatables')->name('bdealer.orders.datatables');
    Route::post('/add-single-product', 'BdealerController@addSingleProduct');
    Route::post('/update-single-product-quantity', 'BdealerController@updateSingleProductQuantity');
    Route::get('/single-product-delete', 'BdealerController@singleProductDelete');
    Route::get('/{border}', 'BdealerController@ordersDetails')->name('bdealer.orders.details');


});


Route::group([
    "middleware" => ["auth:admin"],
    "namespace" => 'Bdealer',
    "prefix"    => "/b_dealer"

], function () {
    Route::get('/get_bdealer_ajax', 'BdealerController@getBdealerAjax')->name('getBdealerAjax');
    Route::patch('/complete_bdealer_order', 'BdealerController@completBdealerOrderByAdmin')->name('b-dealer.order.complete');
    Route::patch('/forward_bdealer_order', 'BdealerController@forwardBdealerOrderByAdmin')->name('b-dealer.order.forward_order');
    Route::patch('/cancel_bdealer_order', 'BdealerController@cancelBdealerOrderByAdmin')->name('b-dealer.order.cancel_order');
    Route::patch('/change_status_order', 'BdealerController@changeBdealerOrderStatusByAdmin')->name('b-dealer.order.change_status_order');
    Route::get('/active', 'BdealerController@getActive')->name('b-dealer.active');
    Route::get('/request', 'BdealerController@index')->name('b-dealer.request');
    Route::get('/create', 'BdealerController@create')->name('b-dealer.create');
    Route::post('/create', 'BdealerController@storeApi')->name('b-dealer.store');
    Route::get('/{id}', 'BdealerController@show')->name('b-dealer.request.show');
    Route::patch('/{id}/active', 'BdealerController@active')->name('b-dealer.request.active');
    Route::post('/{id}/recharge', 'BdealerController@recharge')->name('b-dealer.recharge');
    Route::get('/dealer-stock/{id}', 'BdealerController@dealerStock');

});

