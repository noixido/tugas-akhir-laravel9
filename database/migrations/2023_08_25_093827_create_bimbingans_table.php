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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();

            $table->integer('tugas_akhir_id');
            $table->date('tanggal_bimbingan');
            $table->string('deskripsi_bimbingan');
            $table->string('status_bimbingan')->default('ditolak');
            $table->string('status_sidang')->default('tidak diijinkan');

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
        Schema::dropIfExists('bimbingans');
    }
};
