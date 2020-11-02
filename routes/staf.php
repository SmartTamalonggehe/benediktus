<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('staf.dashboard.index');
})->name('staf');

Route::resource('mhs', 'MhsController');
Route::resource('khs', 'KhsController');
Route::resource('kelas', 'KelasController');
Route::resource('perwalian', 'PerwalianController');
Route::get('StafPerwalian_mhs', 'PerwalianController@mhs')->name('staf.mhs');
Route::resource('nilai', 'NilaiController');
