<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AssignmentController;


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

    Route::prefix('vendors')->group(function(){
        Route::get('/', [VendorController::class, 'index'])->name('vendors');
        Route::post('/', [VendorController::class, 'store'])->name('vendors.create');
        Route::get('/{vendor}', [VendorController::class, 'show'])->name('vendors.show');
        Route::put('/{vendor}', [VendorController::class, 'update'])->name('vendors.update');
        Route::delete('/{vendor}', [VendorController::class, 'destroy'])->name('vendors.delete');
    });

    Route::prefix('assignments')->group(function(){
        Route::get('/', [AssignmentController::class, 'index'])->name('assignments');
        Route::post('/', [AssignmentController::class, 'store'])->name('assignments.create');
        Route::get('/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
        Route::put('/{assignment}', [AssignmentController::class, 'update'])->name('assignments.update');
        Route::delete('/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.delete');
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