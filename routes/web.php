<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/guest',        [PublicController::class, 'guest']      )->name(PublicController::ROUTE_GUEST);
Route::get('/auth',         [PublicController::class, 'auth']       )->name(PublicController::ROUTE_AUTH);
Route::get('/register',     [PublicController::class, 'register']   )->name(PublicController::ROUTE_REGISTER);
Route::post('/auth',        [AuthController::class, 'auth']         )->name(AuthController::ROUTE_AUTH);
Route::post('/register',    [AuthController::class, 'register']     )->name(AuthController::ROUTE_REGISTER);

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('/',             [PublicController::class, 'index']  )->name(PublicController::ROUTE_MAIN);
        Route::get('/logout',       [AuthController::class, 'logout']   )->name(AuthController::ROUTE_LOGOUT);
        Route::get('/createTodo',   [TodoController::class, 'create']   )->name(TodoController::ROUTE_CREATE);
    }
);
