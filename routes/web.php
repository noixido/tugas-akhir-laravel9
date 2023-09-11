<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DaftarSidangController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\DataJurusan;
use App\Http\Controllers\DataJurusanController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\DataPendaftaranController;
use App\Http\Controllers\DataRuanganController;
use App\Http\Controllers\DataStaffProdiController;
use App\Http\Controllers\DosenBimbinganController;
use App\Http\Controllers\DosenNilaiController;
use App\Http\Controllers\DraftJadwalController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FinalJadwalController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PublicBimbinganController;
use App\Http\Controllers\StaffProdiController;
use App\Http\Controllers\TugasAkhirController;
use App\Models\Bimbingan;

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
})->name('homepage');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// yang ini cuma buat sementara doang
Route::get('daftar', [LoginController::class, 'daftar'])->name('daftar');
Route::post('registrasi', [LoginController::class, 'registrasi'])->name('registrasi');

Route::get('/bimbingan/mahasiswa/{nim}', [PublicBimbinganController::class, 'show'])->name('public-bimbingan');
Route::get('/jadwalPDF/{id}', [ExportController::class, 'jadwalPDF'])->name('jadwalPDF');


Route::middleware(['auth', 'hakakses:akademik'])->prefix('akademik')->group(function () {
    // Route::resource('/akademik', AkademikController::class)->middleware(['auth', 'hakakses:akademik']);

    // ========== PROFILE AKADEMIK ==========
    Route::get('/profile/{user}', [AkademikController::class, 'show'])->name('akademik_profile');
    Route::get('/edit-profile/{user}/edit', [AkademikController::class, 'edit'])->name('edit_akademik_profil');
    Route::put('/edit-profile/{user}/', [AkademikController::class, 'update'])->name('proses_edit_akademik_profil');

    // ========== DASHBOARD ==========
    Route::get('/', [AkademikController::class, 'index'])->name('dashboard');

    // ========== DATA MAHASISWA ==========
    Route::get('/data-mahasiswa', [DataMahasiswaController::class, 'index'])->name('data-mahasiswa');
    Route::post('/data-mahasiswa/import', [DataMahasiswaController::class, 'import'])->name('import-data-mahasiswa');
    Route::get('/tambah-mahasiswa', [DataMahasiswaController::class, 'create'])->name('tambah-mahasiswa');
    Route::post('/tambah-mahasiswa', [DataMahasiswaController::class, 'store'])->name('proses-tambah-mahasiswa');
    Route::get('/lihat-mahasiswa/{id}', [DataMahasiswaController::class, 'show'])->name('lihat-mahasiswa');
    Route::get('/edit-mahasiswa/{id}/edit', [DataMahasiswaController::class, 'edit'])->name('edit-mahasiswa');
    Route::put('/edit-mahasiswa/{id}', [DataMahasiswaController::class, 'update'])->name('proses-edit-mahasiswa');
    Route::delete('/hapus-mahasiswa/{id}', [DataMahasiswaController::class, 'destroy'])->name('hapus-mahasiswa');

    Route::get('/download', [DataMahasiswaController::class, 'download'])->name('download-import-data-mahasiswa');

    // ========== DATA DOSEN ==========
    Route::get('/data-dosen', [DataDosenController::class, 'index'])->name('data-dosen');
    Route::get('/tambah-dosen', [DataDosenController::class, 'create'])->name('tambah-dosen');
    Route::post('/tambah-dosen', [DataDosenController::class, 'store'])->name('proses-tambah-dosen');
    Route::get('/lihat-dosen/{id}', [DataDosenController::class, 'show'])->name('lihat-dosen');
    Route::get('/edit-dosen/{id}/edit', [DataDosenController::class, 'edit'])->name('edit-dosen');
    Route::put('/edit-dosen/{id}', [DataDosenController::class, 'update'])->name('proses-edit-dosen');
    Route::delete('/hapus-dosen/{id}', [DataDosenController::class, 'destroy'])->name('hapus-dosen');

    // ========== DATA ADMIN AKADEMIK ==========
    Route::get('/data-admin', [DataAdminController::class, 'index'])->name('data-admin');
    Route::get('/tambah-admin', [DataAdminController::class, 'create'])->name('tambah-admin');
    Route::post('/tambah-admin', [DataAdminController::class, 'store'])->name('proses-tambah-admin');
    Route::get('/edit-admin/{id}/edit', [DataAdminController::class, 'edit'])->name('edit-admin');
    Route::put('/edit-admin/{id}', [DataAdminController::class, 'update'])->name('proses-edit-admin');
    Route::delete('/hapus-admin/{id}', [DataAdminController::class, 'destroy'])->name('hapus-admin');

    // ========== DATA STAFF PRODI ==========
    Route::get('/data-staffprodi', [DataStaffProdiController::class, 'index'])->name('data-staffprodi');
    Route::get('/tambah-staffprodi', [DataStaffProdiController::class, 'create'])->name('tambah-staffprodi');
    Route::post('/tambah-staffprodi', [DataStaffProdiController::class, 'store'])->name('proses-tambah-staffprodi');
    Route::get('/edit-staffprodi/{id}/edit', [DataStaffProdiController::class, 'edit'])->name('edit-staffprodi');
    Route::put('/edit-staffprodi/{id}', [DataStaffProdiController::class, 'update'])->name('proses-edit-staffprodi');
    Route::delete('/hapus-staffprodi/{id}', [DataStaffProdiController::class, 'destroy'])->name('hapus-staffprodi');

    // ========== DATA Program Studi ==========
    Route::get('/data-jurusan', [DataJurusanController::class, 'index'])->name('data-jurusan');
    Route::get('/tambah-jurusan', [DataJurusanController::class, 'create'])->name('tambah-jurusan');
    Route::post('/tambah-jurusan', [DataJurusanController::class, 'store'])->name('proses-tambah-jurusan');
    Route::get('/edit-jurusan/{id}/edit', [DataJurusanController::class, 'edit'])->name('edit-jurusan');
    Route::put('/edit-jurusan/{id}', [DataJurusanController::class, 'update'])->name('proses-edit-jurusan');
    Route::delete('/hapus-jurusan/{id}', [DataJurusanController::class, 'destroy'])->name('hapus-jurusan');

    // ========== DATA RUANGAN ==========
    Route::get('/data-ruangan', [DataRuanganController::class, 'index'])->name('data-ruangan');
    Route::get('/tambah-ruangan', [DataRuanganController::class, 'create'])->name('tambah-ruangan');
    Route::post('/tambah-ruangan', [DataRuanganController::class, 'store'])->name('proses-tambah-ruangan');
    Route::get('/edit-ruangan/{id}/edit', [DataRuanganController::class, 'edit'])->name('edit-ruangan');
    Route::put('/edit-ruangan/{id}', [DataRuanganController::class, 'update'])->name('proses-edit-ruangan');
    Route::delete('/hapus-ruangan/{id}', [DataRuanganController::class, 'destroy'])->name('hapus-ruangan');

    // ==========  DATA NILAI SIDANG TUGAS AKHIR MAHASISWA ==========
    Route::get('/data-nilai', [NilaiController::class, 'index'])->name('data-nilai');
    Route::get('/data-nilai/export', [NilaiController::class, 'export'])->name('export-data-nilai');
    Route::get('/data-nilai/{id}', [NilaiController::class, 'show'])->name('detail-data-nilai');

    // ========== DATA PENDAFTARAN SIDANG TUGAS AKHIR ==========
    Route::get('/data-pendaftaran-sidang', [DataPendaftaranController::class, 'index'])->name('data-pendaftaran-sidang');
    Route::get('/tabel-data-pendaftaran-sidang', [DataPendaftaranController::class, 'tabel'])->name('tabel-data-pendaftaran-sidang');
    Route::get('/data-pendaftaran-sidang/export', [DataPendaftaranController::class, 'export'])->name('export-data-pendaftaran-sidang');
    Route::get('/lihat-pendaftaran/{id}', [DataPendaftaranController::class, 'show'])->name('lihat-pendaftaran');
    Route::delete('/hapus-pendaftaran/{id}', [DataPendaftaranController::class, 'destroy'])->name('hapus-pendaftaran');
    //-------------- LIHAT BIMBINGAN MAHASISWA --------------
    Route::get('/lihat-bimbingan-mahasiswa/{id}', [DataPendaftaranController::class, 'bimbingan'])->name('lihat-bimbingan-mahasiswa');

    // ========== DRAFT JADWAL UNTUK AKADEMIK ==========
    Route::get('/draft-jadwal', [DraftJadwalController::class, 'index'])->name('draft-jadwal');
    Route::get('/tambah-draft', [DraftJadwalController::class, 'create'])->name('tambah-draft');
    Route::post('/tambah-draft', [DraftJadwalController::class, 'store'])->name('proses-tambah-draft');
    Route::get('/draft-jadwal/{id}', [DraftJadwalController::class, 'show'])->name('detail-draft-jadwal');
    // Route::get('/edit-draft/{id}/edit', [DraftJadwalController::class, 'edit'])->name('edit-draft');
    // Route::put('/edit-draft/{id}', [DraftJadwalController::class, 'update'])->name('proses-edit-draft');
    Route::get('/detail-draft/{id}', [DraftJadwalController::class, 'show'])->name('detail-draft');
    Route::delete('/hapus-draft/{id}', [DraftJadwalController::class, 'destroy'])->name('hapus-draft');
    Route::put('/kirim-ke-prodi/{id}', [DraftJadwalController::class, 'kirimKeProdi'])->name('kirim-ke-prodi');

    // ==========  JADWAL DARI PRODI UNTUK AKADEMIK (finalisasi)==========
    Route::get('/jadwal-sidang', [FinalJadwalController::class, 'index'])->name('jadwal-sidang');
    Route::get('/jadwal-sidang/{id}', [FinalJadwalController::class, 'show'])->name('detail-jadwal-sidang');
    Route::put('/publish/{id}', [FinalJadwalController::class, 'publish'])->name('publish-jadwal');
});



