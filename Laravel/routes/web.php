<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', [UserController::class, 'getAllUsers']);
Route::get('/usuarios/{id}', [UserController::class, 'getUser']);
Route::post('/usuarios', [UserController::class, 'createUser']);
Route::put('/usuarios/{id}', [UserController::class, 'updateUser']);
Route::delete('/usuarios/{id}/delete/logical', [UserController::class, 'deleteUserLogical']);
Route::delete('/usuarios/{id}/delete/physical', [UserController::class, 'deleteUserPhysical']);