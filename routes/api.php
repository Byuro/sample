<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// User registration
Route::post('register', [UserController::class, 'register']);

// User login
Route::post('login', [UserController::class, 'login']);

// Retrieve authenticated user's data
Route::middleware('auth:sanctum')->get('me', [UserController::class, 'me']);

// List all users (authenticated users only)
Route::middleware('auth:sanctum')->get('users', [UserController::class, 'index']);

// ✅ Custom route for getting all students through the API (returns JSON)
Route::get('students', [StudentController::class, 'apiIndex']);

// ✅ Route for creating a new student through the API (POST method)
Route::post('students', [StudentController::class, 'store']);
