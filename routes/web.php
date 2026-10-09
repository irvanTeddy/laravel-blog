<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// 1. Rute Autentikasi (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 2. Rute Khusus Admin (Hanya untuk yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/blog/create', [PostController::class, 'create'])->name('blog.create');
    Route::post('/blog', [PostController::class, 'store'])->name('blog.store');
    Route::get('/blog/{slug}/edit', [PostController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{slug}', [PostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{slug}', [PostController::class, 'destroy'])->name('blog.destroy');
});

// 3. Rute Umum / Pengunjung (Bisa diakses siapa saja TANPA LOGIN)
Route::get('/', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');
Route::post('/blog/{post_id}/comment', [CommentController::class, 'store'])->name('comment.store'); // Sekarang aman di sini!