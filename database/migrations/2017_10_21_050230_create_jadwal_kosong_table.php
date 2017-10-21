<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalKosongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_kosong', function (Blueprint $table) {
			$table->integer('dosen_id')->unsigned();
    		$table->foreign('dosen_id')->references('id')->on('dosens');
			$table->integer('jadwal_id')->unsigned();
    		$table->foreign('jadwal_id')->references('id')->on('jadwals');
			$table->boolean('diambil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_kosong');
    }
}
