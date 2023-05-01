<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// Ecommerce products route


Route::group([
    "middleware" => ["auth:vendor", "role:vendor|administrator"],
    'namespace' => 'Ecommerce\Web',

], function () {

    Route::get('products/all', 'ProductController@all')->name('products.all')->middleware('role:administrator');
    Route::get('products/all/datatables', 'ProductController@allDatatables')->name('products.all.datatables')->middleware('role:administrator');
    Route::get('products/pending', 'ProductController@pending')->name('products.pending')->middleware('role:administrator');
    Route::get('products/pending/datatables', 'ProductController@pendingDatatables')->name('products.pending.datatables')->middleware('role:administrator');
    Route::get('product/details/{id}', 'ProductController@details')->name('products.details');
    Route::get('product/details/{id}/edit', 'ProductController@edit')->name('products.details.edit');
    Route::delete('product/details/{id}/delete', 'ProductController@delete')->name('products.details.delete');
    Route::patch('product/approved/{id}', 'ProductController@approved')->name('products.approved');
    Route::post('product/add_bdealer_price/{id}', 'ProductController@addBdealerPrice')->name('products.add-beader-price');


    Route::get('product/show_product_to_dealer', 'ProductController@showProductToDealer')->name('products.show-product-to-dealer')->middleware('role:administrator');
    Route::put('product/show_product_to_dealer', 'ProductController@updateProductToDealer')->name('products.update-product-to-dealer')->middleware('role:administrator');

    Route::get('product/ajax_get_product','ProductController@ajaxGetProduct')->name('ajaxGetProduct');

    Route::get('products/trashed','ProductController@trashed')->name('products.trashed');
    Route::get('products/restore/{product_id}','ProductController@restoreProduct')->name('products.restore');
    Route::resource('products','ProductController');



    Route::get('low/stock/products', 'ProductController@lowstock')->name('low_stock');
    Route::get('stock/products', 'ProductController@all_stock')->name('all_stock');
    Route::get('multi/products', 'ProductController@multi')->name('products.multi');
    Route::post('multi/products/store', 'ProductController@multiSubmit')->name('products.multi.store');
    Route::get('/new/product/add/{id}/{quantity}', 'ProductController@productsNewAdd')->name('products.new.add');
    Route::get('/media/delete/{id}', 'ProductController@mediadelete')->name('media.delete');
    Route::get('/media/edit/{id}', 'ProductController@mediaedit')->name('media.edit');
    Route::post('/media/update/{id}', 'ProductController@mediaupdate')->name('media.update');
    Route::post('/media/new/add', 'ProductController@mediaAddNew')->name('media.add');

    Route::match(['post', 'get'],'/dealer/product-stock', 'ProductController@dealerStockAdd');







});



