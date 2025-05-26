<?php

use App\Http\Controllers\AlternatifControler;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/', [LandingController::class, 'store'])->name('landing.store');

Route::get('/thank', [LandingController::class, 'thanks'])->name('landing.thank');

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


// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [PertanyaanController::class, 'index'])->name('dashboard');

    // Pertanyaan
    Route::get('/pertanyaan', [PertanyaanController::class, 'index'])->name('pertanyaan.index')->middleware('permission:view pertanyaan');
    Route::post('/pertanyaan', [PertanyaanController::class, 'store'])->name('pertanyaan.store')->middleware('permission:create pertanyaan');

    Route::get('/pertanyaan/{pertanyaan}/edit', [PertanyaanController::class, 'edit'])->name('pertanyaan.edit')->middleware('permission:edit pertanyaan');
    Route::post('/pertanyaan{pertanyaan}/edit', [PertanyaanController::class, 'update'])->name('pertanyaan.update')->middleware('permission:update pertanyaan');

    Route::get('/pertanyaan/{pertanyaan}/destroy', [PertanyaanController::class, 'destroy'])->name('pertanyaan.destroy')->middleware('permission:delete pertanyaan');

    // Pilihan
    Route::get('/pilihan', [PilihanController::class, 'index'])->name('pilihan.index')->middleware('permission:view pilihan');
    Route::post('/pilihan', [PilihanController::class, 'store'])->name('pilihan.store')->middleware('permission:create pilihan');

    Route::get('/pilihan/{pilihan}/edit', [PilihanController::class, 'edit'])->name('pilihan.edit')->middleware('permission:edit pilihan');
    Route::post('/pilihan/{pilihan}/edit', [PilihanController::class, 'update'])->name('pilihan.update')->middleware('permission:update pilihan');

    Route::get('/pilihan/{pilihan}/destroy', [PilihanController::class, 'destroy'])->name('pilihan.destroy')->middleware('permission:delete pilihan');

    // Alternatif
    Route::get('/pengunjung', [AlternatifControler::class, 'index'])->name('alternatif.index');

    Route::get('/pengunjung/{alternatif}', [AlternatifControler::class, 'show'])->name('alternatif.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout
    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
});

require __DIR__ . '/auth.php';
