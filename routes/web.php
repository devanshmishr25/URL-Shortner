<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Invitation routes
Route::get('/invitation/accept/{token}', [InvitationController::class, 'accept'])->name('invitation.accept');
Route::get('/register/accept', [InvitationController::class, 'registerAccept'])->name('register.accept');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Short URL routes
    Route::post('/short-url', [ShortUrlController::class, 'store'])->name('short-url.store');
    Route::delete('/short-url/{shortUrl}', [ShortUrlController::class, 'destroy'])->name('short-url.destroy');

    // Invitation routes
    Route::post('/invitation/send', [InvitationController::class, 'send'])->name('invitation.send');
});

// Redirect route (public)
Route::get('/{shortCode}', [ShortUrlController::class, 'redirect'])->name('redirect');
