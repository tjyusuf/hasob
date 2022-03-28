<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetController;


Route::group([
    'middleware' => 'api',
], function () {

    Route::prefix('auth')->group(function(){
        Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });

    Route::prefix('assets')->group(function(){
        Route::get('/', [AssetController::class, 'index'])->name('assets');
        Route::post('/', [AssetController::class, 'store'])->name('assets.create');
        Route::get('/{asset}', [AssetController::class, 'show'])->name('assets.show');
        Route::put('/{asset}', [AssetController::class, 'update'])->name('assets.update');
        Route::delete('/{asset}', [AssetController::class, 'destroy'])->name('assets.delete');

    });
});

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::post('/refresh', [AuthController::class, 'refresh']);
//     Route::get('/user-profile', [AuthController::class, 'userProfile']);    
// });