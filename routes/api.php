<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Category_hewanController;
use App\Http\Controllers\Category_infoController;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//postingan
Route::get('/post/get/{post}', [PostinganController::class, 'showPost']);
Route::post('/post/create/', [PostinganController::class, 'createPost']);
Route::post('/post/update/{post}', [PostinganController::class, 'updatePost']);
Route::delete('/post/delete/{post}', [PostinganController::class, 'deletePost']);
Route::get("search/{description}", [PostinganController::class, 'search']);
Route::get("filter/{kategori}", [PostinganController::class, 'filter']);

// Route::get("kategori/{kategori}", [PostinganController::class, 'filterhewan']);
//filter
// Route::get('/list',[PostinganController::class, 'list'])->middleware('
// auth:sanctum');

//Kategori Hewan
// Route::get('/postK/get/{category}', [Category_hewanController::class, 'showKategori']);
// Route::get('/postK/get/', [Category_hewanController::class, 'showKategoriAll']);
// Route::post('/postK/create/', [Category_hewanController::class, 'createKategori']);
// Route::post('/postK/update/{post}', [Category_hewanController::class, 'updateKategori']);
// Route::delete('/post/delete/{id}', [Category_hewanController::class, 'deletePost']);

//user
Route::post('register', [UserController::class, 'registerUser']);
Route::post('login', [UserController::class, 'loginUser']);
Route::post('logout', [UserController::class, 'logoutUser']);
Route::post('user/update/{id}', [UserController::class, 'updateUser']);
Route::get('user/get/{id}', [UserController::class, 'getUser']);

//Kategori Info
Route::get('/postI/get/{category}', [Category_infoController::class, 'showInfo']);
Route::get('/postI/get/', [Category_infoController::class, 'showKategoriAll']);
Route::post('/postI/create/', [Category_infoController::class, 'createInfo']);