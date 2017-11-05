<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->increments('id');
			$table->date('tanggal');
			$table->enum('waktu',['07.00-08.30','08.30-10.00','10.00-11.30','11.30-13.00','13.00-14.30','14.30-16.00']);
			$table->boolean('disabled');
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
        Schema::dropIfExists('jadwals');
    }
}
