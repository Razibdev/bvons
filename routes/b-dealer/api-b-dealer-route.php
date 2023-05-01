<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// Ecommerce products route


Route::group([
    "middleware" => ["auth:api"],
    "namespace" => 'Area',
    "prefix"    => "/b_dealer"

], function () {
    Route::get('/district_thana', 'AreaController@areaApi');
});


Route::group([
    "middleware" => ["auth:api", "is_bdealer"],
    "namespace" => 'Ecommerce\Api',
    "prefix"    => "/b_dealer"

], function () {
    Route::get('/products', 'ProductController@dealerProduct');
    Route::get('/products/{id}', 'ProductController@dealerProductDetails');

});


Route::group([
    "middleware" => ["auth:api"],
    "namespace" => 'Bdealer',
    "prefix"    => "/b_dealer"
], function () {
    Route::get('/', 'BdealerController@getBdealerApi');
    Route::get('/me', 'BdealerController@getBdealerDetailsApi');
    Route::get('/overview', 'BdealerController@getBdealerOverViewApi');
    Route::post('/', 'BdealerController@storeApi');
    Route::get('/status', 'BdealerController@statusApi');
    Route::get('/balance', 'BdealerController@balanceApi')->middleware(['is_bdealer']);
    Route::get('/transactions', 'BdealerController@transactionsApi')->middleware(['is_bdealer']);
    Route::get('/transactions_type', 'BdealerController@transactionTypeApi')->middleware(['is_bdealer']);
    Route::get('/my_orders', 'BdealerController@myOrdersApi')->middleware(['is_bdealer']);
    Route::get('/assign_orders', 'BdealerController@assignOrderApi')->middleware(['is_bdealer']);
    Route::get('/customer_orders', 'BdealerController@customerOrdersApi')->middleware(['is_bdealer']);
    Route::patch('/assign_orders', 'BdealerController@changeStatusApi')->middleware(['is_bdealer']);
    Route::get('/order/{border}', 'BdealerController@orderDetailsApi')->middleware(['is_bdealer']);
    Route::post('/order/add', 'BdealerController@orderAddApi')->middleware(['is_bdealer']);
    Route::patch('/forward_order/{border_id}', 'BdealerController@forwardOrderApi')->middleware(['is_bdealer']);

    Route::patch('/customer_order/change_status/{order_id}', 'BdealerController@changeStatus');

});


Route::group([
    "middleware" => ["auth:api", "is_bdealer"],
    "namespace" => 'Bdealer',
    "prefix"    => "/b_dealer_order"
], function () {
    Route::post('/customer_order/complete/{order_id}', 'BdealerCustomerOrderController@bdealerCustomerOrderComplete');
    Route::patch('/customer_order/forward_order/{order_id}', 'BdealerCustomerOrderController@bdealerCustomerOrderForward');

});
