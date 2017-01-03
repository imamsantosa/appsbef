<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Panitia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_panitia', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('panitia', function(Blueprint $table){
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->string('nomor_telepon');
            $table->string('photo')->default('default.jpg');
            $table->integer('panlok_id')->unsigned();
            $table->rememberToken();
            $table->integer('role_id')->unsigned();
            $table->timestamps();

            $table->foreign('panlok_id')->references('id')->on('panlok')->ondelete('cascade');
            $table->foreign('role_id')->references('id')->on('role_panitia')->onDelete('cascade');
        });

        Schema::create('config', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama');
            $table->string('config');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_panitia');
        Schema::dropIfExists('panitia');
        Schema::dropIfExists('config');
    }
}
