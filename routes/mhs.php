<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('mhs');

Route::resource('mhsKhs', 'KhsController');
Route::resource('mhsPerwalian', 'PerwalianController');

Route::resource('komenPerwalian', 'KomenPerwalianController');
