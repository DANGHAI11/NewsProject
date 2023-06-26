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
Route::get('search-by-category/{category_id}', [PostController::class, 'index'])->name('seach-by-category');
Route::get('search-by-title', [PostController::class, 'index'])->name('seach-by-title');
Route::get('post/detail-{id}', [PostController::class, 'show'])->name('detail');
Route::middleware(['checkLogin'])->group(function () {
    Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('post-register');
    Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('post-login');
    Route::get('verify-email/{token}', [AuthController::class, 'verifyAccount'])->name('verify-email');
    Route::get('forgot-password', [AuthController::class, 'viewForgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('post-forgot-password');
    Route::get('change-password/{token}', [AuthController::class, 'changePassword'])->name('change-password');
    Route::get('myblog', [PostController::class, 'index'])->name('myblog');
});
Route::group(['middleware' => ['checkLoginUser'], 'as' => 'post.'], function () {
    Route::get('create-post', [PostController::class, 'create'])->name('create');
    Route::post('create-post', [PostController::class, 'store'])->name('store');
    Route::middleware(['checkPermissionBlog'])->group(function () {
        Route::get('update-post/{id}-post', [PostController::class, 'edit'])->name('edit');
        Route::put('update-post/{id}-post', [PostController::class, 'update'])->name('update');
        Route::delete('delete-post', [PostController::class, 'destroy'])->name('delete');
    });
});
