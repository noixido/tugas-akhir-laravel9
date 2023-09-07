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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->string('nama_dosen');
            $table->string('nidn')->unique();
            $table->integer('jurusan_id')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();

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
        Schema::dropIfExists('dosens');
    }
};
