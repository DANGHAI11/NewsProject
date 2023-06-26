<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('', [PostController::class, 'index'])->name('home');
Route::get('searchByCategory/{category_id}', [PostController::class, 'index'])->name('search.category');
Route::get('searchByTitle', [PostController::class, 'index'])->name('search.title');
Route::get('post/{postDetail}/detail', [PostController::class, 'show'])->name('detail');
Route::middleware(['guest'])->group(function () {
    Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('post-register');
    Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('post-login');
    Route::get('verifyEmail/{token}', [AuthController::class, 'verifyAccount'])->name('verify-email');
    Route::get('forgotPassword', [AuthController::class, 'viewForgotPassword'])->name('forgot-password');
    Route::post('forgotPassword', [AuthController::class, 'forgotPassword'])->name('post-forgot-password');
    Route::get('changePassword/{token}', [AuthController::class, 'changePassword'])->name('change-password');
});

Route::group(['prefix' => 'post/', 'as' => 'post.'], function () {
    Route::get('create', [PostController::class, 'create'])->name('create');
    Route::post('create', [PostController::class, 'store'])->name('store');
    Route::get('update/{postEdit}', [PostController::class, 'edit'])->name('edit');
    Route::put('update/{postUpdate}', [PostController::class, 'update'])->name('update');
    Route::delete('delete/{postDelete}', [PostController::class, 'destroy'])->name('delete');
});
