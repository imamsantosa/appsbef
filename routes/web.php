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

Route::group(['namespace' => 'Peserta'], function(){
    Route::post('auth/register', ['uses' => 'AuthenticactionPeserta@register', 'as' => 'peserta_register']);
    Route::post('auth/login', ['uses' => 'AuthenticactionPeserta@login', 'as' => 'peserta_login']);
    Route::get('auth/logout', ['uses' => 'AuthenticactionPeserta@logout', 'as' => 'peserta_logout']);

    Route::group(['middleware' => ['auth.peserta']], function(){
        Route::get('profile-image', ['uses' => 'Peserta@PhotoProfile', 'as' => 'peserta_photo_profile']);

        Route::get('daftar/pilih-tiket', ['uses' => 'Pendaftaran@PilihTiket', 'as' => 'peserta_pilih_tiket']);
        Route::post('daftar/pilih-tiket', ['uses' => 'Pendaftaran@PilihTiketProses', 'as'=>'peserta_pilih_tiket_proses']);
        Route::post('daftar/get-tiket', ['uses' => 'Pendaftaran@getTiket', 'as' => 'peserta_get_tiket']);

        Route::get('daftar/pilih-tiket/konfirmasi', ['uses' => 'Pendaftaran@konfirmasiTiket', 'as' => 'peserta_konfirmasi_tiket']);
        Route::get('daftar/pilih-tiket/konfirmasi-tiket', ['uses' => 'Pendaftaran@konfirmasiTiketProses', 'as' => 'peserta_konfirmasi_tiket_proses']);

        Route::get('daftar/konfirmasi-pembayaran', ['uses' => 'Pendaftaran@konfirmasiPembayaran', 'as' => 'peserta_konfirmasi_pembayaran']);
        Route::post('daftar/konfirmasi-pembayaran', ['uses' => 'Pendaftaran@konfirmasiPembayaranProses', 'as' => 'peserta_konfirmasi_pembayaran_proses']);
        Route::get('daftar/konfirmasi-pembayaran/bukti/{url}', ['uses' => 'Pendaftaran@buktiPembayaranImage', 'as' => 'peserta_bukti_pembayaran_image']);

        Route::get('upload-foto', ['uses' => 'Peserta@uploadFoto', 'as' => 'peserta_upload_foto']);
        Route::post('upload-foto', ['uses' => 'Peserta@uploadFotoProses', 'as' => 'peserta_upload_foto_proses']);

//        Route::get('pilih-univ', ['uses' => 'Pendaftaran@pilihUniv', 'as' => 'peserta_pilih_univ']);
        Route::post('pilih-univ-proses', ['uses' => 'Pendaftaran@pilihUnivProses', 'as' => 'peserta_pilih_univ_proses']);
        Route::post('get-prodi', ['uses' => 'Pendaftaran@getProdi', 'as' => 'peserta_pilih_prodi']);


        Route::get('profile', ['uses' => 'Peserta@profile', 'as' => 'peserta_profile']);
        Route::post('profile/upload-foto', ['uses' => 'Peserta@uploadFotoProses', 'as' => 'peserta_upload_foto_proses']);
        Route::post('profile/update-biodata', ['uses' => 'Peserta@updateBiodata', 'as' => 'peserta_update_biodata']);
        Route::post('profile/ganti-password', ['uses' => 'Peserta@changePassword', 'as' => 'peserta_ganti_password']);


        //aktif
        Route::get('cetak-tiket', ['uses' => 'Peserta@cetakTiket', 'as' => 'peserta_cetak_tiket', 'middleware' => ['peserta.aktif']]);
        Route::get('home', ['uses' => 'Peserta@home', 'as' => 'peserta_home', 'middleware' => ['peserta.aktif']]);
    });



});

