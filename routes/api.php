<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['throttle:60,1']], function () {
    Route::group(['namespace' => 'Api'], function () {
        Route::get('products', 'ProductController@list');
        Route::post('products', 'ProductController@create');
        Route::put('products/{id}', 'ProductController@update');
        Route::get('products/{id}', 'ProductController@show');
        Route::delete('products/{id}', 'ProductController@delete');
    }); 
});

