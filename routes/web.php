<?php

use App\Http\Resources\BdealerProductCollection as BdealerProductResource;
use App\KuHelpers\Helpers;
use App\Model\Area\Zone;
use App\Model\Bcourier\BcoPercel;
use App\Model\Bdealer\BdealerProduct;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\Ecommerce\Api\EcoProduct;
use App\User;
use App\UserJobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//use App\Modal\CommissionRelation;


//Route::get('test', function (){
//    $commission = new CommissionRelation();
//    $commission->designationMonthlyUpdateInfo();
//});

Route::any('/auth_creator_validate', function(Request $request){
    $auth_creator_password = 607080;
    $auth_creator_verified =  session()->get('auth-creator-password');

    if($auth_creator_verified === 'verified') {
        return redirect()->route('auth-creator');
    }

    if($request->method() == "POST") {
        if($request->password == $auth_creator_password) {
            session()->put('auth-creator-password', 'verified');
            return redirect()->route('auth-creator');
        } else {
            return back()->withErrors('invalid password');
        }
    }
    return view('auth-creator.form');
})->name('auth-creator-validate');

Route::get('/4d9f5674-ba98-48c0-aff0-33a8ed316ecf', function(){
    $auth_creator_verified =  session()->get('auth-creator-password');
    if($auth_creator_verified === 'verified') {
        return view('auth-creator.create');
    } else {
        return redirect()->route('auth-creator-validate');
    }
})->name('auth-creator');


Route::get('demo', function() {

    /*$users = \App\User::cursor();

    $count = 0;

    foreach ($users as $user) {
        if(strlen($user->profile_pic) > 50) {
            $p_pic = Upload::storeMediaFromBase64($user->profile_pic, 'user_profile', "/{$user->id}")[0];
            $c_pic = Upload::storeMediaFromBase64($user->cover_pic, 'user_cover', "/{$user->id}")[0];
            $user->update([
                'profile_pic' => $p_pic,
                'cover_pic' => $c_pic,
            ]);
            echo "<p>{$p_pic}, {$c_pic}, {$count}</p>";
            $count++;
        }
    }*/

//    return $user = \App\EcoVendor::find(1)->assignRole('administrator');
//    auth()->user()->assignRole('vendor');
//    return $permission = Permission::create(['name' => 'product edit', "guard_name" => "vendor"]);
//     $role = Role::findById(2, 'vendor');
//    return  $role->givePermissionTo('product edit');
//    $role->revokePermissionTo('product edit');

//    return Role::create(['name' => 'vendor', 'guard_name' => 'vendor']);


  /*  $users = User::cursor();

    foreach ($users as $user) {
        $user_profile_url = Storage::disk('user_profile')->path("/{$user->id}/");
        $profile_file_name = $user_profile_url . $user->profile_pic;
        $filesInFolder = File::files($user_profile_url);

        foreach($filesInFolder as $file) {
            $moved = File::move($file->getPathname(), $profile_file_name);
            dump($moved, $file->getPathname(), $profile_file_name);
        }
    }*/


/*    $factory = (new Factory)->withServiceAccount(Storage::disk('db')->path('firebase/firebase_credentials.json'));

    $messaging = $factory->createMessaging();

    $message = CloudMessage::withTarget('token', 'fE33YIOuSnqBKSMrxeo0i0:APA91bFtD1D8O6ADQPfAphGv5BbAv_qdtEclEs1kG9MGL6_fjleV1Fzhb_20B1u-HhJhA6h5aruoy1-05yZHO7hBBqb9roWMC9VlJY00HrGOzOj_F4eF5TK7RsTIAP8u2unjcuaFbqYk')
        ->withNotification(Notification::create('Title', 'Body'))
        ->withData(['key' => 'value']);

    $data = $messaging->send($message);
    dd($data);*/


//    $km = Helpers::distanceInKmBetweenEarthCoordinates( 23.911069, 90.396978, 23.924348, 90.391120 );

//    return \App\Model\Bcourier\BcoDeliveryBoy::get_percel();

/*    $first_order = \App\Model\Ecommerce\Api\EcoOrder::first();

    $reg_time = $first_order->user->created_at;
    $order_time = $first_order->created_at;
    $registration_time_limit = json_decode(\App\Model\Dashboard\AdminSetting\AdminSetting::getSetting("User Registration Bonus Time Limit"), true) ;
    $H_to_M =Helpers::hourMinuteToMinute($registration_time_limit["H"], $registration_time_limit["M"]);
    Helpers::giveRegistrationBonus(User::validateReferralId(User::find(144)->referred_by));
    return["reg_time" => $reg_time, "order_time" => $order_time, "defference" => $reg_time->diffInMinutes($order_time), $H_to_M];*/



});





Auth::routes();



Route::get('/','FrontEnd\IndexController@index');
Route::get('/dealer/account','FrontEnd\IndexController@secondIndex');

Route::get('/wallet-profile','FrontEnd\Auth\UserController@walletUser');
Route::get('/cashback-profile','FrontEnd\Auth\UserController@cashbackUser');
//Dealer route
Route::get('/dealer-profile','FrontEnd\Auth\UserController@dealerUser');
Route::get('/dealer-purchase','FrontEnd\Auth\UserController@dealerPurchase');
Route::get('/dealer-orders','FrontEnd\Auth\UserController@dealerOrders');
Route::get('/dealer-wallet','FrontEnd\Auth\UserController@dealerWallet');
Route::get('/dealer-bonus','FrontEnd\Auth\UserController@dealerBonus');
Route::get('/dealer-bonus','FrontEnd\Auth\UserController@dealerBonus');
// user profile

