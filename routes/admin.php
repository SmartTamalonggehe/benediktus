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
    return view('admin.dashboard.index');
})->name('admin');

Route::resource('matkul', 'MatkulController');
Route::resource('dosen', 'DosenController');
Route::resource('jadwal', 'JadwalController');
Route::resource('tools', 'ToolsController');
Route::resource('ruang', 'RuangController');
Route::resource('prasyarat', 'PrasyaratController');
