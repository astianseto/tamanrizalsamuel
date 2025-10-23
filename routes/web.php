<?php

use Illuminate\Support\Facades\Route;

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