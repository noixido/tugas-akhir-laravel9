<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_sidangs', function (Blueprint $table) {
            $table->id();

            $table->integer('mahasiswa_id');
            $table->string('kelas');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('alamat');
            $table->integer('tugas_akhir_id');
            $table->integer('bimbingan_id');
            $table->float('ipk_saat_ini');
            $table->string('pas_foto');
            $table->string('scan_bukti_spp');
            $table->string('scan_ijazah_terakhir');
            $table->string('scan_akta_kelahiran');
            $table->string('scan_kartu_keluarga');
            $table->string('scan_sertifikat_ujikom_1');
            $table->string('scan_sertifikat_ujikom_2');
            $table->string('scan_sertifikat_ujikom_3')->nullable();
            $table->string('scan_sertifikat_ujikom_4')->nullable();
            $table->string('scan_sertifikat_peka');
            $table->string('scan_sertifikat_toefl');
            $table->string('status_pendaftaran');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_sidangs');
    }
};
