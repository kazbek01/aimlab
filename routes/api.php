<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/******* Admin page *******/
Route::group([
    'namespace' => 'API',
], function() {

    Route::group([
        'prefix' => 'auth',
    ], function() {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
    });

    Route::group([
        'prefix' => 'profile',
    ], function() {
        Route::get('/', 'ProfileController@getProfile');
        Route::post('/', 'ProfileController@editProfile');
    });

    Route::group([
        'prefix' => 'statistic'
    ], function() {
        Route::get('region', 'StatisticController@region');
        Route::get('school', 'StatisticController@school');
    });

    Route::group([
        'prefix' => 'answer',
    ], function() {
        Route::get('test', 'AnswerController@getTestList');
    });

    Route::get('subscription', 'SubscriptionController@getSubscriptionList');
    Route::get('client', 'ClientController@getClientList');
    Route::get('operation', 'OperationController@getOperationList');

});
