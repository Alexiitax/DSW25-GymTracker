<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\RoutineController;
use Illuminate\Support\Facades\Route;

// Public routes

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/exercises', [CategoryController::class, 'getExercises']);

Route::get('/exercises', [ExerciseController::class, 'index']);
Route::get('/exercises/{id}', [ExerciseController::class, 'show']);

Route::get('/routines', [RoutineController::class, 'index_public']);
Route::get('/routines/{id}', [RoutineController::class, 'show']);
Route::get('/routines/{id}/exercises', [RoutineController::class, 'exercises_list']);

// Protected routes

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Category CRUD (protected)
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // My-routines (user's subscribed routines)
    Route::get('/my-routines', [RoutineController::class, 'index']);
    Route::post('/my-routines', [RoutineController::class, 'subscribe']); // Subscribe to existing routine
    Route::delete('/my-routines/{id}', [RoutineController::class, 'destroy']);
    
    // Routine CRUD (protected)
    Route::post('/routines', [RoutineController::class, 'store']); // Create new routine
    Route::put('/routines/{id}', [RoutineController::class, 'update']);
    Route::delete('/routines/{id}', [RoutineController::class, 'deleteFullRoutine']);

    // Routine exercise management (protected)
    Route::post('/routines/{id}/exercises', [RoutineController::class, 'addExercise']);
    Route::delete('/routines/{id}/exercises/{e_id}', [RoutineController::class, 'removeExercise']);
});
