<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('registration');
Route::post('register', [AuthController::class, 'store'])->name('register');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
