<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Percobaan 2: route sederhana
Route::get('/halo', function () {
    return 'Halo, Laravel!';
});

// Percobaan 2: route dengan parameter
Route::get('/halo/{nama}', function ($nama) {
    return 'Halo, ' . $nama . '!';
});

// Percobaan 3: halaman contoh Blade
Route::get('/coba', function () {
    return view('coba');
});

// Tantangan 4: autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// hanya pengguna yang sudah login boleh mengelola alat dan peminjaman
Route::middleware('auth')->group(function () {
    Route::resource('alat', AlatController::class);

    // Tantangan 3: entitas kedua yang berelasi dengan alat
    Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'create', 'store']);
    Route::patch('/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembali'])
        ->name('peminjaman.kembali');
});
