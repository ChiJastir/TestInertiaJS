<?php

use Illuminate\Support\Facades\Route;

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

Route::inertia('/registration', 'RegistrationPage');
Route::post('/registration', [\App\Http\Controllers\UserController::class, 'createUser'])->name('user.create');

Route::inertia('/login', 'LoginPage');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/', [\App\Http\Controllers\PostController::class, 'getPosts'])->name('post.page');
Route::post('/posts/create', [\App\Http\Controllers\PostController::class, 'addPostInDatabase']);
Route::delete('/posts/{post}/delete', [\App\Http\Controllers\PostController::class, 'deletePostFromDatabase'])->name('posts.delete');