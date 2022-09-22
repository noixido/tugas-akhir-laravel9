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
            $table->year('angkatan');
            $table->integer('program_studi_id');
            $table->string('email')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->bigInteger('no_telepon');
            $table->string('judul_tugas_akhir');
            $table->string('pembimbing');

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
