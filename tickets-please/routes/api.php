<?php

use App\Http\Api\Controllers\AuthController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class], 'logout');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');