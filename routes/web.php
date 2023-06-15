<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $user = Auth::user();
    $id = Auth::id();
    Auth::check();
    dd($user);
    //return 'Day la trang home';
})->name('home');

Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('post-login');
Route::post('logout',[AuthController::class,'logout'])->name('logout');
Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('post-register');
Route::get('verify-email/{token}', [AuthController::class, 'verifyAccount'])->name('verify-email');
Route::get('forgot-password',[AuthController::class,'viewForgotPassword'])->name('forgot-password');
Route::post('forgot-password',[AuthController::class,'forgotPassword'])->name('post-forgot-password');
Route::get('change-password/{token}',[AuthController::class,'changePassword'])->name('change-password');
