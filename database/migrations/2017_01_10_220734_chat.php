<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->boolean('is_panitia');
            $table->integer('expo_id')->unsigned();
            $table->string('chat');
            $table->string('date');
            $table->timestamps();

            $table->foreign('expo_id')->references('id')->on('expo')->onDelete('cascade');
        });

        Schema::create('soal', function(Blueprint $table){
            $table->increments('id');
            $table->longText('soal');
            $table->integer('jenis_soal_id')->unsigned();
            $table->string('jawabal_a');
            $table->string('jawabal_b');
            $table->string('jawabal_c');
            $table->string('jawabal_d');
            $table->string('jawabal_e');
            $table->char('jawaban');
            $table->integer('total_pengerjaan');
            $table->string('author');
            $table->timestamps();

            $table->foreign('jenis_soal_id')->references('id')->on('kategori')->onDelete('cascade');
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
        Schema::dropIfExists('soal');
    }
}
