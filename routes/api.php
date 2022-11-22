<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

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



Route::group([
    'prefix' => 'auth'
], function () {

    Route::controller(AuthController::class)->group(function(){
        Route::post('login', 'login');
        Route::get('logout', 'logout')->middleware('auth:api');
        Route::get('me', 'me')->middleware('auth:api');
    });

});

Route::group([
    'middleware' => ['auth:api' , 'roleAdmin']
  ], function() {

    Route::group([
        'prefix' => 'auth'
    ], function () {
    
        Route::controller(AuthController::class)->group(function(){
            
            Route::post('signup', 'signup');
        });
    
    });

    Route::group([
        'prefix' => 'users'
    ], function () {
    
        Route::controller(UserController::class)->group(function(){
            
            Route::get('find-all', 'findAll');
            Route::post('create', 'create');
            Route::get('{id}', 'edit');
            Route::put('{id}', 'update');
            Route::put('{id}/status', 'updateStatus');
        });
    
    });
      
});