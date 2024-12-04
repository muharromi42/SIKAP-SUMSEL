<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');



Route::get('registration', [AuthController::class, 'registration'])->name('registration');
Route::post('register', [AuthController::class, 'store'])->name('register');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::put('/account/{id}/update', [AccountController::class, 'update'])->name('account.update');

Route::get('/faq', [OtherController::class, 'faq'])->name('faq');


Route::resource('users', UserController::class);


Route::middleware('auth')->group(function () {
    Route::post('/uploads/create', [BerkasController::class, 'store'])->name('uploads.store');
    Route::get('/uploads', [BerkasController::class, 'create'])->name('uploads.create');
});

// Route::middleware(['auth', 'isAdmin'])->group(function () {
Route::get('/admin/uploads', [AdminController::class, 'index'])->name('admin.uploads.index');
Route::get('/admin/uploads/{id}', [AdminController::class, 'show'])->name('admin.uploads.show');
Route::post('/admin/uploads/{id}/validate', [AdminController::class, 'validateUpload'])->name('admin.uploads.validate');
Route::delete('/admin/uploads/{id}', [AdminController::class, 'destroy'])->name('admin.uploads.destroy');
// });

Route::get('/berkas', [BerkasController::class, 'index'])->name('berkas.index');


Route::get('/notifications', [BerkasController::class, 'getNotifications'])->middleware('auth');
