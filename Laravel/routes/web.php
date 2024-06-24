<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/laravel', [UserController::class,'user'])->name('user.index');

Route::get('/laravel/create', [UserController::class, 'toggleAddFormVisibility'])->name('toggleAddFormVisibility');
Route::get('/laravel/show/{id}', [UserController::class, 'toggleInfoFormVisibility'])->name('toggleInfoFormVisibility');
Route::get('/laravel/edit/{id}', [UserController::class, 'toggleEditFormVisibility'])->name('toggleEditFormVisibility');