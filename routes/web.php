<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::middleware(['middleware' => 'web'])->group(
    function () {
        //OAuth authorization
        Route::get('/auth/redirect', 'UserController@redirectToProvider');
        Route::get('/auth/callback', 'UserController@handleProviderCallback');
    }
);
