<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //seed soshum, saintek, ipc
        Schema::create('kategori', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('universitas', function(Blueprint $table){
            $table->increments('id');
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('program_studi', function(Blueprint $table){
            $table->increments('id');
            $table->string('kode');
            $table->string('nama');
            $table->integer('kategori_id')->unsigned();
            $table->integer('universitas_id')->unsigned();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('universitas_id')->references('id')->on('universitas')->onDelete('cascade');

        });

        //seed belum memesan tiket, belum membayar, belum mengisi univ, aktif
        Schema::create('status_peserta', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama');
        });

        Schema::create('peserta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('school');
            $table->string('email');
            $table->string('photo')->default('default.jpg');
            $table->integer('status_peserta_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('status_peserta_id')->references('id')->on('status_peserta')->ondelete('cascade');
        });

        //seed ipc, soshum, saintek, expo
        Schema::create('jenis_tiket', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama');
            $table->double('harga');
            $table->integer('kuota');
            $table->timestamps();
        });

        //seed belum membayar, menunggu verifikasi, sudah bayar.
        Schema::create('status_pembayaran', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama');

        });

        Schema::create('tagihan_peserta', function(Blueprint $table){
            $table->increments('id');
            $table->integer('peserta_id')->unsigned();
            $table->string('kode_pembayaran');
            $table->double('total_pembayaran');
            $table->integer('status_pembayaran_id')->unsigned();
            $table->date('tanggal_konfirmasi')->nullable();
            $table->string('panitia_konfirmasi')->nullable();
            $table->timestamps();

            $table->foreign('status_pembayaran_id')->references('id')->on('status_pembayaran')->ondelete('cascade');
            $table->foreign('peserta_id')->references('id')->on('peserta')->ondelete('cascade');
        });

        Schema::create('data_peserta_tryout', function(Blueprint $table){
            $table->increments('id');
            $table->string('kode_tiket_id')->nullable();
            $table->integer('peserta_id')->unsigned();
            $table->integer('tagihan_peserta_id')->unsigned();
            $table->integer('jenis_tiket_id')->unsigned();
            $table->timestamps();

            $table->foreign('kode_tiket_id')->references('id')->on('kode_tiket')->ondelete('cascade');
            $table->foreign('peserta_id')->references('id')->on('peserta')->ondelete('cascade');
            $table->foreign('tagihan_peserta_id')->references('id')->on('tagihan_peserta')->ondelete('cascade');
            $table->foreign('jenis_tiket_id')->references('id')->on('jenis_tiket')->ondelete('cascade');

        });

        Schema::create('data_peserta_expo', function(Blueprint $table){
            $table->increments('id');
            $table->string('kode_tiket_id')->nullable();
            $table->integer('peserta_id')->unsigned();
            $table->integer('tagihan_peserta_id')->unsigned();
            $table->integer('jenis_tiket_id')->unsigned();
            $table->timestamps();

            $table->foreign('kode_tiket_id')->references('id')->on('kode_tiket')->ondelete('cascade');
            $table->foreign('peserta_id')->references('id')->on('peserta')->ondelete('cascade');
            $table->foreign('tagihan_peserta_id')->references('id')->on('tagihan_peserta')->ondelete('cascade');
            $table->foreign('jenis_tiket_id')->references('id')->on('jenis_tiket')->ondelete('cascade');

        });

        Schema::create('peserta_program_studi', function(Blueprint $table){
            $table->increments('id');
            $table->integer('peserta_id')->unsigned();
            $table->integer('program_studi_id')->unsigned();
            $table->tinyInteger('urutan');
            $table->timestamps();

            $table->foreign('peserta_id')->references('id')->on('peserta')->ondelete('cascade');
            $table->foreign('program_studi_id')->references('id')->on('program_studi')->ondelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *  Cek Branch Baru
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