Route::get('/profile_details','FrontEnd\Auth\UserController@profileDetails');
Route::get('/verification','FrontEnd\Auth\UserController@verification');

// applie bp
Route::get('/apply-for-dealer', 'FrontEnd\Auth\UserController@applyForDealer');

//product route
Route::get('/product-details/{product_url}', 'FrontEnd\ProductController@product');
Route::get('/search-products', 'FrontEnd\ProductController@searchProduct')->name('searchProduct');
Route::get('/search-product', 'FrontEnd\ProductController@getSearchData');


Route::get('dealer-product-filter', 'FrontEnd\DealerProductController@delaerProductFilter');
Route::get('/social', 'FrontEnd\PostController@getSocial');

Route::match(['get', 'post'], '/referral-code/{code}','FrontEnd\Auth\UserController@referralCode');
Route::get('/check_user_name_by_introduce_number','FrontEnd\Auth\UserController@checkUserForName');



Route::namespace('FrontEnd')->group(function () {
    Route::group(['middleware' => ['frontlogin']], function () {
        Route::match(['get', 'post'],'/checkout', 'ProductController@checkout');
//        Route::get('/dealer/account', 'Auth\UserController@account');
        Route::get('/e-wallet', 'Auth\UserController@eWallet');
        Route::get('/shopping-wallet', 'Auth\UserController@shoppingWallet');


        Route::post('/withdraw-request', 'Auth\UserController@withdrawRequest');
        Route::post('/send-balance', 'Auth\UserController@sendBalance');
        Route::post('/send-shopping-balance', 'Auth\UserController@sendShoppingBalance');
        Route::post('/payment-shopping-balance', 'Auth\UserController@paymentShoppingBalance');
        Route::post('/add-payment-method', 'Auth\UserController@addPayment');
        Route::get('/merchant-wallet', 'Auth\UserController@getMerchant');

        Route::post('/sell-merchant-balance', 'Auth\UserController@sellMerchantBalance');
        Route::post('/payment-balance', 'Auth\UserController@paymentMerchantBalance');




        Route::get('/dealer/account/order', 'DealerProductController@order');


        Route::get('/dealer/account/order/details/{id}', 'DealerProductController@orderDetails');
        Route::get('/dealer/account/order/pending', 'DealerProductController@pendingOrder');

        Route::get('/dealer/account/order/pending', 'DealerProductController@pendingOrder');
        Route::get('/dealer/account/order/pending/{id}', 'DealerProductController@pendingOrderDetails');
        Route::get('/dealer/account/order/cancel', 'DealerProductController@cancelOrder');
        Route::get('/dealer/account/order/cancel/{id}', 'DealerProductController@cancelOrderDetails');

        Route::get('/dealer/account/order/complete', 'DealerProductController@completeOrder');
        Route::get('/dealer/account/order/complete/{id}', 'DealerProductController@completeOrderDetails');

        Route::get('/dealer/account/order/processing', 'DealerProductController@processingOrder');
        Route::get('/dealer/account/order/processing/{id}', 'DealerProductController@processingOrderDetails');

        Route::get('/dealer/account/order/shipping', 'DealerProductController@shippingOrder');
        Route::get('/dealer/account/product/stock', 'DealerProductController@productStock');
        Route::get('/dealer/account/employee-arena', 'DealerProductController@employeeArena');
        Route::get('/dealer/account/employee-arena/{id}', 'DealerProductController@employeeArenaUser');
        Route::get('/dealer/account/team-arena/', 'DealerProductController@teamArenaUser');



        // dealer service
        Route::get('/dealer-service', 'DealerProductController@dealer_service');
        Route::get('/dealer-purchase', 'DealerProductController@dealerPurchase');
        Route::get('/dealer-list', 'DealerProductController@dealerList');
//        Route::post('/add-dealer-cart', 'DealerProductController@addDealerCart');
        Route::get('/ajax-add_cart', 'DealerProductController@addDealerAjaxCart');
        Route::get('/page_cart', 'DealerProductController@cartPage');
        Route::get('/update-dealer-product-quantity', 'DealerProductController@updateDealerProductQuantity');
        Route::get('/update-dealer-product-status-cart', 'DealerProductController@updateDealerProductStatus');
        Route::get('/delete-dealerquantity/{id}', 'DealerProductController@deleteDealerProductQuantity');
        Route::post('/dealer-checkout', 'DealerProductController@checkout');
        Route::get('/dealer_orders_page', 'DealerProductController@dealerOrderPages');
        Route::get('/dealer_order_details_page_now/{id}', 'DealerProductController@dealerOrderDetailsPagesNow');

        Route::get('/thanks', 'ProductController@thanks');
        Route::get('/update-dealer-product-status-gcart', 'ProductController@updateStatusGcart');
        Route::get('/order_details_page_now', 'ProductController@orderDetailsPageNow');

        Route::get('/social-profile', 'PostController@index');
        Route::post('/social-update-user-information', 'PostController@updateUserInformation');
        Route::post('/social-add-post-ok', 'PostController@addPostOK');
        Route::post('/social-edit-post/{id}', 'PostController@postEdit');
        Route::post('/social-delete-post/{id}', 'PostController@deletePostOnuser')->name('social.post.delete');
        Route::post('/social-comment-post/{id}', 'PostController@commentPost');
        Route::post('/post/comment', 'PostController@commentMain');
        Route::post('/like-post', 'PostController@postLike');
        Route::post('/post-like-commission-hit-ok', 'PostController@postLikeCommissionHitOk');
        Route::post('/post-like-general-hit-ok', 'PostController@postLikeGeneralHitOk');
        Route::post('/post-share-commission-hit-ok', 'PostController@postCommentGeneralHitOk');
        Route::get('/search-user-list', 'PostController@searchUserListGet');

        Route::post('/pin-submit', 'Auth\UserController@pinSubmit');
        Route::match(['get', 'post'],'/user-verification-form', 'Auth\UserController@userFormVerification');
        Route::match(['get', 'post'],'/user-idcart', 'Auth\UserController@userIdCart');
        Route::post('/user-idcart-form', 'Auth\UserController@userIdCartForm');
        Route::post('/change-username-now', 'Auth\UserController@updateUserAccount');
        Route::match(['get', 'post'],'/update-user-all-information', 'Auth\UserController@UpdateUserAllInformation');

        Route::get('/search-user', 'PostController@getSearchData');
        Route::post('/user_profile_update', 'PostController@updateProfileUser');




        Route::patch('/orders/admin/change_status/{order_id}', 'DealerProductController@changeStatus')->name('vendor.orders.admin.change-status');
        Route::post('dealer/orders/order_complete/{order_id}', 'DealerProductController@orderComplete')->name('dealer.orders.complete');
        Route::patch('/dealer/orders/change_status/{id}', 'DealerProductController@shipped')->name('dealer.order.shipped');
        Route::patch('/dealer/orders/change_status/process/{id}', 'DealerProductController@process');
        Route::patch('/dealer/orders/change_status/cancel/{id}', 'DealerProductController@cancel');

    });
});

