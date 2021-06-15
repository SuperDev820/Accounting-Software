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
    });

});
