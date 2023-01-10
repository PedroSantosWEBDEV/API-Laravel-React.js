<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TasksController;
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
Route::prefix('v1')->group(function () {

    Route::apiResources(['tasklist' => 'TaskListController',]);

    Route::post('completedTaskList', [TaskListController::class, 'completedTaskList'])->name('tasklist.completedTaskList');
    Route::post('logout', [UserController::class, 'logout'])->name('users.logout')->middleware(JwtMiddleware::class);

});
