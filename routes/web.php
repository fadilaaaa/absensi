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
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/akun-petugas', function () {
    return view('admin.akunPetugas');
});
Route::get('/jadwal', function () {
    return view('admin.jadwal');
});
Route::get('/izin', function () {
    return view('admin.izin');
});
Route::get('/presensi', function () {
    return view('admin.presensi');
});
Route::get('/gaji', function () {
    return view('admin.gaji');
});
Route::get('/pengaduan', function () {
    return view('admin.pengaduan');
});
