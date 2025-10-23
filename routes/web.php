<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AduanController;

Route::get('/', function () {
    return view('home');
});

Route::get('/form_aduan', function () {
    return view('form_aduan');
});

// ✅ Route utama aduan (controller)
Route::get('/aduan', [AduanController::class, 'index'])->name('aduan.index');
Route::get('/aduan/tambah', [AduanController::class, 'create'])->name('aduan.create');
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');

// ✅ Route pencarian aduan
Route::get('/aduan/cari', [AduanController::class, 'cari'])->name('aduan.cari');

// ✅ Route detail aduan dengan token terenkripsi
Route::get('/aduan/{token}', [AduanController::class, 'showEncrypted'])->name('aduan.show');
