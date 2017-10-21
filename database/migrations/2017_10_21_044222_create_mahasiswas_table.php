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
			$table->boolean('persyaratan_1');
			$table->boolean('persyaratan_2');
			$table->boolean('persyaratan_3');
			$table->boolean('persyaratan_4');
			$table->boolean('persyaratan_5');
			$table->boolean('persyaratan_6');
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
