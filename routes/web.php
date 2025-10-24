<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Halaman utama
Route::get('/', function () {
    return view('home');
});

// ✅ Halaman dashboard admin (hanya untuk user login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Halaman profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Rute untuk halaman aduan publik
Route::get('/aduan', [AduanController::class, 'index'])->name('aduan.index');
Route::get('/aduan/tambah', [AduanController::class, 'create'])->name('aduan.create');
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');
Route::get('/aduan/cari', [AduanController::class, 'cari'])->name('aduan.cari');
Route::get('/aduan/{token}', [AduanController::class, 'showEncrypted'])->name('aduan.show');

// ✅ Form aduan publik
Route::get('/form_aduan', function () {
    return view('form_aduan');
});

// ✅ Detail aduan publik
Route::get('/detail_aduan', function () {
    return view('detail_aduan');
});

// ✅ Auth routes dari Breeze
require __DIR__.'/auth.php';

// ✅ Rute untuk halaman dashboard admin

Route::middleware(['auth'])->group(function () {
    
Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    Route::get('/admin/{kode_aduan}/edit', [AduanController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{kode_aduan}', [AduanController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{kode_aduan}', [AduanController::class, 'destroy'])->name('admin.destroy');
});

