<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AduanController;

Route::get('/', function () {
    return view('home');
});

Route::get('/aduan', function () {
    return view('aduan');
});

Route::get('/form_aduan', function () {
    return view('form_aduan');
});

Route::get('/detail_aduan', function () {
    return view('detail_aduan');
});


Route::get('/aduan', [AduanController::class, 'index'])->name('aduan.index');
Route::get('/aduan/tambah', [AduanController::class, 'create'])->name('aduan.create');
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');
Route::get('/aduan/{kode_aduan}', [AduanController::class, 'show'])->name('aduan.show');

