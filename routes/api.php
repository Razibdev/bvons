<?php

use App\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Support\Facades\Route;

//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
//header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');

/* ==============Api: Auth Controller============================ */
Route::group([
    'middleware' => 'api',
    'namespace' => 'Api\Auth'
], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('get_auth_user', 'AuthController@getAuthUser');
    Route::post('check_user_exists', 'AuthController@userExists');
    Route::get('check_valid_ref_id/{ref_id}', 'AuthController@validateReferralId');
    Route::post('/is_auth', 'AuthController@isAuth');
    Route::get('/get-user-info/{id}', 'AuthController@userInfo');
});



/* ==============Api: Auth Controller============================ */


/* ==============Api: Friend Request Controller============================ */
require_once 'api/friend-route.php';
/* ==============Api: Friend Request Controller============================ */


/* ==============Api: Post Controller============================ */
require_once 'api/post-route.php';
/* ==============Api: Post Controller============================ */

/* ==============Api: Comment Controller============================ */
require_once 'api/comment-route.php';
/* ==============Api: Comment Controller============================ */

/* ==============Api: User Controller============================ */
require_once 'api/user-route.php';
/* ==============Api: User Controller============================ */

/* ==============Api: Payment Method Controller============================ */
require_once 'api/payment-method-route.php';

/* ==============Api: social Controller============================ */

require_once 'api/social-route.php';


/* ==============Api: User Controller============================ */


Route::group([
    'namespace' => 'Api\Vue',
],function(){
    Route::post('/user-code-check/', 'UserController@codeGenerate');
    Route::get('/user-code-check-active/{phone}', 'UserController@codeCheck');
    Route::post('/user-change-password', 'UserController@changePassword');
    //user register
    Route::post('/user-code-send-for-register', 'UserController@codeSendForRegister');
    Route::get('/get-all-dealer-fetch', 'UserController@getAllDealerFetch');

    Route::get('/dealer-zone-area', 'ProductController@zone');
    Route::get('/dealer-district', 'ProductController@districtInfo');
    Route::get('/dealer-thana', 'ProductController@thanaInfo');
    Route::get('/dealer-village', 'ProductController@villageInfo');
});

