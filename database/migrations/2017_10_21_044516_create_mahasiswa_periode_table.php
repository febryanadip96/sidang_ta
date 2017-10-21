<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_periode', function (Blueprint $table) {
			$table->integer('mahasiswa_id')->unsigned();
    		$table->foreign('mahasiswa_id')->references('id')->on('mahasiswas');
			$table->integer('periode_id')->unsigned();
    		$table->foreign('periode_id')->references('id')->on('periodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_periode');
    }
}
