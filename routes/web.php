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

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\FurnitureController::class, 'home']);

Route::group(['prefix' => '/admin', 'middleware' => ['adminValidate', 'auth']], function(){
    Route::group(['prefix' => 'furniture'], function(){
        Route::get('/add', [App\Http\Controllers\FurnitureController::class, 'add']);
        Route::post('/insert', [App\Http\Controllers\FurnitureController::class, 'insert']);
    });
});

Route::group(['prefix' => '/user', 'middleware' => ['userValidate', 'auth']], function(){

});
