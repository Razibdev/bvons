<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group([
    "namespace" => "Ecommerce\Api",
], function() {
    Route::get('products/recent-products', 'ProductController@index');
    Route::resource('products','ProductController');
    Route::get('/product/hot', 'ProductController@hotProducts');
    Route::get('/product/search', 'ProductController@search');
});


// Route::group([
//     'namespace' => 'Ecommerce\Api',
// ], function () {
//     Route::resource('products','ProductController');

// });

Route::group([
    'namespace' => 'Ecommerce\Api',
], function () {
    Route::resource('category','CategoryController');
    Route::get('/navigation','CategoryController@navigation');
    Route::get('/category/product/{id}', 'CategoryController@manyproduct');
});

Route::group([
    'namespace' => 'Ecommerce\Api',
], function () {
    Route::get('/cart','ProductCartController@index');
    Route::post('/cart', 'ProductCartController@store');

    //cart part
    Route::post('/cart/destroy', 'ProductCartController@destroy');
    Route::post('/cart/cart-quanity-minus', 'ProductCartController@updateCartQty');
    Route::post('/cart/cart-quanity-plus', 'ProductCartController@updateCartQtyPlus');
    Route::post('/cart/quanity-minus', 'ProductCartController@updateQty');
    Route::post('/cart/quanity-minus', 'ProductCartController@updateQty');
    Route::post('/order/complete', 'ProductCartController@orderComplete');
    Route::get('/order/list/{id}', 'ProductCartController@orderList');
    Route::post('/cart/auth-update', 'ProductCartController@cartAuthUpdate');
    Route::post('/order/cancel/{id}', 'ProductCartController@orderCancel');
    Route::post('/order/details/{id}', 'ProductCartController@showSingleOrderDetails');




    Route::get('/district', 'ProductCartController@district');
    Route::get('/area', 'ProductCartController@area');
});

Route::group([
    'namespace' => 'Ecommerce\Api',
], function () {
    Route::get('/category/single/{id}', 'SubCategoryController@manysubCategory');
    Route::get('/subcategory/{id}/brand', 'SubCategoryController@getBrand');
    Route::resource('subcategory','SubCategoryController');
    Route::get('/subcategory/product/{id}', 'SubCategoryController@manyproduct');
    Route::get('/shop/product/{id}', 'ShopController@shopToproduct');

});


Route::group([
    'namespace' => 'Ecommerce\Api',
    // 'middleware' => 'auth:api',
], function () {
    Route::resource('address','AddressController');


});

Route::group([
    'namespace' => 'Ecommerce\Api',
], function () {
    Route::resource('slider','SliderController');
    Route::get('slider/{id}/products', 'SliderController@getProducts');

});

Route::group([
    'namespace' => 'Ecommerce\Api',
     'middleware' => 'auth:api',
], function () {
     Route::get('/slider/details/{id}', 'SliderDetailsController@sliderToproduct');

});

Route::group([
    'namespace' => 'Ecommerce\Api',

], function () {
    Route::get('/shop/product/{id}', 'ShopController@shopToproduct');
    Route::resource('shops','ShopController');
    Route::resource('brands','BrandController');
});

Route::group([
    'namespace' => 'Ecommerce\Api',
    'middleware' => 'auth:api',
], function () {
     Route::get('/payment/show', 'PaymentController@create');

});

Route::group([
    'namespace' => 'Ecommerce\Api',
    'middleware' => 'auth:api',
], function () {

    Route::post('/order/add', 'OrderController@add');
    Route::get('/orders', 'OrderController@getOrders');

    Route::get('/order/{id}/details', 'OrderController@getOrderDetails');
    Route::patch('/order/{order}/cancel', 'OrderController@cancelOrder');

});



