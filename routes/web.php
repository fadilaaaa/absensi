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
    Route::post('/akun-petugas', [\App\Http\Controllers\Admin\PetugasController::class, 'store']);
    Route::put('/akun-petugas/{id}', [\App\Http\Controllers\Admin\PetugasController::class, 'update']);
    Route::delete('/akun-petugas/{id}', [\App\Http\Controllers\Admin\PetugasController::class, 'destroy']);

    Route::get('/jadwal', [\App\Http\Controllers\Admin\JadwalController::class, 'index']);
    Route::post('/jadwal', [\App\Http\Controllers\Admin\JadwalController::class, 'store']);
    Route::put('/jadwal/{id}', [\App\Http\Controllers\Admin\JadwalController::class, 'update']);
    Route::delete('/jadwal/{id}', [\App\Http\Controllers\Admin\JadwalController::class, 'destroy']);

    Route::get('/izin', [\App\Http\Controllers\Admin\IzinController::class, 'index']);
    Route::get('/izin/{id}/{code}', [\App\Http\Controllers\Admin\IzinController::class, 'setuju']);

    Route::get('/presensi', [\App\Http\Controllers\Admin\PresensiController::class, 'index']);
    Route::get('presensi/periode/{year}/{periode}', [\App\Http\Controllers\Admin\PresensiController::class, 'periode']);
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
    Route::get('/izin', [\App\Http\Controllers\Petugas\IzinController::class, 'index']);
    Route::post('/izin', [\App\Http\Controllers\Petugas\IzinController::class, 'store']);
    Route::get('/presensi', [\App\Http\Controllers\Petugas\PresensiController::class, 'index']);
    Route::post('/presensi', [\App\Http\Controllers\Petugas\PresensiController::class, 'absen']);
    Route::get('/presensi/riwayat/{id}', [\App\Http\Controllers\Petugas\PresensiController::class, 'riwayat']);
    Route::get('/gaji', function () {
        return view('petugas.gaji');
    });
    Route::get('/pengaduan', function () {
        return view('petugas.pengaduan');
    });
});

Route::get('/gitpullhooks', [\App\Http\Controllers\PullhookController::class, 'pull']);