Route::group(['namespace' => 'panitia', 'prefix' => 'panitia'], function(){
    Route::get('auth/login', ['uses' => 'AuthenticationPanitia@login', 'as' => 'panitia_login']);
    Route::post('auth/login', ['uses' => 'AuthenticationPanitia@loginProses', 'as' => 'panitia_login_proses']);
    Route::get('auth/logout', ['uses' => 'AuthenticationPanitia@logout', 'as' => 'panitia_logout']);

    Route::group(['middleware' => 'auth.panitia'], function(){
        Route::get('photo-profil', ['uses'=>'Panitia@photoProfile', 'as' => 'panitia_photo_profile']);
        Route::get('/', ['uses' => 'Panitia@home', 'as' => 'panitia_home']);

        //route data-peserta
        Route::get('data-peserta/all', ['uses' => 'DataPeserta@aktif', 'as' => 'panitia_data_peserta_aktif']);
        Route::get('data-peserta/verifikasi', ['uses' => 'DataPeserta@verifikasi', 'as' => 'panitia_data_peserta_verifikasi', 'middleware' => ['panitia.admin']]);
        Route::get('data-peserta/rekap', ['uses' => 'DataPeserta@rekap', 'as' => 'panitia_data_peserta_rekap', 'middleware' => ['panitia.admin']]);

        //route data panitia
        Route::get('data-panitia/all', ['uses' => 'DataPanitia@all', 'as' => 'panitia_data_panitia_semua']);
        Route::get('data-panitia/create', ['uses' => 'DataPanitia@create', 'as' => 'panitia_data_panitia_create', 'middleware' => ['panitia.admin']]);
        Route::post('data-panitia/create-proses', ['uses' => 'DataPanitia@createProses', 'as' => 'panitia_data_panitia_create_proses']);

        Route::get('bukti-pembayaran/{filename}', ['uses' => 'DataPeserta@buktiPembayaran', 'as' => 'panitia_data_peserta_bukti']);
        Route::get('konfirmasi-pembayaran/{kode}', ['uses' => 'DataPeserta@verifikasiProses', 'as' => 'panitia_konfirmasi_peserta_proses']);


        Route::post('reset-password-peserta', ['uses' => 'DataPeserta@resetPassword', 'as' => 'panitia_reset_password_peserta']);
        Route::post('reset-password-panitia', ['uses' => 'DataPanitia@resetPassword', 'as' => 'panitia_reset_password_panitia']);
        Route::post('delete-panitia', ['uses' => 'DataPanitia@deletePanitia', 'as' => 'panitia_delete_panitia']);

        Route::get('profile', ['uses' => 'Panitia@profile', 'as' => 'panitia_profile']);
        Route::post('profile/upload-foto', ['uses' => 'Panitia@uploadFoto', 'as' => 'panitia_upload_foto']);
        Route::post('profile/update-biodata', ['uses' => 'Panitia@updateBiodata', 'as' => 'panitia_update_biodata']);
        Route::post('profile/ganti-password', ['uses' => 'Panitia@changePassword', 'as' => 'panitia_ganti_password']);
        
        
        Route::get('data-expo', ['uses' => 'DataExpo@index', 'as' => 'panitia_data_expo']);
        Route::get('data-expo/create', ['uses' => 'DataExpo@create', 'as' => 'panitia_data_expo_create', 'middleware' => ['panitia.admin']]);
        Route::post('data-expo/create', ['uses' => 'DataExpo@createProcess', 'as' => 'panitia_data_expo_create_process', 'middleware' => ['panitia.admin']]);
        Route::get('data-expo/edit/{id}', ['uses' => 'DataExpo@edit', 'as' => 'panitia_data_expo_edit']);
        Route::post('data-expo/edit/{id}', ['uses' => 'DataExpo@editProcess', 'as' => 'panitia_data_expo_edit_process']);
        Route::post('data-expo/delete', ['uses' => 'DataExpo@delete', 'as' => 'panitia_data_expo_delete']);

        Route::get('konfigurasi', ['uses' => 'Konfigurasi@index', 'as' => 'panitia_konfigurasi']);
        Route::post('konfigurasi/save/{panlok}', ['uses' => 'Konfigurasi@save', 'as' => 'panitia_konfigurasi_save']);

        //api
        Route::post('data-peserta/list-data', ['uses' => 'DataPeserta@dataAll', 'as' => 'panitia_data_peserta_all']);
        Route::post('data-panitia/list-data', ['uses' => 'DataPanitia@dataAll', 'as' => 'panitia_data_panitia_all']);
        Route::post('data-expo/list-data', ['uses' => 'DataExpo@dataAll', 'as' => 'panitia_data_expo_all']);
    });
});


//Route::get('export', ['uses' => 'Export@index']);
//Route::post('export/upload', ['uses' => 'Export@process', 'as' => 'ExportProcess']);