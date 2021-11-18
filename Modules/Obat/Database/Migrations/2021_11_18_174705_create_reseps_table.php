<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perawatan_id')->unsigned()->references('id')->on('perawatans');
            $table->foreignId('obat_id')->nullable()->unsigned()->references('id')->on('obats');
            $table->string('name');
            $table->string('dosis');
            $table->string('keterangan')->nullable();
            $table->bigInteger('stok');
            $table->bigInteger('harga');
            $table->string('status');
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
        Schema::dropIfExists('reseps');
    }
}
