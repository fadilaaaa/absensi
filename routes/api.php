<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [\App\Http\Controllers\SPA\AuthController::class, 'login']);



Route::middleware('auth-api')->group(function () {
    Route::get('logout', [\App\Http\Controllers\SPA\AuthController::class, 'logout']);
    Route::get('user', [\App\Http\Controllers\SPA\AuthController::class, 'getProfile']);
    Route::put('user', [\App\Http\Controllers\SPA\AuthController::class, 'updateProfile']);
    Route::post('user/change-password', [\App\Http\Controllers\SPA\AuthController::class, 'changePassword']);

    Route::get('petugas/izin', [\App\Http\Controllers\SPA\PetugasController::class, 'getIzin']);
    Route::post('petugas/izin', [\App\Http\Controllers\SPA\PetugasController::class, 'storeIzin']);

    Route::get('petugas/pengaduan', [\App\Http\Controllers\SPA\PetugasController::class, 'getPengaduan']);
    Route::post('petugas/pengaduan', [\App\Http\Controllers\SPA\PetugasController::class, 'storePengaduan']);

    Route::get('petugas/gaji', [\App\Http\Controllers\SPA\PetugasController::class, 'getGaji']);

    Route::get('absensi/today', [\App\Http\Controllers\SPA\AbsensiController::class, 'getTodayPresensi']);
    Route::post('absensi', [\App\Http\Controllers\SPA\AbsensiController::class, 'storeAbsensi']);
    Route::get('absensi', [\App\Http\Controllers\SPA\AbsensiController::class, 'getRiwayatAbsensi']);
});
