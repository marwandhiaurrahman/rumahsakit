<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResepObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_obat', function (Blueprint $table) {
            $table->integer('obat_id')->unsigned();
            $table->integer('resep_id')->unsigned();
            $table->foreign('obat_id')->references('id')->on('obats')
                ->onDelete('cascade');
            $table->foreign('resep_id')->references('id')->on('reseps')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_obat');
    }
}