Route::group([
    "middleware" => ["auth:vendor", "role:administrator"],
    'namespace' => 'Ecommerce\Web',
], function () {
    Route::resource('category','CategoryController');
    Route::get('/social/post', 'PostController@post')->name('social.post');
    Route::post('/social/add-post', 'PostController@addPost');
    Route::get('/social/post-hide', 'PostController@postHideShow')->name('social.post.hide');
    Route::post('/social-edit/{id}', 'PostController@editPost');
    Route::post('/social-delete/{id}', 'PostController@deletePost');
    Route::post('/social-hide/{id}', 'PostController@postHide');
    Route::post('/social-post-restore/{id}', 'PostController@postRestore');
    Route::get('social/comment', 'PostController@comment')->name('social.comment');
    Route::post('/social-edit-comment/{id}', 'PostController@editComment');
    Route::post('/social-edit-comment-delete/{id}', 'PostController@deleteComment')->name('comment.destroy');


    Route::get('/page/create', 'PageController@index')->name('page.create');
    Route::post('/page/add-page', 'PageController@addPage')->name('page.add.page');
    Route::get('/page/view', 'PageController@view')->name('page.page.view');
    Route::match(['get', 'post'],'/page/edit/{id}', 'PageController@editPage')->name('page.page.edit');
    Route::post('/page/delete/{id}', 'PageController@deletePage')->name('page.page.delete');




    Route::get('/b_learning_school/dashboard', 'BlearningController@index')->name('blearning.dashboard');
    Route::match(['get', 'post'],'blearning/categories/create', 'BlearningController@addCategory')->name('blearning.categories.create');
    Route::get('/blearning/categories/view', 'BlearningController@viewCategory')->name('blearning.categories.view');
    Route::match(['get', 'post'],'/blearning/categories/edit/{id}', 'BlearningController@editCategory')->name('blearning.categories.edit');
    Route::post('/blearning/categories/delete/{id}', 'BlearningController@deleteCategory')->name('blearning.categories.delete');


    Route::match(['get', 'post'],'/blearning/course/create', 'BlearningController@addCourse')->name('blearning.course.create');
    Route::get('/blearning/course/view', 'BlearningController@viewCourse')->name('blearning.course.view');
    Route::match(['get', 'post'],'/blearning/course/edit/{id}', 'BlearningController@editCourse')->name('blearning.course.edit');
    Route::post('/blearning/course/delete/{id}', 'BlearningController@deleteCourse')->name('blearning.course.delete');


    Route::match(['get', 'post'],'/blearning/teacher/create', 'BlearningController@addTeacher')->name('blearning.teacher.create');
    Route::get('/blearning/teacher/view', 'BlearningController@viewTeacher')->name('blearning.teacher.view');
    Route::match(['get', 'post'],'/blearning/teacher/edit/{id}', 'BlearningController@editTeacher')->name('blearning.teacher.edit');
    Route::post('/blearning/teacher/delete/{id}', 'BlearningController@deleteTeacher')->name('blearning.teacher.delete');


    Route::match(['get', 'post'],'/blearning/subject/create', 'BlearningController@addSubject')->name('blearning.subject.create');
    Route::get('/blearning/subject/view', 'BlearningController@viewSubject')->name('blearning.subject.view');
    Route::match(['get', 'post'],'/blearning/subject/edit/{id}', 'BlearningController@editSubject')->name('blearning.subject.edit');
    Route::post('/blearning/subject/delete/{id}', 'BlearningController@deleteSubject')->name('blearning.subject.delete');

    Route::match(['get', 'post'],'/matrix/user', 'MatrixController@addMatrix')->name('matrix.user.commission');
    Route::get('/matrix/user/view', 'MatrixController@viewMatrix')->name('matrix.user.view');
    Route::get('/matrix/user/view/position', 'MatrixController@viewMatrixPosition')->name('matrix.user.view.position');
    Route::get('/matrix/user/line', 'MatrixController@viewMatrixLine')->name('matrix.user.line');
    Route::get('/matrix/user/search', 'MatrixController@searchMatrix')->name('matrix.user.search');
    Route::get('/matrix/user/up/view/{account}', 'MatrixController@upViewMatrix')->name('matrix.user.up.view');
    Route::get('/matrix/user/delete/user/{id}', 'MatrixController@deleteDefaultMatrix')->name('matrix.user.delete.user');
    Route::get('/matrix/user/view/user/{id}', 'MatrixController@viewDefaultMatrix')->name('matrix.user.view.user');
    Route::get('/matrix/user/history/{id}', 'MatrixController@viewMatrixHistory')->name('matrix.user.history');
    Route::get('/matrix/user/designation/history/{id}', 'MatrixController@viewMatrixDesignationHistory')->name('matrix.user.designation.history');
    Route::get('/matrix/user/designation/salary/{id}/{type}', 'MatrixController@viewMatrixDesignationSalary')->name('matrix.user.designation.salary');




    Route::match(['get', 'post'],'/quizze/add-user', 'QuizzeController@addQuiuzzeUser')->name('quizze.add.user');
    Route::match(['get', 'post'],'/quizze/edit_user/{id}', 'QuizzeController@editQuiuzzeUser')->name('quizze.edit.user');
    Route::get('/quizze/user/view', 'QuizzeController@viewQuizzeUser')->name('quizze.user.view');


    Route::get('/quizze/question/add-question', 'QuizzeController@addQuizzeQuestion')->name('quizze.question.add.question');
//    Route::match(['get', 'post'],'/quizze/edit_user/{id}', 'QuizzeController@editQuiuzzeUser')->name('quizze.edit.user');
    Route::get('/quizze/question/question', 'QuizzeController@viewQuizzeQuestion')->name('quizze.question.question');

    Route::post('/quizze/add_quizze/question/mcq', 'QuizzeController@mcq')->name('quizze.add.quizze.question.mcq');
    Route::post('/quizze/add_quizze/question/boolean', 'QuizzeController@boolean')->name('quizze.add.quizze.question.boolean');
    Route::post('/quizze/add_quizze/question/written', 'QuizzeController@written')->name('quizze.add.quizze.question.written');

    Route::match(['get', 'post'],'/quizze/question/add-exam', 'QuizzeController@addQuizzeExam')->name('quizze.question.add.exam');
    Route::get('/quizze/question/exam', 'QuizzeController@viewQuizzeExam')->name('quizze.question.exam');
    Route::match(['get', 'post'],'/quizze/edit/exam/{id}', 'QuizzeController@editQuizzeExam')->name('quizze.edit.exam');
    Route::post('/quizze/exam/delete/{id}', 'QuizzeController@deleteQuizzeExam')->name('quizze.exam.delete');

    Route::get('/quizze/question/exam/complain/report', 'QuizzeController@viewQuizzeComplain')->name('quizze.question.exam.complain.report');




    Route::match(['get', 'post'],'/quizze/exam/add/question/{id}', 'QuizzeController@addQuizzeExamQuestion')->name('quizze.exam.add.question');
    Route::match(['get', 'post'],'/quizze/exam/view/question/{id}', 'QuizzeController@viewQuizzeExamQuestion')->name('quizze.exam.view.question');

    Route::post('/quizze/add_quizze/exam/question/mcq', 'QuizzeController@mcqExam')->name('quizze.add.quizze.exam.question.mcq');
    Route::post('/quizze/add_quizze/exam/question/boolean', 'QuizzeController@booleanExam')->name('quizze.add.quizze.exam.question.boolean');
    Route::post('/quizze/add_quizze/exam/question/written', 'QuizzeController@writtenExam')->name('quizze.add.quizze.exam.question.written');
    Route::post('/quizze/quizze/exam/quizze/question/delete/{id}', 'QuizzeController@deleteExamQuestion')->name('quizze.exam.quizze.question.delete');


    //charity router here
    Route::match(['get', 'post'],'/charity/add-event', 'CharityController@addCharity')->name('charity.add.event');
    Route::get('/charity/view-event', 'CharityController@viewCharity')->name('charity.view.event');
    Route::match(['get', 'post'],'/charity/edit/event/{id}', 'CharityController@editCharity')->name('charity.edit.event');
    Route::post('/charity/delete/event/{id}', 'CharityController@deleteCharity')->name('charity.delete.event');
    Route::get('/charity/transaction/event/{id}', 'CharityController@transactionCharity')->name('charity.transaction.event');




    Route::match(['get', 'post'],'/boost-type/add-type', 'BoostTypeController@addBoostType')->name('boost.type.add.type');
    Route::get('/boost-type/view-type', 'BoostTypeController@viewBoostType')->name('boost.type.view.type');
    Route::match(['get', 'post'],'/boost-type/edit-type/{id}', 'BoostTypeController@editBoostType')->name('boost.type.edit.type');
    Route::post('/boost-type/delete-type/{id}', 'BoostTypeController@deleteBoostType')->name('boost.type.delete.type');
    Route::get('/boost-history/view-all-history', 'BoostTypeController@boostHistoryView')->name('boost.history.view.all.history');







});