Route::middleware(['auth', 'hakakses:mahasiswa'])->prefix('mahasiswa')->group(function () {
    // Route::resource('/mahasiswa', MahasiswaController::class)->middleware(['auth', 'hakakses:mahasiswa']);

    // ========== PROFILE MAHASISWA ==========
    Route::get('/profile/{user}', [MahasiswaController::class, 'show'])->name('mahasiswa_profile');
    Route::get('/edit-profile/{user}/edit', [MahasiswaController::class, 'edit'])->name('edit_mahasiswa_profil');
    Route::put('/edit-profile/{user}/', [MahasiswaController::class, 'update'])->name('proses_edit_mahasiswa_profil');

    // ========== DASHBOARD MAHASISWA ==========
    Route::get('/', [MahasiswaController::class, 'index'])->name('dashboard');

    // ========== DATA TUGAS AKHIR==========
    // Route::get('/tugas-akhir/{user}', [TugasAkhirController::class, 'show'])->name('tugas-akhir');
    Route::get('/tugas-akhir', [TugasAkhirController::class, 'index'])->name('tugas-akhir');
    Route::get('/edit-tugas-akhir/{id}/edit', [TugasAkhirController::class, 'edit'])->name('edit-tugas-akhir');
    Route::put('/edit-tugas-akhir/{id}', [TugasAkhirController::class, 'update'])->name('proses-edit-tugas-akhir');
    Route::get('/profile-pembimbing/{id}', [TugasAkhirController::class, 'profilePembimbing'])->name('profile-pembimbing');

    // ========== DATA BERITA ACARA BIMBINGAN ==========
    // Route::get('/bimbingan/{user}', [BimbinganController::class, 'show'])->name('bimbingan');
    Route::get('/bimbingan', [BimbinganController::class, 'index'])->name('bimbingan');
    Route::get('/tambah-bimbingan', [BimbinganController::class, 'create'])->name('tambah-bimbingan');
    Route::post('/tambah-bimbingan', [BimbinganController::class, 'store'])->name('proses-tambah-bimbingan');
    Route::get('/lihat-bimbingan/{id}', [BimbinganController::class, 'show'])->name('lihat-bimbingan');
    Route::get('/edit-bimbingan/{id}/edit', [BimbinganController::class, 'edit'])->name('edit-bimbingan');
    Route::put('/edit-bimbingan/{id}', [BimbinganController::class, 'update'])->name('proses-edit-bimbingan');
    Route::delete('/hapus-bimbingan/{id}', [BimbinganController::class, 'destroy'])->name('hapus-bimbingan');


    // ========== Pendaftaran Sidang Mahasiswa ==========
    Route::get('/daftar-sidang', [DaftarSidangController::class, 'create'])->name('daftar-sidang');
    Route::post('/daftar-sidang', [DaftarSidangController::class, 'store'])->name('proses-daftar-sidang');
    Route::get('/daftar-sidang/{id}', [DaftarSidangController::class, 'show'])->name('lihat-daftar-sidang');

    // ========== Pendaftaran Sidang Mahasiswa ==========
    Route::get('/nilai-sidang', [MahasiswaController::class, 'nilaiSidang'])->name('mahasiswa-nilai-sidang');
});



