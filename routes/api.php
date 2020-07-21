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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources(['user'=>'API\UserController']);
Route::apiResources(['child_transaction'=>'API\ChildTransactionController']);
Route::apiResources(['master_transaction'=>'API\MasterTransactionController']);

Route::get('finduser','API\UserController@search');
Route::get('chart_data','API\UserController@chart_data');
Route::get('get_user_name','API\UserController@get_user_name');
Route::get('get_number','API\UserController@get_number');
Route::get('get_product','API\ProductController@get_product');

