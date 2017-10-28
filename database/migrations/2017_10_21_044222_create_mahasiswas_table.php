<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nrp',15);
			$table->string('nama',50);
			$table->string('judul');
			$table->string('no_telp',25);
			$table->boolean('persyaratan_1')->nullable();
			$table->boolean('persyaratan_2')->nullable();
			$table->boolean('persyaratan_3')->nullable();
			$table->boolean('persyaratan_4')->nullable();
			$table->boolean('persyaratan_5')->nullable();
			$table->boolean('persyaratan_6')->nullable();
            $table->integer('pembimbing_1_id')->unsigned();
            $table->foreign('pembimbing_1_id')->references('id')->on('dosens');
            $table->integer('pembimbing_2_id')->unsigned();
            $table->foreign('pembimbing_2_id')->references('id')->on('dosens');
            $table->integer('sekretaris_id')->unsigned()->nullable();
            $table->foreign('sekretaris_id')->references('id')->on('dosens');
            $table->integer('ketua_id')->unsigned()->nullable();
            $table->foreign('ketua_id')->references('id')->on('dosens');
            $table->boolean('status_lulus');
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
}
