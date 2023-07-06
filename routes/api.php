<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Account\AccountController;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\Api\Vehicle\VehicleController;
use App\Http\Controllers\Api\Ride\RidePlacementController;
use App\Http\Controllers\Api\Ride\BookingController;
use App\Http\Controllers\Api\Liscence\LiscenceController;

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

Route::prefix('v1')->group(function () {
    
    Route::middleware(['treblle', 'cache.headers:public;max_age=60;etag'])->group(function(){
        
        Route::group(['namespace' => 'Api\Auth'], function () {
            Route::post('register', [UserController::class, 'register']);
            Route::post('new-user-password', [UserController::class, 'new_user_set_password']);
            Route::post('login', [UserController::class, 'login']);
            Route::post('logout', [UserController::class, 'logout']);
            Route::post('passcode-setup', [UserController::class, 'set_passcode']);
            Route::post('reset-passcode', [UserController::class, 'resset_passcode'])->middleware('jwt.verify');
            Route::post('balance-mode', [UserController::class, 'set_balance_mode'])->middleware('jwt.verify');
            Route::get('dashboard', [UserController::class, 'dashboard'])->middleware('jwt.verify');
        });
    });

    Route::middleware(['treblle', 'jwt.verify', 'cache.headers:public;max_age=60;etag'])->group(function () {
        
        Route::group(['namespace' => 'Api\Vehicle'], function(){
            Route::get('vehicle', [VehicleController::class, 'index']);
            Route::post('vehicle', [VehicleController::class, 'create']);
            Route::patch('vehicle/{id}', [VehicleController::class, 'create']);
            Route::delete('vehicle/{id}', [VehicleController::class, 'destroy']);
        });
        Route::group(['namespace' => 'Api\Liscence'], function(){
            Route::get('liscence', [LiscenceController::class, 'index']);
            Route::post('liscence', [LiscenceController::class, 'create']);
            Route::patch('liscence/{id}', [LiscenceController::class, 'create']);
            Route::delete('liscence/{id}', [LiscenceController::class, 'destroy']);
        });
        Route::group(['namespace' => 'Api\Account'], function(){
            Route::get('account', [AccountController::class, 'index']);
            Route::post('account', [AccountController::class, 'create']);
            Route::patch('account/{id}', [AccountController::class, 'update']);
            Route::delete('account/{id}', [AccountController::class, 'destroy']);
        });

        Route::group(['namespace' => 'Api\Ride'], function(){
            Route::get('placeride', [RidePlacementController::class, 'index']);
            Route::post('placeride', [RidePlacementController::class, 'store']);
            Route::patch('placeride/{id}', [RidePlacementController::class, 'update']);
            Route::delete('placeride/{id}', [RidePlacementController::class, 'destroy']);
        });
        Route::group(['namespace' => 'Api\Ride'], function(){
            Route::get('placeride', [BookingsController::class, 'index']);
            Route::post('placeride', [BookingsController::class, 'store']);
            // Route::patch('placeride/{id}', [BookingsController::class, 'update']);
            // Route::delete('placeride/{id}', [BookingsController::class, 'destroy']);
        });

    });
});
