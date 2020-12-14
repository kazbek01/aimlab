<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

/******* Admin page *******/
Route::group([
    'namespace' => 'Admin',
    'middleware' => 'web'
], function() {
    Route::any('auth/login', 'AuthController@login');
});

/******* Admin page *******/
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'web'
], function() {

    Route::any('/login', 'AuthController@login');
    Route::get('/logout', 'AuthController@logout');
    Route::any('password', 'UsersController@password');

    Route::post('category/is_show', 'CategoryController@changeIsShow');
    Route::resource('category', 'CategoryController');

    Route::post('banner/is_show', 'BannerController@changeIsShow');
    Route::resource('banner', 'BannerController');

    Route::post('project/is_show', 'ProjectController@changeIsShow');
    Route::resource('project', 'ProjectController');

    Route::post('service/is_show', 'ServiceController@changeIsShow');
    Route::resource('service', 'ServiceController');

    Route::post('news/is_show', 'NewsController@changeIsShow');
    Route::resource('news', 'NewsController');

    Route::post('products/is_show', 'ProductsController@changeIsShow');

    Route::resource('products', 'ProductsController');


    Route::post('order/is_show', 'OrderController@changeIsShow');
    Route::resource('order', 'OrderController');

    Route::resource('about', 'AboutController');

    Route::resource('contact', 'ContactController');

    Route::resource('partner', 'PartnerController');

    Route::resource('order_info', 'OrderInfoController');

    Route::resource('delivery', 'DeliveryController');

    Route::resource('payment', 'PaymentController');
});



/******* Main page *******/
Route::group([
    'middleware' => 'web',
    'namespace' => 'Index',
], function() {
    Route::get('/', 'IndexController@index');

    Route::get('project', 'ProjectController@index');
    Route::get('project/{id}', 'ProjectController@show');

    Route::get('service', 'ServiceController@index');
    Route::get('service/{id}', 'ServiceController@show');

    Route::get('news', 'NewsController@index');
    Route::get('news/{id}', 'NewsController@show');

    Route::get('contact', 'OrderController@index');
    Route::post('order', 'OrderController@addOrder')->name('order');

    Route::get('category/{id}', 'CategoryController@getProductsByCategory');
    Route::get('offers', 'ProductsController@getOffers');
    Route::get('products/{id}', 'ProductsController@show');

    Route::get('cron/cache', 'CronController@clearCache');

    Route::get('search', 'IndexController@search');

    Route::get('about', 'AboutController@show');

    Route::get('order_info', 'OrderInfoController@show');

    Route::get('delivery', 'DeliveryController@show');

    Route::get('payment', 'PaymentController@show');

    Route::get('partner', 'PartnerController@index');
    Route::get('partner/{id}', 'PartnerController@show');
});

Route::post('image/upload', 'ImageController@uploadImage');
Route::post('image/upload/file', 'ImageController@uploadFile');
Route::get('media/{file_name}', 'ImageController@getImage')->where('file_name', '.*');
Route::get('file/{file_name}', 'ImageController@showFile')->where('file_name','.*');


//Route::get('/', 'Admin\AuthController@login');
//Route::get('/', 'Admin\AuthController@login');
//    Route::get('products/image', 'ProductsController@getImageList');


