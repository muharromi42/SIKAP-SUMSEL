<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\UserDeadlineController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\PdfController;
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
Route::get('/contact', [OtherController::class, 'contact'])->name('contact');


Route::resource('users', UserController::class);
Route::get('usersend', [UserController::class, 'usersend'])->name('usersend');
Route::get('usernotsend', [UserController::class, 'usernotsend'])->name('usernotsend');
Route::get('approvedPdf', [UserController::class, 'approvedPdf'])->name('approvedPdf');
Route::get('rejectedPdf', [UserController::class, 'rejectedPdf'])->name('rejectedPdf');


Route::middleware('auth')->group(function () {
    Route::post('/uploads/create', [BerkasController::class, 'store'])->name('uploads.store');
    Route::get('/uploads', [BerkasController::class, 'create'])->name('uploads.create');
    Route::get('/uploads/{id}/edit', [BerkasController::class, 'edit'])->name('uploads.edit');
    Route::put('/uploads/{id}', [BerkasController::class, 'update'])->name('uploads.update');
    Route::delete('/uploads/{id}', [BerkasController::class, 'destroy'])->name('uploads.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('uploads', [AdminController::class, 'index'])->name('uploads.index');
    Route::get('uploads/approved', [AdminController::class, 'approved'])->name('uploads.approved');
    Route::get('uploads/rejected', [AdminController::class, 'rejected'])->name('uploads.rejected');
    Route::get('uploads/pending', [AdminController::class, 'pending'])->name('uploads.pending');
    Route::get('deadlines', [UserDeadlineController::class, 'index'])->name('deadlines.index');
    Route::post('users/{user}/deadline', [UserDeadlineController::class, 'setDeadline'])->name('users.setDeadline');
    Route::post('users/global-deadline', [UserDeadlineController::class, 'setGlobalDeadline'])->name('users.setGlobalDeadline');
});

// Route::middleware(['auth', 'isAdmin'])->group(function () {
// Route::get('/admin/uploads', [AdminController::class, 'index'])->name('admin.uploads.index');
Route::get('/admin/uploads/{id}', [AdminController::class, 'show'])->name('admin.uploads.show');
Route::post('/admin/uploads/{id}/validate', [AdminController::class, 'validateUpload'])->name('admin.uploads.validate');
Route::delete('/admin/uploads/{id}', [AdminController::class, 'destroy'])->name('admin.uploads.destroy');
// });


Route::get('/berkas', [BerkasController::class, 'index'])->name('berkas.index');
Route::get('/berkas/pending', [BerkasController::class, 'pending'])->name('berkas.pending');
Route::get('/berkas/approved', [BerkasController::class, 'approved'])->name('berkas.approved');
Route::get('/berkas/rejected', [BerkasController::class, 'rejected'])->name('berkas.rejected');


// Route::get('/notifications', [BerkasController::class, 'getNotifications'])->middleware('auth');

Route::get('/admin/uploads/approved/pdf', [AdminController::class, 'approvedPdf'])->name('admin.uploads.approved.pdf');
Route::get('/admin/uploads/rejected/pdf', [AdminController::class, 'rejectedPdf'])->name('admin.uploads.rejected.pdf');
Route::get('/admin/uploads/pending/pdf', [AdminController::class, 'pendingPdf'])->name('admin.uploads.pending.pdf');
