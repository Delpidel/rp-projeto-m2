<?php

use App\Http\Controllers\SupplementController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // rotas privadas
    Route::post('stores', [StoreController::class, 'store']);
    Route::get('stores', [StoreController::class, 'index']);
    Route::post('supplements', [SupplementController::class, 'store']);
    Route::get('supplements', [SupplementController::class, 'index']);
    Route::get('/supplements/{id}', [SupplementController::class, 'show']);
});
// rotas públicas
Route::post('users', [UserController::class, 'store']);
Route::post('login', [AuthController::class, 'store']);