Route::get('/mo-designation-comment-status-ok', 'Ecommerce\Web\MatrixController@moDesignationComment');

Route::group([
    "middleware" => ["auth:vendor", "role:vendor|administrator"],
    'namespace' => 'Ecommerce\Web',
], function () {
    Route::resource('subcategory','SubCategoryController');
    Route::get('/get/subcat/{id}', 'SubCategoryController@subcat')->name('subcat');
    Route::get('/get/size/{id}', 'SubCategoryController@size')->name('size');
    Route::get('/slider/details/{id}', 'SubCategoryController@size')->name('size');
    Route::get('/update-category-url', 'SubCategoryController@categoryUrl');
    Route::get('/update-sub-category-url', 'SubCategoryController@subCategoryUrl');

    Route::get('/update-brand-url', 'SubCategoryController@brandUrl');



});
Route::group([
    "middleware" => ["auth:vendor", "role:vendor|administrator"],
    'namespace' => 'Ecommerce\Web',
], function () {
    Route::get('shops/admin/pending','ShopController@shopPending')->name('shops.pending');
    Route::get('shops/admin/accepted','ShopController@shopAccepted')->name('shops.accepted');
    Route::get('shops/admin/all','ShopController@shopAll')->name('shops.all');

    Route::get('/update-shop-url','ShopController@updateShopUrl');

    Route::patch('shops/admin/{id}/accepted','ShopController@acceptShop')->name('shops.accepted.update');

    Route::resource('shops','ShopController');
});
Route::group([
    "middleware" => ["auth:vendor", "role:administrator"],
    'namespace' => 'Ecommerce\Web',
], function () {
    Route::resource('brands','BrandController');

});
Route::group([
    "middleware" => ["auth:vendor", "role:administrator"],
    'namespace' => 'Ecommerce\Web',
], function () {
    Route::resource('sliderDetails','SliderDetailsController');
    Route::get('/slider/details/{id}', 'SliderDetailsController@show');
    Route::get('/sliderDetails/delete/{id}', 'SliderDetailsController@destroy');
});