Route::get('/b_learning_schools', 'Blearning\BlearningController@index');
Route::get('/b_learning_schools/{url}', 'Blearning\BlearningController@singlePageShow');




//cart route
Route::post('/add-cart', 'FrontEnd\ProductController@addCart');
Route::get('/products-filters/{product_urls}', 'FrontEnd\ProductController@products');

Route::get('/update-product-url', 'FrontEnd\ProductController@updateProductUrl');

Route::get('/cart', 'FrontEnd\ProductController@cart');
Route::get('/delete-quantity/{id}', 'FrontEnd\ProductController@deleteQuantity');
Route::get('/update-product-quantity','FrontEnd\ProductController@updateProductQuantity');
Route::post('/cart/apply-coupon', 'FrontEnd\ProductController@applyCoupon');

Route::get('/others-order', 'FrontEnd\ProductController@otherOrders');







Route::get('/change-thana/{id}', 'FrontEnd\ProductController@changeThana');
Route::get('/change-dbacount', 'FrontEnd\Auth\UserController@updatedbaccount');
Route::get('/change-dbacountby', 'FrontEnd\Auth\UserController@updatedbaccountBy');


Route::post('/user_register', 'FrontEnd\Auth\UserController@userRegister');
Route::post('/user_login', 'FrontEnd\Auth\UserController@userLogin');




