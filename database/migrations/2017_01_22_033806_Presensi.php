<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Presensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadiran', function(Blueprint $table){
            $table->increments('id');
            $table->integer('data_peserta_id')->unsigned();
            $table->string('kehadiran');
            $table->timestamps();

            $table->foreign('data_peserta_id')->references('id')->on('data_peserta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat');
    }
}
