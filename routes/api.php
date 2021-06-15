<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([ 'prefix' => 'v1', 'middleware' => 'api'], function(){

    /* User register */
    Route::post('user/register', 'App\Http\Controllers\Api\v1\AuthController@register');

    /* User login */
    Route::post('user/login', 'App\Http\Controllers\Api\v1\AuthController@login');

    /* Refresh user's token */
    Route::get('user/refresh', 'App\Http\Controllers\Api\v1\AuthController@token');

    /* User logout from system */
    Route::get('user/logout', 'App\Http\Controllers\Api\v1\AuthController@logout');

    // Get auth user
    Route::get('token/validate', 'App\Http\Controllers\Api\v1\AuthController@auth');

    //Admin actions
    Route::group([ 'prefix' => 'admin', 'middleware' => 'isadmin' ], function(){
        /* Get all companies details*/
        Route::get('companies', 'App\Http\Controllers\Api\v1\CompanyController@getAll');
        /* Add a company */
        Route::post('company/create', 'App\Http\Controllers\Api\v1\CompanyController@create');
        /* Update a company */
        Route::put('company/update', 'App\Http\Controllers\Api\v1\CompanyController@update');
        /* Get company detail by id */
        Route::get('company/{companyId}', 'App\Http\Controllers\Api\v1\CompanyController@getById');
        /* delete company by id */
        Route::delete('company/delete/{companyId}', 'App\Http\Controllers\Api\v1\CompanyController@delete');

        /* Get all series details*/
        Route::get('series', 'App\Http\Controllers\Api\v1\SeriesInvoiceController@getAll');
        /* Add a serie */
        Route::post('serie/create', 'App\Http\Controllers\Api\v1\SeriesInvoiceController@create');
        /* Update a serie */
        Route::put('serie/update', 'App\Http\Controllers\Api\v1\SeriesInvoiceController@update');
        /* Get serie detail by id */
        Route::get('serie/{serieId}', 'App\Http\Controllers\Api\v1\SeriesInvoiceController@getById');
        /* delete serie by id */
        Route::delete('serie/delete/{serieId}', 'App\Http\Controllers\Api\v1\SeriesInvoiceController@delete');

        /* Get all sale-conditions details*/
        Route::get('sale-conditions', 'App\Http\Controllers\Api\v1\SaleConditionController@getAll');
        /* Add a sale-condition */
        Route::post('sale-condition/create', 'App\Http\Controllers\Api\v1\SaleConditionController@create');
        /* Update a sale-condition */
        Route::put('sale-condition/update', 'App\Http\Controllers\Api\v1\SaleConditionController@update');
        /* Get sale-condition detail by id */
        Route::get('sale-condition/{conditionId}', 'App\Http\Controllers\Api\v1\SaleConditionController@getById');
        /* delete sale-condition by id */
        Route::delete('sale-condition/delete/{conditionId}', 'App\Http\Controllers\Api\v1\SaleConditionController@delete');

        /* Get all payment-methods details*/
        Route::get('payment-methods', 'App\Http\Controllers\Api\v1\PaymentMethodController@getAll');
        /* Add a payment-method */
        Route::post('payment-method/create', 'App\Http\Controllers\Api\v1\PaymentMethodController@create');
        /* Update a payment-method */
        Route::put('payment-method/update', 'App\Http\Controllers\Api\v1\PaymentMethodController@update');
        /* Get payment-method detail by id */
        Route::get('payment-method/{paymentMethodId}', 'App\Http\Controllers\Api\v1\PaymentMethodController@getById');
        /* delete payment-method by id */
        Route::delete('payment-method/delete/{paymentMethodId}', 'App\Http\Controllers\Api\v1\PaymentMethodController@delete');

        /* Get all banks details*/
        Route::get('banks', 'App\Http\Controllers\Api\v1\BankController@getAll');
        /* Add a bank */
        Route::post('bank/create', 'App\Http\Controllers\Api\v1\BankController@create');
        /* Update a bank */
        Route::put('bank/update', 'App\Http\Controllers\Api\v1\BankController@update');
        /* Get bank detail by id */
        Route::get('bank/{bankId}', 'App\Http\Controllers\Api\v1\BankController@getById');
        /* delete bank by id */
        Route::delete('bank/delete/{bankId}', 'App\Http\Controllers\Api\v1\BankController@delete');
    });

});
