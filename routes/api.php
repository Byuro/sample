<?php
use App\Http\Controllers\UserController;

// User registration
Route::post('register', [UserController::class, 'register']);

// User login
Route::post('/login', [UserController::class, 'login']);


// Retrieve authenticated user's data
Route::middleware('auth:sanctum')->get('me', [UserController::class, 'me']);

// List all users (authenticated users only)
Route::middleware('auth:sanctum')->get('users', [UserController::class, 'index']);
