<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LpbjController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/auth')->group(function () {
    // Auth routes will go here
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'Login']);
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
});

Route::prefix('/lpbjs')->group(function () {
    // LPBJ routes will go here
    Route::get('/', [LpbjController::class, 'index']);
    Route::post('/', [LpbjController::class, 'store']);
});
