<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dosen.dashboard.index');
})->name('dosen');

Route::resource('perwalianDosen', 'PerwalianController');
