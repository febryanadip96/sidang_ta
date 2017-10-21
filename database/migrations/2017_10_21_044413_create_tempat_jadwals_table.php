<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempatJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempat_jadwals', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('jadwal_id')->unsigned();
    		$table->foreign('jadwal_id')->references('id')->on('jadwals');
			$table->integer('tempat_id')->unsigned();
    		$table->foreign('tempat_id')->references('id')->on('tempats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempat_jadwals');
    }
}
