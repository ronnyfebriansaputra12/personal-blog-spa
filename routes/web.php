<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\GroupMenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/view-kategori', [KategoriController::class, 'viewKategori']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

Route::get('/kategori-json', [Controller::class, 'kategoriJson']);

Route::get('/view-post', [PostController::class, 'viewPost']);
Route::get('/post', [PostController::class, 'index']);
Route::post('/post', [PostController::class, 'store']);
Route::get('/post/{id}/edit', [PostController::class, 'edit']);
Route::put('/post/{id}', [PostController::class, 'update']);
Route::delete('/post/{id}', [PostController::class, 'destroy']);

Route::get('/view-user', [UserController::class, 'viewUser']);
Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}/edit', [UserController::class, 'edit']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::get('/view-group-menu', [GroupMenuController::class, 'viewGroupMenu']);
Route::get('/group-menu', [GroupMenuController::class, 'index']);
Route::post('/group-menu', [GroupMenuController::class, 'store']);
Route::get('/group-menu/{id}/edit', [GroupMenuController::class, 'edit']);
Route::put('/group-menu/{id}', [GroupMenuController::class, 'update']);
Route::delete('/group-menu/{id}', [GroupMenuController::class, 'destroy']);

Route::get('/view-menu', [MenuController::class, 'viewMenu']);
Route::get('/menu', [MenuController::class, 'index']);
Route::post('/menu', [MenuController::class, 'store']);
Route::get('/menu/{id}/edit', [MenuController::class, 'edit']);
Route::put('/menu/{id}', [MenuController::class, 'update']);
Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

