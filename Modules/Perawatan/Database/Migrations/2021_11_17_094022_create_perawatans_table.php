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
            $table->string('kode')->unique();
            $table->foreignId('pasien_id')->unsigned()->references('id')->on('pasiens');
            $table->foreignId('dokter_id')->unsigned()->references('id')->on('dokters');
            $table->string('pelayanan');
            $table->string('spesialis');
            $table->string('status');
            $table->dateTime('awal_perawatan')->nullable();
            $table->dateTime('akhir_perawatan')->nullable();
            $table->bigInteger('resep_id')->nullable()  ->unsigned()->references('id')->on('reseps');
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
