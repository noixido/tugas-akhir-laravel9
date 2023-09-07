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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->string('nim')->unique();
            $table->string('nama_mahasiswa');
            $table->year('angkatan')->nullable();
            $table->integer('jurusan_id')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('telepon')->nullable();


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
        Schema::dropIfExists('mahasiswas');
    }
};
