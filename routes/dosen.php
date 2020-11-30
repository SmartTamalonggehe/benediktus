<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dosen.dashboard.index');
})->name('dosen');

Route::resource('perwalianDosen', 'PerwalianController');
Route::resource('komenPerwalianDosen', 'KomenPerwalianController');

Route::get('/grafikMhs', 'DashboardController@grafikMhs');
