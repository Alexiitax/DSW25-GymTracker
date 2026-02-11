<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExerciseController;

// Ahora tengo en cuenta que los públicos van fuera del middleware y las token van dentro

// Autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Categorías
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/exercises', [CategoryController::class, 'exercises']);

// Ejercicios
Route::get('/exercises', [ExerciseController::class, 'index']);
Route::get('/exercises/{id}', [ExerciseController::class, 'show']);

// Rutinas (General / Públicas)
Route::get('/routines', [RoutineController::class, 'index_public']);
Route::get('/routines/{id}', [RoutineController::class, 'show']);
Route::get('/routines/{id}/exercises', [RoutineController::class, 'exercises_list']);

Route::middleware('auth:sanctum')->group(function () {
    
    // el usuario y la sesión
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Gestión de Categorías (solo con Token)
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // Mis Rutinas (personalizadas del usuario)
    Route::get('/my-routines', [RoutineController::class, 'index']); // GET /my-routines
    Route::post('/my-routines', [RoutineController::class, 'store']); // POST /my-routines (Suscribir/Crear)
    Route::delete('/my-routines/{id}', [RoutineController::class, 'destroy']); // DELETE /my-routines/{id}

    // Rutas para Ejercicios 
    Route::post('/exercises', [ExerciseController::class, 'store']);
    Route::put('/exercises/{id}', [ExerciseController::class, 'update']);
    Route::put('/exercises/{id}', [ExerciseController::class, 'destroy']);

    // Rutas para Rutinas
    Route::post('/routines', [RoutineController::class, 'store']);
    Route::post('/routines/{id}', [RoutineController::class, 'update']);
    Route::post('/routines/{id}', [RoutineController::class, 'destroy']);

    // Relación de ejercicios con rutinas.
    Route::post('/routines/{id}/exercises', [RoutineController::class, 'addExercise']);
    Route::post('/routines/{id}/exercises/{e_id}', [RoutineController::class, 'removeExercise']);

});