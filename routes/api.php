<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Account\AccountController;
use App\Http\Controllers\Api\Auth\UserController;

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
    
    Route::middleware(['treblle'])->group(function(){
        
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

    Route::middleware(['treblle', 'jwt.verify'])->group(function () {
        
        Route::group(['namespace' => 'Api\Account'], function(){
            Route::get('account', [AccountController::class, 'index']);
            Route::post('account', [AccountController::class, 'create']);
            Route::patch('account/{id}', [AccountController::class, 'create']);
            Route::delete('account/{id}', [AccountController::class, 'destroy']);
        });

    });
});