// Admin Auth
Route::group([
    "namespace" => "AdminAuth",
    "prefix" => "admin",
], function() {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login.submit');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');
});
// admin-dashboard - home
Route::group([
    "namespace" => "Dashboard\Home",
    "prefix" => "dashboard",
    "middleware" => "auth:admin"
], function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');
});
// admin-dashboard - user verification
Route::group([
    "namespace" => "Dashboard\UserVerification",
    "prefix" => "dashboard/user_verification/bp_request",
    "middleware" => "auth:admin"
], function() {
    Route::get('/', 'UserVerificationController@allRequest')->name('user_verification.bp_request');
    Route::get('/datatables', 'UserVerificationController@allRequestDatatables')->name('user_verification.bp_request.datatables');
    Route::get('/pending', 'UserVerificationController@pendingRequest')->name('user_verification.bp_request_pending');
    Route::get('/pending/datatables', 'UserVerificationController@pendingRequestDatatables')->name('user_verification.bp_request_pending.datatables');
    Route::get('/accepted', 'UserVerificationController@acceptRequest')->name('user_verification.bp_request_accepted');
    Route::get('/accepted/datatables', 'UserVerificationController@acceptedRequestDatatables')->name('user_verification.bp_request_accepted.datatables');
    Route::get('/rejected', 'UserVerificationController@rejectedRequest')->name('user_verification.bp_request_rejected');
    Route::get('/rejected/datatables', 'UserVerificationController@rejectedRequestDatatables')->name('user_verification.bp_request_rejected.datatables');
    Route::get('/details/{user_verification}', 'UserVerificationController@details')->name('user_verification.bp_request.details');
    Route::patch('/accept/{id}', 'UserVerificationController@accept')->name('user_verification.bp_request_accept');
    Route::patch('/reject/{user_verification}', 'UserVerificationController@reject')->name('user_verification.bp_request_reject');
    Route::patch('/user_verification_details/modify/{user_verification_details}', 'UserVerificationController@modifyVerificationDetails')->name('user_verification_deails.modify');
});
// admin-dashboard - user withdrawal
Route::group([
    "namespace" => "Dashboard\UserWithdrawal",
    "prefix" => "dashboard/user_withdrawal",
    "middleware" => "auth:admin"
], function() {
    Route::get('/', 'UserWithdrawalController@allWithdrawal')->name('user_withdrawal');
    Route::get('/pending', 'UserWithdrawalController@pending')->name('user_withdrawal.pending');
    Route::get('/accepted', 'UserWithdrawalController@accepted')->name('user_withdrawal.accepted');
    Route::get('/rejected', 'UserWithdrawalController@rejected')->name('user_withdrawal.rejected');
    Route::get('/details/{withdrawal}', 'UserWithdrawalController@details')->name('user_withdrawal.details');
    Route::patch('/accept/{withdrawal}', 'UserWithdrawalController@accept')->name('user_withdrawal.accept');
    Route::patch('/reject/{withdrawal}', 'UserWithdrawalController@reject')->name('user_withdrawal.reject');
    Route::patch('/paid', 'UserWithdrawalController@paid')->name('user_withdrawal.paid');
    Route::patch('/refund', 'UserWithdrawalController@refund')->name('user_withdrawal.refund');
    Route::get('/export/withdrawal_accepted_list', 'UserWithdrawalController@export')->name('user_withdrawal.export.accepted_list');
    Route::get('/account_activation', 'UserWithdrawalController@accountActivation')->name('user_withdrawal.account.activation');
    Route::get('/shopping_wallet', 'UserWithdrawalController@shoppingWallet')->name('user_withdrawal.shopping.wallet');
    Route::get('/shopping_wallet/details/{id}', 'UserWithdrawalController@shoppingWalletDetails')->name('user_withdrawal.shopping.wallet.details');
    Route::post('/shopping-wallet-balance', 'UserWithdrawalController@shoppingWalletBalance')->name('user_withdrawal.shopping.wallet.balance');

    Route::get('/shopping_voucher', 'UserWithdrawalController@shoppingVoucher')->name('user_withdrawal.shopping.voucher');
    Route::get('/shopping_voucher/details/{id}', 'UserWithdrawalController@shoppingVoucherDetails')->name('user_withdrawal.shopping.voucher.details');
    Route::post('/shopping-voucher-balance', 'UserWithdrawalController@shoppingVoucherBalance')->name('user_withdrawal.shopping.voucher.balance');



});

// admin-dashboard - user List
Route::group([
    "namespace" => "Dashboard\UserList",
    "prefix" => "dashboard/bf/user",
    "middleware" => "auth:admin"
], function() {
    Route::get('/', 'UserListController@index')->name('bf.user');
    Route::get('/user-phone-excel', 'UserListController@bvonUserPhoneExcel')->name('bvon.user.phone.excel');
    Route::get('/user_action_bonus', 'UserListController@userActionBonus');


    Route::get('/datatables', 'UserListController@userDatatables')->name('user-datatables');
    Route::get('/assign_job', 'UserListController@assign_job')->name('bf.user.assign_job');
    Route::get('/job_list', 'UserListController@job_list')->name('bf.user.job-list');
    Route::get('/tree_view', 'UserListController@treeView')->name('bf.user.tree-view');
    Route::post('/assign_job', 'UserListController@assign_job_store')->name('bf.user.assign_job_store');
    Route::get('/create', 'UserListController@create')->name('bf.user.create');
    Route::post('/store', 'UserListController@store')->name('bf.user.store');
    Route::get('/{user}', 'UserListController@show')->name('bf.user.details');
    Route::patch('/{user}/change_password', 'UserListController@changePassword')->name('bf.user.change_password');
    Route::patch('/{user}/change_referred_by', 'UserListController@changeReferredBy')->name('bf.user.change_referred_by');
    Route::post('/add-balance', 'UserListController@addOrMinusBalance');
    Route::post('/update-user-details', 'UserListController@updateUserDetails')->name('update.user.information.ok');


    Route::group([
        "namespace" => "\App\Http\Controllers\Dashboard\CashBackTransaction",
        "prefix" => "/{user}",
        "middleware" => "auth:admin"
    ], function() {
        Route::get('/cashback_wallet', 'CashBackTransactionController@index')->name('cashback_wallet');
        Route::post('/cashback_wallet/create', 'CashBackTransactionController@create')->name('create_cashback_wallet');

    });


});




