<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\AdminUsersController;

// =================== HALAMAN UTAMA ===================
// Halaman utama mengarahkan ke login jika belum login
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

// =================== DASHBOARD UTAMA ===================
// Mengecek role user dan mengarahkan sesuai dashboard
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role === 'siswa') {
        return redirect()->route('siswa.dashboard');
    }
    abort(403, 'Role tidak dikenali.');
})->middleware(['auth'])->name('dashboard');

// =================== ADMIN ===================
// Semua route di sini hanya bisa diakses oleh ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // CRUD Peminjaman Buku (Admin)
    Route::get('/peminjaman', [PeminjamanBukuController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanBukuController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanBukuController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id}/edit', [PeminjamanBukuController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{id}', [PeminjamanBukuController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [PeminjamanBukuController::class, 'destroy'])->name('peminjaman.destroy');

    // Perizinan Pengembalian (Admin)
    Route::get('/admin/perizinan-pengembalian', [PeminjamanBukuController::class, 'perizinanIndex'])
        ->name('admin.perizinan.index');
    Route::delete('/admin/perizinan-pengembalian/{id}', [PeminjamanBukuController::class, 'perizinanLepas'])
        ->name('admin.perizinan.lepas');

    // User management (Admin)
    Route::get('/admin/users', [AdminUsersController::class, 'index'])->name('admin.users.index');
    Route::delete('/admin/users/{id}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
});

// =================== SISWA ===================
// Semua route di sini hanya bisa diakses oleh SISWA
Route::middleware(['auth', 'role:siswa'])->group(function () {

    // Dashboard Siswa
    Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])
        ->name('siswa.dashboard');

    // Peminjaman Buku (Siswa)
    Route::get('/peminjaman-siswa', [PeminjamanBukuController::class, 'indexSiswa'])->name('peminjaman.siswa.index');
    Route::get('/peminjaman-siswa/create', [PeminjamanBukuController::class, 'createSiswa'])->name('peminjaman.siswa.create');
    Route::post('/peminjaman-siswa', [PeminjamanBukuController::class, 'storeSiswa'])->name('peminjaman.siswa.store');
    Route::post('/peminjaman-siswa/{id}/kembalikan', [PeminjamanBukuController::class, 'kembalikanSiswa'])->name('peminjaman.siswa.kembalikan');
});

// =================== PROFIL USER ===================
// Semua route di sini hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =================== AUTH ROUTES ===================
// Memanggil route login, register, dll. dari Laravel Breeze/Fortify
require __DIR__.'/auth.php';