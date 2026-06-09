<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DosenDashboardController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\DashboardController;

// PUBLIC
Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [SearchController::class, 'index']);
Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');
Route::get('/matkul/{id}', [MatkulController::class, 'show']);

// GUEST
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// MAHASISWA
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');
    Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
});

// UPVOTE
Route::middleware(['auth'])->group(function () {
    Route::patch('/review/{id}/upvote', [ReviewController::class, 'upvote'])->name('review.upvote');
});

// DOSEN
Route::middleware(['auth', 'role:dosen'])->prefix('dashboard')->group(function () {
    Route::get('/dosen/settings', [DosenDashboardController::class, 'profileSettings'])->name('dosen.settings');
    Route::get('/dosen', [DosenDashboardController::class, 'index'])->name('dashboard.dosen');
    Route::put('/dosen/settings/update', [DosenDashboardController::class, 'updateProfile'])->name('dosen.profile.update');
    Route::put('/dosen/password/update', [DosenDashboardController::class, 'updatePassword'])->name('dosen.password.update');
});

// ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    Route::patch('/admin/review/{id}/toggle', [AdminDashboardController::class, 'toggleReview'])->name('admin.review.toggle');
});
