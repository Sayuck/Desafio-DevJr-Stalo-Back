<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**    
 * Auth routes
 */

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');

/**
 * User routes
 */
Route::get('/users/{user}', [UserController::class, 'show'])->middleware('auth:sanctum')->name('users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth:sanctum')->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth:sanctum')->name('users.destroy');


/**
 * Task routes
 */


Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth:sanctum')->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth:sanctum')->name('tasks.store');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->middleware('auth:sanctum')->name('tasks.show');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->middleware('auth:sanctum')->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->middleware('auth:sanctum')->name('tasks.destroy');