// admin-dashboard - admin setting
Route::group([
    "namespace" => "Dashboard\AdminSetting",
    "prefix" => "dashboard/admin_setting",
], function() {
    Route::get('/setting', 'AdminSettingController@index')->name('admin.setting.index');
    Route::patch('/update', 'AdminSettingController@update')->name('admin.setting.update');

    Route::get('/pin-generate', 'AdminSettingController@pinGenerate')->name('admin.setting.pin');
    Route::post('/add-pin-generate', 'AdminSettingController@addAinGenerate')->name('admin.setting.addPin');
    Route::get('/use-pin-generate', 'AdminSettingController@getUseGenerate');


    Route::get('/doctor-member-pin-generate', 'AdminSettingController@doctorMemberPinGenerate')->name('admin.setting.doctor.member.pin');
    Route::post('/add-doctor-member-pin-generate', 'AdminSettingController@addDoctorMemberPinGenerate')->name('admin.setting.doctor.member.addPin');
    Route::get('/doctor-member-sell', 'AdminSettingController@doctorMemberSellPinCode');
    Route::get('/doctor-member-pin-generate-use', 'AdminSettingController@doctorMemberPinCodeUsed');


    Route::get('/get-commission', 'AdminSettingController@getCommission');
    Route::post('/post-commission', 'AdminSettingController@postCommission');
    Route::get('/get-id-cart', 'AdminSettingController@getIdCart');
    Route::get('/get-id-cart-giving', 'AdminSettingController@getIdCartGiving');
    Route::get('/idcart-active', 'AdminSettingController@idCartActive');
    Route::get('/idcart-delete', 'AdminSettingController@idCartDelete');
    Route::get('/sell', 'AdminSettingController@sellPinCode');
    Route::get('/monthly-salary', 'AdminSettingController@monthDesclySalary');
    Route::get('/monthly-salary-history', 'AdminSettingController@monthDesclySalaryHistory');
    Route::get('/doctor-service-renew-pincode', 'AdminSettingController@doctorServiceRenewPincode');
    Route::get('/doctor-service-used-renew-pincode', 'AdminSettingController@doctorServiceUsedRenewPincode');
    Route::get('/doctor-pincode-sell', 'AdminSettingController@doctorPincodeSell');
    Route::post('/doctor-service-renew-pincode-submit', 'AdminSettingController@doctorServiceRenewPincodeSubmit')->name('renew.doctor.pincode.submit');

});


Route::group([
    "namespace" => "Dashboard\Merchant",
    "prefix" => "dashboard/vendor_merchant",
    "middleware" => "auth:admin"
], function() {
    Route::get('/merchant', 'MerchantAccountController@index')->name('merchant.view');
    Route::match(['get', 'post'],'/merchant/add-account', 'MerchantAccountController@addAccount')->name('merchant.add.account');
    Route::match(['get', 'post'],'/merchant/edit-account/{id}', 'MerchantAccountController@editAccount')->name('merchant.edit.account');
    Route::get('/merchant/merchant-delete', 'MerchantAccountController@deleteAccount');
    Route::get('/merchant/merchant-history/{id}', 'MerchantAccountController@merchantAccountHistory')->name('merchant.account.history');
    Route::post('/merchant-wallet-balance', 'MerchantAccountController@addBalanceMerchant')->name('merchant.account.add.balance');

});



Route::group([
    "namespace" => "Dashboard\Bpay",
    "prefix" => "dashboard/bvon-pay",
    "middleware" => "auth:admin"
], function() {
    Route::match(['get', 'post'],'/bpay-add-category', 'BpayController@addCategory')->name('bvon.bpay.add.category');
    Route::match(['get', 'post'],'/bpay-edit-category/{id}', 'BpayController@editCategory')->name('bvon.bpay.edit.category');
    Route::get('/bpay-view-categories', 'BpayController@viewCategory')->name('bvon.bpay.view.category');
    Route::get('/delete-bpay-category', 'BpayController@deleteCategory');

    // bpay marchant list
    Route::match(['get', 'post'],'/add-marchant-shop', 'BpayController@addMarchantShop')->name('bvon.bpay.add.marchant.shop');
    Route::match(['get', 'post'],'/edit-marchant-shop/{id}', 'BpayController@editMarchantShop')->name('bvon.bpay.edit.marchant.shop');

    Route::get('/view-marchant-shop', 'BpayController@viewMarchantShop')->name('bvon.bpay.view.marchant.shop');
    Route::get('/delete-bpay-marchant-shop', 'BpayController@deleteMarchantShop');




});












