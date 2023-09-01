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
        Schema::create('grups', function (Blueprint $table) {
            $table->id();

            $table->integer('periode_ke');
            $table->integer('yudisium_ke');
            $table->integer('jurusan_id');
            $table->string('tahun_akademik');
            $table->string('status_jadwal');
            $table->integer('ruangan_id')->nullable();
            $table->date('tanggal_sidang')->nullable();
            $table->date('batas_revisi')->nullable();

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
        Schema::dropIfExists('grups');
    }
};