Route::middleware(['auth', 'hakakses:dosen'])->prefix('dosen')->group(function () {
    // Route::resource('/dosen', DosenController::class)->middleware(['auth', 'hakakses:dosen']);

    // ========== PROFILE DOSEN ==========
    Route::get('/profile/{user}', [DosenController::class, 'show'])->name('dosen_profile');
    Route::get('/edit-profile/{user}/edit', [DosenController::class, 'edit'])->name('edit_dosen_profil');
    Route::put('/edit-profile/{user}/', [DosenController::class, 'update'])->name('proses_edit_dosen_profil');

    // ========== DASHBOARD DOSEN ==========
    Route::get('/', [DosenController::class, 'index'])->name('dashboard');

    // ========== BIMBINGAN DOSEN ==========
    Route::get('/bimbingan', [DosenBimbinganController::class, 'index'])->name('dosen-bimbingan');
    Route::get('/bimbingan/{id}', [DosenBimbinganController::class, 'show'])->name('lihat-dosen-bimbingan');
    //--- ubah status bimbingan mahasiswa ---
    Route::put('/diterima/{id}', [DosenBimbinganController::class, 'diterima'])->name('diterima');
    Route::put('/ditolak/{id}', [DosenBimbinganController::class, 'ditolak'])->name('ditolak');
    Route::get('/profile-mahasiswa/{id}', [DosenBimbinganController::class, 'profileMahasiswa'])->name('profile-mahasiswa');


    // ========== MASUKIN NILAI UNTUK PENGUJI DAN PEMBIMBING ==========
    Route::get('/nilai-sidang', [DosenNilaiController::class, 'index'])->name('nilai-sidang');
    Route::get('/nilai-sidang/{id}', [DosenNilaiController::class, 'show'])->name('detail-nilai-sidang');
    Route::get('/input-nilai/{id}', [DosenNilaiController::class, 'showNilai'])->name('input-nilai');
    Route::put('/input-nilai/{id}', [DosenNilaiController::class, 'update'])->name('proses-input-nilai');
});



