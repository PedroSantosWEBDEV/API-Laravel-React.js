<?php

use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('register', [UserController::class, 'store'])->name('users.store');
Route::post('login', [UserController::class, 'login'])->name('users.login');
Route::post('completedTaskList', [TaskListController::class, 'completedTaskList'])->name('tasklist.completedTaskList');
Route::put('task/close/{id}', [TasksController::class, 'closeTask'])->name('tasks.closeTask');
Route::get('list/tasks/{id}', [TasksController::class, 'tasksByList'])->name('tasks.tasksByList');

Route::prefix('v1')->group(function () {
    // Route::apiResources([
    //     'tasklist' => 'TaskListController',
    //     'tasks' => 'TasksController',
    // ]);
    Route::post('logout', [UserController::class, 'logout'])->name('users.logout')->middleware(JwtMiddleware::class);

});