Route::group([
    "middleware" => ["auth:vendor"],
    'namespace' => 'Ecommerce\Web',
], function () {
    Route::get('users/orders/all', 'OrderController@allOrders')->name('orders.index')->middleware('role:vendor|administrator');
    Route::get('users/orders/all/datatables', 'OrderController@allOrdersDatatables')->name('orders.index.datatables')->middleware('role:vendor|administrator');

    Route::get('users/orders/pending', 'OrderController@pendingOrders')->name('orders.pending')->middleware('role:vendor|administrator');
    Route::get('users/orders/pending/datatables', 'OrderController@pendingOrdersDatatables')->name('orders.pending.datatables')->middleware('role:vendor|administrator');

    Route::get('users/orders/cancel', 'OrderController@cancelOrders')->name('orders.cancel')->middleware('role:vendor|administrator');
    Route::get('users/orders/cancel/datatables', 'OrderController@cancelOrdersDatatables')->name('orders.cancel.datatables')->middleware('role:vendor|administrator');

    Route::get('users/orders/complete', 'OrderController@completeOrders')->name('orders.complete')->middleware('role:vendor|administrator');
    Route::get('users/orders/complete/datatables', 'OrderController@completeOrdersDatatables')->name('orders.complete.datatables')->middleware('role:vendor|administrator');

    Route::get('users/orders/processing', 'OrderController@processingOrders')->name('orders.processing')->middleware('role:vendor|administrator');
    Route::get('users/orders/processing/datatables', 'OrderController@processingOrdersDatatables')->name('orders.processing.datatables')->middleware('role:vendor|administrator');

    Route::get('users/orders/shipped', 'OrderController@shippedOrders')->name('orders.shipped')->middleware('role:vendor|administrator');
    Route::get('users/orders/shipped/datatables', 'OrderController@shippedOrdersDatatables')->name('orders.shipped.datatables')->middleware('role:vendor|administrator');



    Route::get('vendor/orders/admin', 'OrderController@allAdminOrders')->name('vendor.orders.admin')->middleware('role:administrator');
    Route::get('vendor/orders/admin/datatables', 'OrderController@allAdminOrdersDatatables')->name('vendor.orders.admin.datatables')->middleware('role:administrator');

    Route::get('vendor/orders/admin/pending', 'OrderController@pendingOrders')->name('vendor.orders.admin.pending')->middleware('role:administrator');
    Route::get('vendor/orders/admin/cancel', 'OrderController@cancelOrders')->name('vendor.orders.admin.cancel')->middleware('role:administrator');
    Route::get('vendor/orders/admin/complete', 'OrderController@completeOrders')->name('vendor.orders.admin.complete-list')->middleware('role:administrator');
    Route::get('vendor/orders/admin/processing', 'OrderController@processingOrders')->name('vendor.orders.admin.processing')->middleware('role:administrator');
    Route::get('vendor/orders/admin/shipped', 'OrderController@shippedOrders')->name('vendor.orders.admin.shipped')->middleware('role:administrator');






    Route::patch('vendor/orders/admin/change_status/{order_id}', 'OrderController@changeStatus')->name('vendor.orders.admin.change-status');
    Route::post('vendor/orders/admin/order_complete/{order_id}', 'OrderController@orderComplete')->name('vendor.orders.admin.complete');


//    Route::get('users/delivery', 'OrderController@delivery')->name('orders.delivery')->middleware('role:vendor|administrator');

    Route::get('users/orders/product/{id}', 'OrderController@orderToProduct')->name('orders.orderToProduct');
    Route::get('orders/show/{id}', 'OrderController@OrderDetails')->name('orders.show');

    Route::get('vendor/orders/admin/show/{id}', 'OrderController@adminOrderDetails')->name('orders.admin.show')->middleware('role:administrator');

    Route::get('/order/weekly/report', 'OrderController@weeklyReport')->name('order.weekly.report')->middleware('role:administrator');
    Route::get('/order/date_range/report', 'OrderController@dateRangeRport')->name('order.date_range.report')->middleware('role:administrator');
});


















Route::group([
    'namespace' => 'Ecommerce\Web',
    "middleware" => ["auth:vendor", "role:administrator"],
], function () {
    Route::resource('slider','SliderController');
});
Route::group([
    'namespace' => 'Ecommerce\Web',
    "middleware" => "auth:vendor",
], function () {
    Route::resource('size','SizeController');
});
Route::group([
    "middleware" => ["auth:vendor", "role:administrator"],
    'namespace' => 'Ecommerce\Web',
], function () {
    Route::get('hotproducts/', 'HotProductsController@index')->name('hotproducts.index');
    Route::get('hotproducts/show', 'HotProductsController@show')->name('hotproducts.show');
    Route::get('/hotproducts/coin/{id}/{quantity}', 'HotProductsController@addCoin');

});
