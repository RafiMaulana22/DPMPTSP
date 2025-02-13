<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Kriteria
Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');

// Auth
Route::middleware(['guest'])->group(function () {
    // Login
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Register
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Dashboard


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role_permission'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout
    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
});

require __DIR__.'/auth.php';
