<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Models\User;
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

// Route::post('register', 'UserController@store'); 
Route::controller(UserController::class)->group(function () {
  Route::post('register', 'store')->name('users.store');
  Route::post('login', 'login')->name('users.login');
  Route::post('logout', 'logout')->name('users.logout');

});
// Route::post('register', [UserController::class, 'store'])->name('users.store');
// Route::post('login', [UserController::class, 'login'])->name('users.login');
// Route::post('logout', [UserController::class, 'logout'])->name('users.logout');