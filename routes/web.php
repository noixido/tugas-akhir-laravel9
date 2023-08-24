<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\DataJurusan;
use App\Http\Controllers\DataJurusanController;
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
    Route::get('/edit-profile/{user}/edit', [AkademikController::class, 'edit'])->name('edit_akademik_profil');
    Route::put('/edit-profile/{user}/', [AkademikController::class, 'update'])->name('proses_edit_akademik_profil');

    Route::get('/', [AkademikController::class, 'index'])->name('dashboard');

    // ========== DATA MAHASISWA ========
    Route::get('/data-mahasiswa', [DataMahasiswaController::class, 'index'])->name('data-mahasiswa');
    Route::get('/tambah-mahasiswa', [DataMahasiswaController::class, 'create'])->name('tambah-mahasiswa');
    Route::post('/tambah-mahasiswa', [DataMahasiswaController::class, 'store'])->name('proses-tambah-mahasiswa');
    Route::get('/edit-mahasiswa/{id}/edit', [DataMahasiswaController::class, 'edit'])->name('edit-mahasiswa');
    Route::put('/edit-mahasiswa/{id}', [DataMahasiswaController::class, 'update'])->name('proses-edit-mahasiswa');
    Route::delete('/hapus-mahasiswa/{id}', [DataMahasiswaController::class, 'destroy'])->name('hapus-mahasiswa');
    Route::get('/lihat-mahasiswa/{id}', [DataMahasiswaController::class, 'show'])->name('lihat-mahasiswa');

    // ========== DATA ADMIN AKADEMIK ========
    Route::get('/data-admin', [DataAdminController::class, 'index'])->name('data-admin');
    Route::get('/tambah-admin', [DataAdminController::class, 'create'])->name('tambah-admin');
    Route::post('/tambah-admin', [DataAdminController::class, 'store'])->name('proses-tambah-admin');
    Route::get('/edit-admin/{id}/edit', [DataAdminController::class, 'edit'])->name('edit-admin');
    Route::put('/edit-admin/{id}', [DataAdminController::class, 'update'])->name('proses-edit-admin');
    Route::delete('/hapus-admin/{id}', [DataAdminController::class, 'destroy'])->name('hapus-admin');


    // ========== DATA Program Studi ========
    Route::get('/data-jurusan', [DataJurusanController::class, 'index'])->name('data-jurusan');
    Route::get('/tambah-jurusan', [DataJurusanController::class, 'create'])->name('tambah-jurusan');
    Route::post('/tambah-jurusan', [DataJurusanController::class, 'store'])->name('proses-tambah-jurusan');
    Route::get('/edit-jurusan/{id}/edit', [DataJurusanController::class, 'edit'])->name('edit-jurusan');
    Route::put('/edit-jurusan/{id}', [DataJurusanController::class, 'update'])->name('proses-edit-jurusan');
    Route::delete('/hapus-jurusan/{id}', [DataJurusanController::class, 'destroy'])->name('hapus-jurusan');
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
