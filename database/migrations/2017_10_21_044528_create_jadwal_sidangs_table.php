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
			$table->text('memo');
			$table->boolean('status_lulus');
			$table->integer('periode_id')->unsigned();
    		$table->foreign('periode_id')->references('id')->on('periodes');
			$table->integer('mahasiswa_id')->unsigned();
    		$table->foreign('mahasiswa_id')->references('id')->on('mahasiswas');
			$table->integer('pembimbing_1_id')->unsigned();
    		$table->foreign('pembimbing_1_id')->references('id')->on('dosens');
			$table->integer('pembimbing_2_id')->unsigned();
    		$table->foreign('pembimbing_2_id')->references('id')->on('dosens');
			$table->integer('sekretaris_id')->unsigned()->nullable();
    		$table->foreign('sekretaris_id')->references('id')->on('dosens');
			$table->integer('ketua_id')->unsigned()->nullable();
    		$table->foreign('ketua_id')->references('id')->on('dosens');
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
