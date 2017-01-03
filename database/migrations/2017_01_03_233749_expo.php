<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Expo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expo', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama');
            $table->longText('content');
            $table->string('edited_by');
            $table->boolean('utara')->default(false);
            $table->boolean('selatan')->default(false);
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
        Schema::dropIfExists('expo');

    }
}
