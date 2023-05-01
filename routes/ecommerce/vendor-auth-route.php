<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// ecommerce Auth route

Route::group([
    "namespace" => "Ecommerce\Auth",
    "prefix" => "vendor",
], function() {
    Route::post('login', 'VendorAuthController@login')->name('vendor.login.submit');
    Route::get('login', 'VendorAuthController@index')->name('vendor.login')->middleware('guest:vendor');
    Route::get('register', 'VendorAuthController@registerShow')->name('register.vendor.show')->middleware(['auth:vendor', 'role:administrator']);
    Route::get('list', 'VendorAuthController@list')->name('register.vendor.list')->middleware(['auth:vendor', 'role:administrator']);
    // Route::post('register', 'VendorRegisterController@register')->name('register.vendor');
    Route::post('register', 'VendorRegisterController@vendorRegister')->name('register.vendor');
    Route::post('logout', 'VendorAuthController@logout')->name('vendor.logout');
});




// ecommerce Main Page route
Route::group([
    "namespace" => "Ecommerce\Auth",
    "prefix" => "mainpage",
    "middleware" => "auth:vendor"
], function() {
    Route::get('/', 'VendorController@index')->name('mainpage');
});
