<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalSidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_sidangs', function (Blueprint $table) {
            $table->increments('id');
			$table->text('memo')->nullable();
			$table->integer('periode_id')->unsigned();
    		$table->foreign('periode_id')->references('id')->on('periodes');
			$table->integer('mahasiswa_id')->unsigned();
    		$table->foreign('mahasiswa_id')->references('id')->on('mahasiswas');
			$table->integer('tempat_jadwal_id')->unsigned()->nullable();
    		$table->foreign('tempat_jadwal_id')->references('id')->on('tempat_jadwals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_sidangs');
    }
}
