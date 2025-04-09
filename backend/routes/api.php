<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Получить все задачи
Route::get('/tasks', [TaskController::class, 'index']);

// Создать новую задачу
Route::post('/tasks', [TaskController::class, 'store']);

// Получить задачу по ID
Route::get('/tasks/{id}', [TaskController::class, 'show']);

// Обновить задачу
Route::put('/tasks/{id}', [TaskController::class, 'update']);

// Удалить задачу
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

Route::post('/tasks/seed', [TaskController::class, 'seedTasks']);
