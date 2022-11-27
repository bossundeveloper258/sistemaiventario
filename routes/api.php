<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\SedeController;
use App\Http\Controllers\Api\ParameterController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\CostCenterController;
use App\Http\Controllers\Api\EmployeeController;
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
    'middleware' => ['auth:api']
  ], function() {

    Route::controller(ParameterController::class)->group(function(){
        Route::get('parameters/search', 'search');
    });

    Route::group([
        'prefix' => 'employees'
    ], function () {
    
        Route::controller(EmployeeController::class)->group(function(){
            
            Route::get('find-all', 'findAll');
            Route::get('search', 'search');
            Route::post('create', 'create');
            Route::get('{id}', 'edit');
            Route::put('{id}', 'update');
        });
    });

    Route::group([
        'prefix' => 'costcenters'
    ], function () {
    
        Route::controller(CostCenterController::class)->group(function(){
            
            Route::get('find-all', 'findAll');
        });
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

    /*=====================================================================================*/
    /*=============================== USERS     ==========================================*/
    /*=====================================================================================*/

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

    /*=====================================================================================*/
    /*=============================== BUSINESS     ==========================================*/
    /*=====================================================================================*/

    Route::group([
        'prefix' => 'business'
    ], function () {
    
        Route::controller(BusinessController::class)->group(function(){
            
            Route::get('find-all', 'findAll');
            Route::post('create', 'create');
            Route::get('{id}', 'edit');
            Route::put('{id}', 'update');

        });
    
    });

    /*=====================================================================================*/
    /*=============================== SEDES     ==========================================*/
    /*=====================================================================================*/
    Route::group([
        'prefix' => 'sedes'
    ], function () {
    
        Route::controller(SedeController::class)->group(function(){
            
            Route::get('find-all', 'findAll');
            Route::get('search', 'search');
            Route::post('create', 'create');
            Route::get('{id}', 'edit');
            Route::put('{id}', 'update');
        });
    });

    /*=====================================================================================*/
    /*=============================== AREAS     ==========================================*/
    /*=====================================================================================*/
    Route::group([
        'prefix' => 'areas'
    ], function () {
    
        Route::controller(AreaController::class)->group(function(){
            
            Route::get('find-all', 'findAll');
            Route::get('search', 'search');
            Route::post('create', 'create');
            Route::get('{id}', 'edit');
            Route::put('{id}', 'update');
        });
    });

    /*=====================================================================================*/
    /*=============================== CENTRO DE COSTO     ==========================================*/
    /*=====================================================================================*/
    Route::group([
        'prefix' => 'costcenters'
    ], function () {
    
        Route::controller(CostCenterController::class)->group(function(){
            
            // Route::get('find-all', 'findAll');
            Route::get('search', 'search');
            Route::post('create', 'create');
            Route::get('{id}', 'edit');
            Route::put('{id}', 'update');
        });
    });

    /*=====================================================================================*/
    /*=============================== CENTRO DE COSTO     ==========================================*/
    /*=====================================================================================*/
    
      
});