Route::group([
    "namespace" => "Dashboard\BDoctor",
    "prefix" => "dashboard/bvon-doctor",
    "middleware" => "auth:admin"
], function() {
    Route::get('/view-doctor', 'DoctorController@index')->name('bvon.doctor.view');
    Route::match(['get', 'post'],'/add-doctor', 'DoctorController@addDoctor')->name('bvon.add.doctor');
    Route::match(['get', 'post'],'/edit-doctor/{id}', 'DoctorController@editDoctor')->name('bvon.edit.doctor');
    Route::get('/doctor-delete', 'DoctorController@deleteDoctorInfo');
    Route::get('/doctor-register-user-list', 'DoctorController@doctorRegisterUserList')->name('bvon.doctor.register.user.list');

    Route::get('/doctor-register-sub-member-user-list/{id}', 'DoctorController@doctorRegisterUserSubMemberList');

//    Route::post('/merchant-wallet-balance', 'MerchantAccountController@addBalanceMerchant')->name('merchant.account.add.balance');
    Route::get('/doctor-patient-prescription-list', 'DoctorController@patientPrescriptionList')->name('bvon.doctor.patient.prescription.list');
    Route::match(['get', 'post'],'/bvon-doctor-chamber-created', 'DoctorController@bvonDoctorChamber')->name('bvon.doctor.chamber.create');
    Route::match(['get', 'post'],'/bvon-doctor-chamber-edit/{id}', 'DoctorController@bvonDoctorChamberEdit')->name('bvon.doctor.chamber.edit');

    Route::get('/bvon-doctor-chamber-delete', 'DoctorController@deleteDoctorChamber');
    Route::get('/bvon-doctor-chamber-list', 'DoctorController@bvonDoctorChamberList')->name('bvon.doctor.chamber.list');
    Route::match(['get', 'post'],'/bvon-doctor-add-service-list', 'DoctorController@bvonDoctorAddServiceList')->name('bvon.doctor.add.service.list');
    Route::get('/bvon-doctor-service-list', 'DoctorController@bvonDoctorServiceList')->name('bvon.doctor.service.list');
    Route::match(['get', 'post'],'/bvon-doctor-edit-service-list/{id}', 'DoctorController@bvonDoctorServiceListEdit')->name('bvon.doctor.service.list.edit');


    Route::get('/bvon-doctor-service-list-delete', 'DoctorController@bvonDoctorServiceListDelete');
    Route::get('/bvon-doctor-field-officer-work-list', 'DoctorController@bvonDoctorOfficerWorkList')->name('bvon.doctor.officer.work.list');
    Route::get('/bvon-doctor-field-officer-work-history/{id}', 'DoctorController@bvonDoctorOfficerWorkHistory')->name('bvon.doctor.officer.work.history');
    Route::get('/bvon-doctor-field-officer-id_card', 'DoctorController@bvonDoctorOfficerIDCard');

    // bvon doctor officer
    Route::match(['get','post'],'/add-doctor-officer', 'DoctorController@bvonDoctorOfficerAdd')->name('bvon.doctor.add.officer');
    Route::get('/view-doctor-officer', 'DoctorController@bvonDoctorOfficerView')->name('bvon.doctor.view.officer');
    Route::get('/view-doctor-officer-details/{id}/{type}', 'DoctorController@bvonDoctorOfficerViewDetails');
    Route::get('/view-doctor-officer-work-history/{id}/{type}', 'DoctorController@bvonDoctorOfficerWorkHistoryAll');

    Route::get('/view-doctor-officer-signup-history/{id}/{type}', 'DoctorController@bvonDoctorOfficerSignUpHistoryAll');

    Route::get('/district-doctor-officer', 'DoctorController@getDistrictDoctorOfficer')->name('bvon.doctor.district.officer');
    Route::get('/district-doctor-officer/fetch', 'DoctorController@getDistrictDoctorOfficerFetch');

    Route::get('/upazilla-doctor-officer', 'DoctorController@getUpazillaDoctorOfficer')->name('bvon.doctor.upazilla.officer');
    Route::get('/upazilla-doctor-officer/fetch', 'DoctorController@getUpazillaDoctorOfficerFetch');

    Route::get('/field-doctor-officer', 'DoctorController@getFieldDoctorOfficer')->name('bvon.doctor.field.officer');
    Route::get('/field-doctor-officer/fetch', 'DoctorController@getFieldDoctorOfficerFetch');




    Route::post('dynamic_dependent/fetch', 'DoctorController@fetch')->name('dynamicdependent.fetch');
    Route::post('/dynamic_dependent/fetch-table', 'DoctorController@fetchTable');
    Route::post('/dynamic_dependent/fetch-table-field', 'DoctorController@fetchTableField');
    Route::get('/dynamic_dependent/fetch-table-district', 'DoctorController@fetchTableDistrict');


    Route::get('/view-doctor-officer-list-under-district/{id}/{type}', 'DoctorController@bvonDoctorOfficerDistrictList');
    Route::get('/view-doctor-officer-list-under-upazilla/{id}/{type}', 'DoctorController@bvonDoctorOfficerUpazillaList');








});
Route::post('/fetch-thana-data-dependacy', 'Dashboard\BDoctor\DoctorController@thanaDataDepndancy');





Route::group([
    "namespace" => "Dashboard\Quizze",
    "prefix" => "dashboard/bvon-quizze",
    "middleware" => "auth:admin"
], function() {
    Route::match(['get', 'post'],'/add-quizze-teacher', 'QuizzeSectionController@addTeacher')->name('bvon.quizze.add.teacher');
    Route::get('/view-quizze-teacher', 'QuizzeSectionController@viewTeacher')->name('bvon.quizze.view.teacher');
    Route::get('/quizze-teacher-delete', 'QuizzeSectionController@deleteTeacherFromQuizze');



});















