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

// ✅ Halaman utama publik
Route::get('/', function () {
    return view('home');
});

// ✅ Halaman aduan publik
Route::get('/aduan', [AduanController::class, 'index'])->name('aduan.index');
Route::get('/aduan/tambah', [AduanController::class, 'create'])->name('aduan.create');
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');
Route::get('/aduan/cari', [AduanController::class, 'cari'])->name('aduan.cari');


// ✅ Halaman statis publik
Route::view('/form_aduan', 'form_aduan');
Route::view('/detail_aduan', 'detail_aduan');

// ✅ Auth routes dari Breeze
require __DIR__.'/auth.php';

// ✅ Rute untuk user login (profil)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Rute untuk admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // MENU baru: daftar aduan (dipisah ke halaman sendiri)
    Route::get('/admin/aduantemp', [AdminController::class, 'aduanList'])->name('admin.aduantemp');

    // Approve (aksi pindahkan atau setujui)
    Route::put('/admin/aduantemp/{kode_aduan}/approve', [AdminController::class, 'approve'])->name('admin.approve');

    // (opsional) jika nanti butuh edit/hapus manual, bisa ditambahkan kembali
    Route::delete('/admin/aduantemp/{kode_aduan}', [AdminController::class, 'hapus'])->name('admin.hapus');
    Route::delete('/admin/aduantemp', [AdminController::class, 'hapusSemua'])->name('admin.hapus.semua');

    Route::put('/admin/aduantemp/{kode_aduan}/approve', [AdminController::class, 'approve'])
    ->name('admin.approve');
});

// ✅ Halaman Data Aduan (dalam folder admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/aduan', [AdminController::class, 'showAduan'])->name('admin.aduan');
});

Route::get('/admin/{kode_aduan}/edit', [AduanController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{kode_aduan}', [AduanController::class, 'update'])->name('admin.update');

Route::get('/admin/export/unanswered', [AdminController::class, 'exportUnanswered'])
    ->name('admin.export.unanswered');

    Route::get('/aduan/{token}', [AduanController::class, 'showEncrypted'])->name('aduan.show');