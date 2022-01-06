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
Route::get('/furniture/view', [App\Http\Controllers\FurnitureController::class, 'view']);
Route::post('/furniture/search', [App\Http\Controllers\FurnitureController::class, 'view']);
Route::get('/furniture/detail/{id}', [App\Http\Controllers\FurnitureController::class, 'detail']);

Route::middleware('auth')->group(function(){
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'view']);
    Route::get('/profile/update', [App\Http\Controllers\ProfileController::class, 'edit']);
    Route::patch('/profile/edit', [App\Http\Controllers\ProfileController::class, 'update']);
});

Route::group(['prefix' => '/admin', 'middleware' => ['adminValidate', 'auth']], function(){
    Route::group(['prefix' => 'furniture'], function(){
        Route::get('/add', [App\Http\Controllers\FurnitureController::class, 'add']);
        Route::post('/insert', [App\Http\Controllers\FurnitureController::class, 'insert']);
        Route::get('/edit/{id}', [App\Http\Controllers\FurnitureController::class, 'edit']);
        Route::patch('/update/{id}', [App\Http\Controllers\FurnitureController::class, 'update']);
        Route::delete('/delete/{id}', [App\Http\Controllers\FurnitureController::class, 'delete']);
    });
});

Route::group(['prefix' => '/user', 'middleware' => ['userValidate', 'auth']], function(){
    Route::group(['prefix' => 'cart'], function(){
        Route::post('/add/{id}', [App\Http\Controllers\CartController::class, 'addCart']);
        Route::get('/', [App\Http\Controllers\CartController::class, 'view']);
        Route::post('/qty/add/{id}', [App\Http\Controllers\CartController::class, 'addQty']);
        Route::post('/qty/reduce/{id}', [App\Http\Controllers\CartController::class, 'reduceQty']);
    });
});