Route::group([
    "namespace" => "FrontEnd",
    "middleware" => "frontlogin"
], function() {
    //page controller router
    Route::get('/page/post/create', 'PagePostController@createPost')->name('page.post.create');
    Route::post('/page/post/add-post', 'PagePostController@addPagePost')->name('page.post.add');
    Route::get('/page/post/view', 'PagePostController@view')->name('page.post.view');
    Route::get('/page/post/edit/{id}', 'PagePostController@editPost')->name('page.post.edit');
    Route::match(['get', 'post'],'/page/page/post/user/edit/{id}', 'PagePostController@editUserPost')->name('page.page.post.user.edit');
    Route::match(['get', 'post'],'/page/page/post/user/delete/{id}', 'PagePostController@deleteUserPost')->name('page.page.post.user.delete');


    Route::get('/page/page/post/view/{id}', 'PagePostController@viewPagePost')->name('page.page.post.view');
    Route::match(['get', 'post'],'/page/page/post/edit/{id}', 'PagePostController@editPagePost')->name('page.page.post.edit');
    Route::post('/page/page/post/delete/{id}', 'PagePostController@deletePagePost')->name('page.page.post.delete');


    Route::get('/quizze/add_quizze', 'QuizzeController@add_quizze')->name('quizze.add.quizze');
    Route::post('/quizze/add_quizze/mcq', 'QuizzeController@mcq')->name('quizze.add.quizze.mcq');
    Route::post('/quizze/add_quizze/boolean', 'QuizzeController@boolean')->name('quizze.add.quizze.boolean');
    Route::post('/quizze/add_quizze/written', 'QuizzeController@written')->name('quizze.add.quizze.written');

    Route::get('/quizze/view/quizze', 'QuizzeController@view_quizze')->name('quizze.view.quizze');
    Route::get('/quizze/edit/quizze/{id}', 'QuizzeController@edit_quizze')->name('quizze.edit.quizze');
    Route::get('/quizze/delete/quizze/{id}', 'QuizzeController@delete_quizze')->name('quizze.delete.quizze');


    // quizze Exam

    Route::match(['get', 'post'],'/quizze/exam/add_quizze_exam', 'QuizzeController@addQuizzeExam')->name('quizze.exam.add.quizze.exam');
    Route::get('/quizze/exam/view/quizze', 'QuizzeController@viewQuizzeExam')->name('quizze.view.quizze.exam');
    Route::get('/quizze/exam/complain/report', 'QuizzeController@viewQuizzeComplainReport')->name('quizze.exam.complain.report');



    Route::match(['get', 'post'],'/user/quizze/exam/add/question/{id}', 'QuizzeController@addQuizzeExamQuestionUser')->name('user.quizze.exam.add.question');
    Route::match(['get', 'post'],'/user/quizze/exam/view/question/{id}', 'QuizzeController@viewQuizzeExamQuestionUser')->name('user.quizze.exam.view.question');


    Route::match(['get', 'post'],'/user/quizze/edit/exam/{id}', 'QuizzeController@userEditExam')->name('user.quizze.edit.exam');
    Route::post('/user/quizze/delete/exam/{id}', 'QuizzeController@userDeleteExam')->name('user.quizze.exam.delete');




    Route::post('/user/quizze/add_quizze/exam/question/mcq', 'QuizzeController@mcqExam')->name('user.quizze.add.quizze.exam.question.mcq');
    Route::post('/user/quizze/add_quizze/exam/question/boolean', 'QuizzeController@booleanExam')->name('user.quizze.add.quizze.exam.question.boolean');
    Route::post('/user/quizze/add_quizze/exam/question/written', 'QuizzeController@writtenExam')->name('user.quizze.add.quizze.exam.question.written');
    Route::post('/user/quizze/quizze/exam/quizze/question/delete/{id}', 'QuizzeController@deleteExamQuestion')->name('user.quizze.exam.quizze.question.delete');


    // History Route
    Route::get('/user/history', 'HistoryController@history')->name('user.history.machine');
    Route::get('/user/history/salary', 'HistoryController@historySalary')->name('user.history.salary');
    Route::get('/user/history/salary/designation/{type}', 'HistoryController@historyDesignationSalary')->name('user.history.salary.designation');
    Route::match(['get', 'post'],'/user/history/add-matrix', 'HistoryController@addMatrixGeneral')->name('user.history.add.matrix');
    Route::get('/user/history/view-matrix', 'HistoryController@viewMatrixGeneral')->name('user.history.view.matrix');
    Route::get('/user/history/view-matrix/search', 'HistoryController@viewMatrixGeneralSearch')->name('user.history.view.matrix.search');
    Route::get('/user/history/view-matrix/view/{id}', 'HistoryController@viewMatrixGeneralView')->name('user.history.view.matrix.view');



    Route::get('/bvon/quizze/start', 'QuizzeController@bvonQuizze')->name('bvon.quizze.start');
    Route::get('/bvon/quizze/start/submit', 'QuizzeController@bvonQuizzeSubmit')->name('bvon.quizze.start.submit');
    Route::get('/bvon/quizze/start/exam', 'QuizzeController@bvonQuizzeExam')->name('bvon.quizze.start.exam');
    Route::post('/bvon/quizze/start/exam/free', 'QuizzeController@bvonQuizzeExamFree')->name('bvon.quizze.start.exam.free');

    Route::get('/bvon/quizze/start/exam/start/{id}', 'QuizzeController@bvonQuizzeExamStart')->name('bvon.quizze.start.exam.start');
    Route::post('/bvon/quizze/start/exam/start/submit', 'QuizzeController@bvonQuizzeExamStartSubmit')->name('bvon.quizze.start.exam.start.submit');
    Route::get('/bvon/quizze/start/exam/start/ok/thanks/{id}', 'QuizzeController@bvonQuizzeExamStartThanks')->name('bvon.quizze.start.exam.start.thanks');


    //ratting now
    Route::get('/bvon/quizze/start/exam/ratting/', 'QuizzeController@bvonQuizzExamRatting')->name('bvon.quizze.start.exam.ratting');
    Route::get('/bvon/quizze/start/exam/ratting/question/{id}', 'QuizzeController@bvonQuizzExamRattingQuestion')->name('bvon.quizze.start.exam.ratting.question');
    Route::get('/bvon/quizze/start/exam/ratting/user/{id}', 'QuizzeController@bvonQuizzExamUserRattingQuestion')->name('bvon.quizze.start.exam.user.ratting.question');
    Route::get('/bvon/quizze/start/exam/ratting/gquizze', 'QuizzeController@bvonQuizzExamRattingG')->name('bvon.quizze.start.exam.g.ratting');
    Route::get('/bvon/quizze/start/question/complain/submit', 'QuizzeController@bvonStartQuestionComplainSubmit')->name('bvon.quizze.start.question.complain.submit');

    // Charity Route/user/history
    Route::get('/charity/user/event', 'CharityController@getevent')->name('charity.user.event');
    Route::post('/charity/user/event/payment', 'CharityController@charityPayment')->name('charity.user.event.payment');

    //sub admin
    Route::get('/charity/sub-admin/history', 'CharityController@subAdmin')->name('charity.sub.admin.history');
    Route::get('/charity/sub-admin/transaction/history/{id}', 'CharityController@transaction')->name('charity.sub.admin.transaction.history');


    //blood route
    Route::match(['get', 'post'],'/bvon/blood/user/add-status', 'BloodController@addStatus')->name('bvon.blood.user.add.status');
    Route::match(['get', 'post'],'/bvon/blood/user/view-status', 'BloodController@viewStatus')->name('bvon.blood.user.view.status');
    Route::match(['get', 'post'],'/bvon/blood/user/edit-status/{id}', 'BloodController@editStatus')->name('bvon.blood.user.edit.status');
    Route::post('/bvon/blood/user/delete-status/{id}', 'BloodController@deleteStatus')->name('bvon.blood.user.delete.status');

    Route::get('/bvon/blood/user/status', 'BloodController@status')->name('bvon.blood.user.status');
    Route::get('/bvon/blood/user/status/giving', 'BloodController@statusGiving')->name('bvon.blood.user.status.giving');
    Route::get('/bvon/blood/user/status/needed', 'BloodController@statusNeed')->name('bvon.blood.user.status.needed');
    Route::get('/bvon/blood/user/status/already', 'BloodController@statusAlready')->name('bvon.blood.user.status.already');
    Route::get('/bvon/blood/user/status/giving/update', 'BloodController@statusGivingUpdate')->name('bvon.blood.user.status.giving.update');
    Route::get('/bvon/blood/user/status/already/update', 'BloodController@statusAlreadyUpdate')->name('bvon.blood.user.status.already.update');


    Route::match(['get', 'post'],'/page/boost/add_page_boost', 'PageBoostController@addPageBoost')->name('page.boost.add.page.boost');
    Route::get('/page/boost/view_page_boost', 'PageBoostController@viewPageBoost')->name('page.boost.view.page.boost');






});