Route::group([
    'middleware' => 'JWT',
    'namespace' => 'Api\Vue',
], function () {
    //User Password change

    Route::post('/apply-for-id-card', 'UserController@applyIdCard');


    Route::get('/dealer/account/salary-get-setting', 'DesignationController@getSalarySetting');
    Route::get('/dealer/account/salary-get-daily', 'DesignationController@getSalaryDaily');
    Route::get('/dealer/account/salary-user-count', 'DesignationController@getSalaryUserCount');
    Route::get('/dealer/account/salary-user-total', 'DesignationController@getSalaryUserTotal');
    Route::get('/dealer/account/salary-user-achievement', 'DesignationController@getSalaryUserAchievement');
    Route::get('/dealer/account/salary-get-history', 'DesignationController@getSalaryUserHistory');

    //transaction route
    Route::get('/vue-wallet', 'TransactionController@getEWallet');
    Route::get('/vue-wallet/users', 'TransactionController@getEWalletUserInfo');
    Route::get('/vue-shopping-wallet', 'TransactionController@getShoppingWallet');
    Route::post('/vue-wallet/add-payment', 'TransactionController@addPaymentWallet');
    Route::get('/vue-wallet/get-payment-method/{id}', 'TransactionController@getPaymentWallet');
    Route::post('/vue-wallet/get-payment-withdraw-request', 'TransactionController@getPaymentWithdrawRequest');
    Route::post('/vue-wallet/send-payment-request', 'TransactionController@sendPaymentRequest');
    Route::post('/vue-wallet/send-payment-request-marchent', 'TransactionController@sendPaymentRequestMarchent');

    //shopping wallet
    Route::get('/vue-shopping-wallet/marchent-users', 'TransactionController@getMarchentUserInfo');
    Route::post('/vue-shopping-wallet/shopping-wallet-to-bvon-balance', 'TransactionController@getShoppingWalletToBvonBalance');
    Route::post('/vue-shopping-wallet/shopping-wallet-to-e-wallet', 'TransactionController@getShoppingWalletToEWallet');
    //marchent Wallet
    Route::get('/vue-shopping-wallet/marchent-transactions', 'TransactionController@getMarchentTransactions');
    Route::post('/vue-marchann-wallet/marchent-transactions-request', 'TransactionController@marchentTransactionsRequest');

    Route::get('/get-user-info', 'TransactionController@getUserInfo');
    Route::post('/bvon-doctor/section/add-prescription', 'DoctorController@addPrescription');
    Route::get('/bvon-doctor-prescription-list/{id}', 'DoctorController@bvonDoctorPrescriptionList');


    //dealer product route

    Route::get('/dealer-products', 'ProductController@dealerIndex');
    Route::post('/add-dealer-cart', 'ProductController@dealerAddCart');
    Route::get('/get-dealer-cart', 'ProductController@dealerGetCart');
    Route::post('/dealer-cart/cart-quanity-plus', 'ProductController@increaseDealerCartQty');
    Route::post('/dealer-cart/cart-quanity-minus', 'ProductController@decreaseDealerCartQty');
    Route::post('/dealer-cart/destroy', 'ProductController@dealerCartItemDelete');
    Route::post('/dealer-order/complete', 'ProductController@dealerOrderComplete');
    Route::get('/get-dealer-order/list', 'ProductController@getDealerOrderList');
    Route::get('/dealer-single-order/details/{id}', 'ProductController@getDealerSingleOrderList');
    Route::get('/dealer-order/cancel/{id}', 'ProductController@cancelDealerOrderList');


    Route::post('/bvon-dealer-apply', 'ProductController@bvonDealerApply');









});
Route::group([
    'middleware' => 'JWT',
    'namespace' => 'Api\Vue',
], function () {
    Route::get('bvon-doctor/section/bvon-doctor/user-list-view', 'DoctorController@getDoctorUserListView');
    Route::get('bvon-doctor/section/view-prescription/{id}', 'DoctorController@getDoctorPrescriptionUserView');
    Route::get('bvon-doctor/section/all-member-list/', 'DoctorController@getAllMemberList');
    Route::post('/bvon-doctor-service', 'DoctorController@bvonDoctorService');
    Route::get('/bvon-chamber-service-token', 'DoctorController@bvonDoctorServiceToken');
    Route::get('/bvon-chamber-service-token-thana', 'DoctorController@bvonDoctorServiceTokenThana');
    Route::post('/bvon-doctor-service-appointment-submit', 'DoctorController@bvonDoctorServiceAppointmentSubmit');
    Route::get('/get-doctor-appointment-token/{id}', 'DoctorController@bvonDoctorServiceTokens');
    Route::get('/get-doctor-service-list', 'DoctorController@bvonDoctorServiceFetch');
    Route::get('/bvon-chamber-service-token-filter', 'DoctorController@bvonDoctorServiceFetchFilter');
    Route::get('/bvon-chamber-service-token-filter-thana', 'DoctorController@bvonDoctorServiceFetchFilterThana');
    Route::get('/bvon-chamber-service-token-filter-service', 'DoctorController@bvonDoctorServiceFetchFilterService');
    Route::get('/get-doctor-service-activation', 'DoctorController@getDoctorActivation');
    Route::post('/bvon-doctor-service-renew', 'DoctorController@doctorServiceRenewSubmit');
    Route::get('/get-doctor-list-fetch', 'DoctorController@doctorListFetch');

    //prescription part
    Route::get('/doctor-prescription-sub-member', 'DoctorController@bvonDoctorPrescriptionSubMember');


    //Bvon doctor officer target history route here
    Route::get('bvon-doctor/section/target-list', 'DoctorController@doctorOfficerTargetList');
    Route::get('/bvon-doctor/section/bvon-doctor-officer-signup-list/{id}', 'DoctorController@doctorOfficerSignUpList');




    // Second page Section
    Route::get('/second-page-doctor-officer-check', 'DoctorController@secondPageOfficerCheck');
    //Header profile Section
    Route::post('/apply-for-premium-user', 'ProfileSectionController@applyPremiumUser');
    Route::post('/apply-for-username-change', 'ProfileSectionController@applyUsernameChange');
    Route::post('/change-dealer-own-if-need', 'UserController@changeDealerIfNeed');


    // dealer account service
    Route::get('/dealer/account/all-order-dealer', 'DealerSectionController@allOrder');
    Route::get('/dealer/account/pending-order-dealer', 'DealerSectionController@pendingOrder');
    Route::get('/dealer/account/processing-order-dealer', 'DealerSectionController@processingOrder');
    Route::get('/dealer/account/shipping-order-dealer', 'DealerSectionController@shippingOrder');
    Route::get('/dealer/account/complete-order-dealer', 'DealerSectionController@CompleteOrder');
    Route::get('/dealer/account/cancel-order-dealer', 'DealerSectionController@cancelOrder');

    Route::get('/dealer/account-order/details-dealer/{id}', 'DealerSectionController@orderDetials');
    Route::get('/dealer/account-order/details-dealer-processing/{processing}/{id}', 'DealerSectionController@orderProcessing');
    Route::get('/dealer/account-order/details-dealer-shipped/{shipped}/{id}', 'DealerSectionController@orderShipped');
    Route::get('/dealer/account-order/details-dealer-complete/{complete}/{id}', 'DealerSectionController@orderComplete');
    Route::post('/dealer/account-order/details-dealer-cancel/{cancel}/{id}', 'DealerSectionController@orderCancel');


    // Dealer Stock Section front
    Route::get('/dealer/stock/all-stock', 'DealerSectionController@allStockDealer');

    // Dealer Employee Area na
    Route::get('/dealer/employee/employee-area-na', 'DealerSectionController@employeeAreaNa');
    Route::get('/dealer/employee-employee-area-na/{id}', 'DealerSectionController@employeeAreaNaDetails');
    Route::get('/dealer/employee/user-employee-downline', 'DealerSectionController@employeeDownline');
    Route::get('/dealer/employee-employee-downline/{users}', 'DealerSectionController@employeeDownlineDetails');





    //bvon quizze system
    Route::post('/bvon-quizze/add-quizze-exam', 'BvonQuizzeController@addQuizzeExam');
    Route::post('/bvon-quizze/edit-quizze-exam/{id}', 'BvonQuizzeController@editQuizzeExam');
    Route::get('/bvon-quizze/view-quizze-exam', 'BvonQuizzeController@viewQuizzeExam');
    Route::get('/bvon-quizze/get-single-quizze-exam/{id}', 'BvonQuizzeController@getQuizzeExamSingle');
    Route::post('/bvon-quizze/add-quizze-exam-question', 'BvonQuizzeController@addQuizzeExamQuestion');
    Route::get('/dealer/account-view-bvon-quizze-exam-questions/{id}', 'BvonQuizzeController@viewQuizzeExamQuestion');
    Route::get('/dealer/account-delete-bvon-quizze-exam/{id}', 'BvonQuizzeController@deleteQuizeExam');
    Route::get('/bvon-quizze/view-quizze-exam-single-question/{id}/{examId}', 'BvonQuizzeController@getSingleExamQuestion');
    Route::post('/bvon-quizze/edit-quizze-exam-question-update/{id}/{examId}', 'BvonQuizzeController@getExamQuestionUpdate');
    Route::get('/dealer/account-delete-bvon-quizze-exam-question/{id}', 'BvonQuizzeController@deleteBvonQuizzeExamQuestion');

    //general Quizze Question
    Route::post('/bvon-quizze/add-general-quizze-question', 'BvonQuizzeController@addGeneralQuizzeQuestion');
    Route::get('/dealer/account-view-bvon-general-quizze-questions/', 'BvonQuizzeController@viewGeneralQuizzeQuestion');
    Route::get('/dealer/account-view-bvon-general-single-quizze-questions/{id}', 'BvonQuizzeController@viewGeneralSingleQuizzeQuestion');
    Route::post('/dealer/account-edit-bvon-edit-quizze-question/{id}', 'BvonQuizzeController@editGeneralQuizzeQuestion');
    Route::get('/dealer/account-delete-bvon-general-quizze-question/{id}', 'BvonQuizzeController@deleteGeneralQuizzeQuestion');

    //front section general question show
    Route::get('/bvon-general-quizze-single', 'BvonQuizzeController@bvonGeneralQuizzeSingle');
    Route::post('/bvon-general-quizze-single-submit', 'BvonQuizzeController@bvonGeneralQuizzeSingleSubmit');
    Route::get('/bvon-general-quizze-rank-show', 'BvonQuizzeController@bvonGeneralQuizzeRankShow');
    Route::get('/bvon-exam-quizze-single/{id}', 'BvonQuizzeController@bvonExamQuizzeSingle');
    Route::post('/bvon-exam-quizze-submit', 'BvonQuizzeController@bvonExamQuizzeSubmit');
    Route::get('/bvon-attend-all-quizze-exam/', 'BvonQuizzeController@bvonAllExamQuizzeGet');
    Route::get('/bvon-exam-quizze-rank-show/{id}', 'BvonQuizzeController@bvonExamQuizzeRank');
    Route::get('/bvon-exam-quizze-own-details/{id}', 'BvonQuizzeController@bvonExamQuizzeOwnDetails');

    //bvon b-pay service
    Route::get('/bpay-categories-get', 'BpayController@bpayCategory');
    Route::get('/bpay-service-list/{id}', 'BpayController@bpayServiceList');
    Route::get('/bvon-bpay-service-list-filter-district', 'BpayController@bpayServiceFilterDistrict');
    Route::get('/bvon-bpay-service-list-filter-thana', 'BpayController@bpayServiceFilterThana');
    Route::get('/bvon-bpay-service-list-filter-phone/{phone}', 'BpayController@bpayServiceFilterPhone');




});


//Route::get('/is_maintenance_mode', function(){
//    return app()->isDownForMaintenance() ? 1 : 0;
//})->withoutMiddleware([CheckForMaintenanceMode::class]);


/* ============== Ecommerce ============================ */
require_once 'ecommerce/api-ecommerce-route.php';
/* ==============Ecommerce============================ */

/* ============== Bcourier ============================ */
require_once 'bcourier/api-bcourier-route.php';
/* ============== Bcourier ============================ */

/* ============== B-Bealer ============================ */
require_once 'b-dealer/api-b-dealer-route.php';
/* ============== B-Bealer ============================ */