Route::middleware(['auth', 'hakakses:staffprodi'])->prefix('staffprodi')->group(function () {
    // Route::resource('/staffprodi', StaffProdiController::class)->middleware(['auth', 'hakakses:staffprodi']);



    // ========== PROFILE STAFF PRODI ==========
    Route::get('/profile/{user}', [StaffProdiController::class, 'show'])->name('staffprodi_profile');
    Route::get('/edit-profile/{user}/edit', [StaffProdiController::class, 'edit'])->name('edit_staffprodi_profil');
    Route::put('/edit-profile/{user}/', [StaffProdiController::class, 'update'])->name('proses_edit_staffprodi_profil');

    // ========== DASHBOARD STAFF PRODI ==========
    Route::get('/', [StaffProdiController::class, 'index'])->name('dashboard');

    // ========== DRAFT JADWAL SIDANG UNTUK PRODI ==========
    Route::get('/draft-jadwal', [JadwalController::class, 'index'])->name('staff-draft-jadwal');
    Route::get('/detail-jadwal/{id}', [JadwalController::class, 'show'])->name('detail-jadwal');
    Route::get('/lengkapi-jadwal-a/{id}', [JadwalController::class, 'lengkapiJadwalA'])->name('lengkapi-jadwal-a');
    Route::put('/lengkapi-jadwal-a/{id}', [JadwalController::class, 'prosesLengkapiJadwalA'])->name('proses-lengkapi-a');
    Route::get('/lengkapi-jadwal-b/{id}', [JadwalController::class, 'lengkapiJadwalB'])->name('lengkapi-jadwal-b');
    Route::put('/lengkapi-jadwal-b/{id}', [JadwalController::class, 'prosesLengkapiJadwalB'])->name('proses-lengkapi-jadwal-b');
    Route::put('/kirim-ke-akademik/{id}', [JadwalController::class, 'kirimKeAkademik'])->name('kirim-ke-akademik');
});