Route::get('/bvon/blood/user/status/dependency/thana', 'FrontEnd\BloodController@dependancyThana')->name('bvon.blood.user.status.dependency.thana');
Route::get('/bvon/blood/user/status/dependency/area', 'FrontEnd\BloodController@dependancyArea')->name('bvon.blood.user.status.dependency.area');






















// admin-dashboard - reports
Route::group([
    "namespace" => "Dashboard\Report",
    "prefix" => "dashboard/report",
], function() {
    Route::get('/', 'ReportController@index')->name('report.index');
});






// Example
Route::view('/pages/slick', 'pages.slick')->middleware('auth:admin');
Route::view('/pages/datatables', 'pages.datatables')->middleware('auth:admin');
Route::view('/pages/blank', 'pages.blank')->middleware('auth:admin');
Route::view('/pages/forms', 'pages.forms')->middleware('auth:admin');
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/new-privacy-policy', 'pages.new-privacy-policy');



/* ==============Ecommerce: Vendor Auth Controller============================ */
require_once 'ecommerce/vendor-auth-route.php';
/* ==============Ecommerce: Vendor Auth Controller============================ */

/* ==============Ecommerce: Vendor Auth Controller============================ */
require_once 'ecommerce/web-ecommerce-route.php';
/* ==============Ecommerce: Vendor Auth Controller============================ */

/* ==============Ecommerce: Vendor Auth Controller============================ */
require_once 'bcourier/web-bcourier-web.php';
/* ==============Ecommerce: Vendor Auth Controller============================ */

/* ==============Ecommerce: B-dealer route ============================ */
require_once 'b-dealer/web-b-dealer-route.php';
/* ==============Ecommerce: B-dealer route ============================ */




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{any}', function (){
    return view('index');
});
Route::get('{any}/{any1}', function (){
    return view('index');
});
Route::get('/dealer/{any1}/{any2}', function (){
    return view('second');
});

Route::get('/dealer/account-order/{any2}/{any3}', function (){
    return view('second');
});

Route::get('/dealer/account-order/{any2}/{any3}/{any6}', function (){
    return view('second');
});
Route::get('/bvon-doctor/section/{any}', function (){
    return view('second');
});
