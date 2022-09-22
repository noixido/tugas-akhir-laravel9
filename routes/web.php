<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\StaffProdiController;

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
    return view('welcome');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// yang ini cuma buat sementara doang
Route::get('daftar', [LoginController::class, 'daftar'])->name('daftar');
Route::post('registrasi', [LoginController::class, 'registrasi'])->name('registrasi');

Route::middleware(['auth', 'hakakses:akademik'])->prefix('akademik')->group(function () {
    // Route::resource('/akademik', AkademikController::class)->middleware(['auth', 'hakakses:akademik']);
    Route::get('/profile/{user}', [AkademikController::class, 'show'])->name('akademik_profile');

    Route::get('/', [AkademikController::class, 'index'])->name('dashboard');

    // ========== DATA MAHASISWA ========
    Route::get('/data-mahasiswa', [DataMahasiswaController::class, 'index'])->name('data-mahasiswa');
});



Route::middleware(['auth', 'hakakses:mahasiswa'])->prefix('mahasiswa')->group(function () {
    // Route::resource('/mahasiswa', MahasiswaController::class)->middleware(['auth', 'hakakses:mahasiswa']);
    Route::get('/profile/{user}', [MahasiswaController::class, 'show'])->name('mahasiswa_profile');

    Route::get('/', [MahasiswaController::class, 'index'])->name('dashboard');
});



// Route::middleware(['auth', 'hakakses:dosen'])->prefix('dosen')->group(function () {
Route::resource('/dosen', DosenController::class)->middleware(['auth', 'hakakses:dosen']);
// });



// Route::middleware(['auth', 'hakakses:staffprodi'])->prefix('staffprodi')->group(function () {
Route::resource('/staffprodi', StaffProdiController::class)->middleware(['auth', 'hakakses:staffprodi']);
// });
