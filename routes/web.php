<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UserController;
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
Route::get('searchByCategory', [PostController::class, 'index'])->name('search.category');
Route::get('searchByTitle', [PostController::class, 'index'])->name('search.title');
Route::get('post/{postDetail}/detail', [PostController::class, 'show'])->name('detail');
Route::middleware(['guest'])->group(function () {
    Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('post.register');
    Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('post.login');
    Route::get('verifyEmail/{token}', [AuthController::class, 'verifyAccount'])->name('verify.email');
    Route::get('forgotPassword', [AuthController::class, 'viewForgotPassword'])->name('forgot.password');
    Route::post('forgotPassword', [AuthController::class, 'forgotPassword'])->name('post.forgot.password');
    Route::get('changePassword/{token}', [AuthController::class, 'changePassword'])->name('change.password');
});

Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    Route::get('create', [PostController::class, 'create'])->name('create');
    Route::post('create', [PostController::class, 'store'])->name('store');
    Route::get('update/{postEdit}', [PostController::class, 'edit'])->name('edit');
    Route::put('update/{postUpdate}', [PostController::class, 'update'])->name('update');
    Route::delete('delete/{postDelete}', [PostController::class, 'destroy'])->name('delete');
    Route::post('like/{post}', [LikeController::class, 'like'])->name('like');
});

Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
    Route::post('create', [CommentController::class, 'store'])->name('store');
    Route::put('update/{comment}', [CommentController::class, 'update'])->name('update');
    Route::delete('delete/{comment}', [CommentController::class, 'destroy'])->name('delete');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('', [UserController::class, 'index'])->name('index');
    Route::get('edit', [UserController::class, 'edit'])->name('edit');
    Route::put('update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('delete/{user}', [UserController::class, 'delete'])->name('delete');
    Route::get('editPassword', [UserController::class, 'editPassword'])->name('edit.password');
    Route::post('updatePassword/{user}', [UserController::class, 'updatePassword'])->name('update.password');
});

Route::group(['middleware' => 'checkAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::get('', [AdminPostController::class, 'index'])->name('index');
        Route::put('approved/{post}', [AdminPostController::class, 'approved'])->name('approved');
        Route::put('approvedAll', [AdminPostController::class, 'approvedAll'])->name('approved.all');
        Route::delete('delete/{post}', [AdminPostController::class, 'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('', [AdminUserController::class, 'index'])->name('index');
        Route::put('activeAll', [AdminUserController::class, 'updateStatusAll'])->name('active.all');
        Route::put('active/{user}', [AdminUserController::class, 'updateStatus'])->name('active');
        Route::get('view/{user}', [AdminUserController::class, 'getViewUpdate'])->name('edit');
        Route::put('update/{user}', [AdminUserController::class, 'updateProfile'])->name('update');
        Route::get('viewDelete/{user}', [AdminUserController::class, 'getViewDelete'])->name('view.delete');
        Route::delete('delete/{user}', [AdminUserController::class, 'delete'])->name('delete');
    });
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('delete/{category}', [CategoryController::class, 'delete'])->name('delete');
    });
});
