<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerawatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perawatans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode')->unique();
            $table->foreignId('pasien_id')->unsigned()->references('id')->on('pasiens');
            $table->foreignId('poliklinik_id')->unsigned()->references('id')->on('polikliniks');
            $table->string('pelayanan');
            $table->string('status');
            $table->text('keluhan');
            $table->dateTime('awal_perawatan')->nullable();
            $table->dateTime('akhir_perawatan')->nullable();
            $table->text('analisis')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('perawatans');
    }
}
