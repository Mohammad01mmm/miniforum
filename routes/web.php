<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Middleware\CheckAuthenticated;

Route::get('/', function () {
    return view('welcome');
});
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// صفحه داشبورد که فقط برای کاربرانی که وارد شده‌اند نمایش داده می‌شود
Route::get('dashboard', function () {
    return view('auth.dashboard');
})
    // ->middleware(CheckAuthenticated::class)
    ->name('dashboard');

Route::get('/', [ForumController::class, 'index'])->name('forum.index');
Route::get('/create', [ForumController::class, 'create'])->name('forum.create');
Route::post('/store', [ForumController::class, 'store'])->name('forum.store');
Route::get('/topic/{topic}', [ForumController::class, 'show'])->name('forum.show');
Route::post('/topic/{topic}/reply', [ForumController::class, 'reply'])->name('forum.reply');
