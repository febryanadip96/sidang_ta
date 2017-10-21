<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosenKaliujiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_kaliuji', function (Blueprint $table) {
			$table->integer('dosen_id')->unsigned();
    		$table->foreign('dosen_id')->references('id')->on('dosens');
			$table->integer('periode_id')->unsigned();
    		$table->foreign('periode_id')->references('id')->on('periodes');
			$table->unsignedInteger('jumlah_menguji')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_kaliuji');
    }
}
