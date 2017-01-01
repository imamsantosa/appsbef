<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['uses' => 'Index@index', 'as' => 'index']);

Route::group(['namespace' => 'peserta'], function(){
    Route::post('auth/register', ['uses' => 'AuthenticactionPeserta@register', 'as' => 'peserta_register']);
    Route::post('auth/login', ['uses' => 'AuthenticactionPeserta@login', 'as' => 'peserta_login']);
    Route::get('auth/logout', ['uses' => 'AuthenticactionPeserta@logout', 'as' => 'peserta_logout']);

    Route::group(['middleware' => ['auth.peserta']], function(){
        Route::get('profile-image', ['uses' => 'Peserta@PhotoProfile', 'as' => 'peserta_photo_profile']);

        Route::get('daftar/pilih-tiket', ['uses' => 'Pendaftaran@PilihTiket', 'as' => 'peserta_pilih_tiket']);
        Route::post('daftar/pilih-tiket', ['uses' => 'Pendaftaran@PilihTiketProses', 'as'=>'peserta_pilih_tiket_proses']);

        Route::get('daftar/pilih-tiket/konfirmasi', ['uses' => 'Pendaftaran@konfirmasiTiket', 'as' => 'peserta_konfirmasi_tiket']);
        Route::get('daftar/pilih-tiket/konfirmasi-tiket', ['uses' => 'Pendaftaran@konfirmasiTiketProses', 'as' => 'peserta_konfirmasi_tiket_proses']);

        Route::get('daftar/konfirmasi-pembayaran', ['uses' => 'Pendaftaran@konfirmasiPembayaran', 'as' => 'peserta_konfirmasi_pembayaran']);
        Route::post('daftar/konfirmasi-pembayaran', ['uses' => 'Pendaftaran@konfirmasiPembayaranProses', 'as' => 'peserta_konfirmasi_pembayaran_proses']);
        Route::get('daftar/konfirmasi-pembayaran/bukti/{url}', ['uses' => 'Pendaftaran@buktiPembayaranImage', 'as' => 'peserta_bukti_pembayaran_image']);


        Route::get('home', ['uses' => 'Peserta@home', 'as' => 'peserta_home', 'middleware' => ['peserta.aktif']]);
    });



});
