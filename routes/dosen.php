<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dosen');

Route::resource('perwalianDosen', 'PerwalianController');
Route::resource('komenPerwalianDosen', 'KomenPerwalianController');

Route::get('/grafikMhs', 'DashboardController@grafikMhs');
