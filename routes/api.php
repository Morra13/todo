<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\AccessController;

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

Route::post('/create',                          [TodoController::class, 'create']           )->name(TodoController::ROUTE_CREATE);
Route::post('/update',                          [TodoController::class, 'update']           )->name(TodoController::ROUTE_UPDATE);
Route::get('/delete/{id}',                      [TodoController::class, 'delete']           )->name(TodoController::ROUTE_DELETE);
Route::post('/addAccess',                       [AccessController::class, 'addAccess']      )->name(AccessController::ROUTE_ADD_ACCESS);
Route::post('/deleteAccess/{userId}/{todoId}',   [AccessController::class, 'deleteAccess']   )->name(AccessController::ROUTE_DELETE_ACCESS);
