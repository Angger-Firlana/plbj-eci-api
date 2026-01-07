<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LpbjController;
use App\Http\Controllers\EciJobController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\VendorController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/auth')->group(function () {
    // Auth routes will go here
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'Login']);
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
});


Route::prefix('/departments')->group(function () {
    // Department routes will go here
    Route::get('/', [\App\Http\Controllers\DepartmentController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\DepartmentController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\DepartmentController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\DepartmentController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\DepartmentController::class, 'destroy']);
});

Route::prefix('/stores')->group(function () {
    // Store routes will go here
    Route::get('/', [\App\Http\Controllers\StoreController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\StoreController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\StoreController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\StoreController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\StoreController::class, 'destroy']);
});

Route::prefix('/lpbjs')->group(function () {
    // LPBJ routes will go here
    Route::get('/', [LpbjController::class, 'index']);
    Route::post('/', [LpbjController::class, 'store']);
    Route::get('/{id}', [LpbjController::class, 'show']);
    Route::put('/{id}', [LpbjController::class, 'update']);
    Route::delete('/{id}', [LpbjController::class, 'destroy']);
});

Route::prefix('/jobs')->group(function (){
    Route::get('/', [EciJobController::class, 'index']);
    Route::post('/', [EciJobController::class, 'store']);
    Route::get('/{id}', [EciJobController::class, 'show']);
    Route::put('/{id}', [EciJobController::class, 'update']);
    Route::delete('/{id}', [EciJobController::class, 'destroy']);
});

Route::prefix('/positions')->group(function (){
    Route::get('/', [\App\Http\Controllers\PositionController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\PositionController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\PositionController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\PositionController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\PositionController::class, 'destroy']);
});

Route::prefix('/quotations')->group(function (){
    Route::get('/', [\App\Http\Controllers\QuotationController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\QuotationController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\QuotationController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\QuotationController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\QuotationController::class, 'destroy']);
});

Route::prefix('/vendors')->group(function (){
    Route::get('/', [VendorController::class, 'index']);
    Route::post('/',[VendorController::class, 'store']);
    Route::put('/{id}', [VendorController::class, 'update']);
    Route::get('/{id}',  [VendorController::class, 'show']);
    Route::delete('/{id}', [VendorController::class, 'destroy']);
});