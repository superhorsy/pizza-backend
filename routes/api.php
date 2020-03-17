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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/order/add', 'OrderController@placeOrder')->middleware('cors');
Route::post('/pizza/list', 'PizzaController@getList')->middleware('cors');
Route::post('/user/logout', 'UserController@logout')->middleware('auth');
Route::post('/user/info', 'UserController@getUserData')->middleware('auth');
Route::post('/user/getOrders', 'UserController@getOrders')->middleware('auth');
