<?php


use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;

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

Route::get('/', [AuthController::class, 'login']);

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'actionLogin'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'actionLogout']);
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/akun-petugas', [\App\Http\Controllers\Admin\PetugasController::class, 'index']);
    Route::delete('/akun-petugas/{id}', [\App\Http\Controllers\Admin\PetugasController::class, 'destroy']);
    Route::get('/jadwal', [\App\Http\Controllers\Admin\JadwalController::class, 'index']);
    Route::delete('/jadwal/{id}', [\App\Http\Controllers\Admin\JadwalController::class, 'destroy']);
    Route::get('/izin', function () {
        return view('admin.izin');
    });
    Route::get('/presensi', function () {
        return view('admin.presensiPeriod');
    });
    Route::get('presensi/periode/{id}', function ($id) {
        return view('admin.presensi', ['id' => $id]);
    });
    Route::get('/gaji', function () {
        return view('admin.gaji');
    });
    Route::get('/pengaduan', function () {
        return view('admin.pengaduan');
    });
});
Route::group(['prefix' => 'petugas', 'middleware' => ['auth', 'role:user']], function () {
    Route::get('/jadwal', function () {
        return view('petugas.jadwal');
    });
    Route::get('/izin', function () {
        return view('petugas.izin');
    });
    Route::get('/presensi', function () {
        return view('petugas.presensi');
    });
    Route::get('/presensi/riwayat/{id}', [\App\Http\Controllers\Petugas\PresensiController::class, 'riwayat']);
    Route::get('/gaji', function () {
        return view('petugas.gaji');
    });
    Route::get('/pengaduan', function () {
        return view('petugas.pengaduan');
    });
});

Route::get('/gitpullhooks', [\App\Http\Controllers\PullhookController::class, 'pull']);
