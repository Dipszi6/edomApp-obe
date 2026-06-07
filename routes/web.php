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

// Public
Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [SearchController::class, 'index']);
Route::get('/dosen/{id}', [DosenController::class, 'show']);
Route::get('/matkul/{id}', [MatkulController::class, 'show']);

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Mahasiswa
Route::middleware('auth')->group(function () {
    Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::patch('/review/{id}/upvote', [ReviewController::class, 'upvote'])->name('review.upvote');
});

// Dosen
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/dosen', [DosenDashboardController::class, 'index'])->name('dashboard.dosen');
});

// Admin
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    Route::patch('/admin/review/{id}/toggle', [AdminDashboardController::class, 'toggleReview'])->name('admin.review.toggle');
});

require __DIR__.'/auth.php';