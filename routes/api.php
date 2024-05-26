<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;

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

Route::post('/create',      [TodoController::class, 'create']   )->name(TodoController::ROUTE_CREATE);
Route::get('/delete/{id}',  [TodoController::class, 'delete']   )->name(TodoController::ROUTE_DELETE);
