<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Mail\ExpireAdMail;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(["prefix" => '/categories',  "controller" => CategoryController::class], function(){

    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::get('/edit/{id}', 'edit');
    Route::post('update/{id}', 'update');
    Route::post('/store', 'store');
    Route::delete('/deleteWithAds/{id}', 'destroyWithAds');
    Route::delete('/deleteMoveAds/{id}', 'destroyMoveAds');

});

Route::group(["prefix" => '/tags',  "controller" => TagController::class], function(){

    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::get('/edit/{id}', 'edit');
    Route::post('update/{id}', 'update');
    Route::post('/store', 'store');
    Route::delete('/delete/{id}', 'destroy');
});


Route::group(["prefix" => '/ads',  "controller" => AdController::class], function(){
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::get('/tag/{name}', 'AdFilterByTag');
});


Route::group(["prefix" => '/users',  "controller" => UserController::class], function(){
    Route::get('/', 'index');
    Route::get('/{id}', 'show');

});

Route::fallback(function () {
    return response()->json(['message' => 'Route | method action Not Found '], 404);
});
