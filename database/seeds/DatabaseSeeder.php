<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
//        \App\Kategori::create([
//           'nama' => 'saintek'
//        ]);
//
//        \App\Kategori::create([
//            'nama' => 'Soshum'
//        ]);
//
//        \App\Kategori::create([
//            'nama' => 'IPC'
//        ]);
//
//        \App\StatusPeserta::create([
//            'nama' => 'Belum Memesan Tiket'
//        ]);
//
//        \App\StatusPeserta::create([
//            'nama' => 'Belum Membayar'
//        ]);
//
//        \App\StatusPeserta::create([
//            'nama' => 'Belum Mengisi Univ'
//        ]);
//
//        \App\StatusPeserta::create([
//            'nama' => 'Aktif'
//        ]);
//
//        \App\StatusPembayaran::create([
//            'nama' => 'Belum Membayar'
//        ]);
//
//        \App\StatusPembayaran::create([
//            'nama' => 'Menunggu Verifikasi'
//        ]);
//
//        \App\StatusPembayaran::create([
//            'nama' => 'Sudah Bayar'
//        ]);
//
//        \App\JenisTiket::create([
//            'nama' => 'Soshum',
//            'harga' => 20000,
//            'kuota' => 100
//        ]);
//
//        \App\JenisTiket::create([
//            'nama' => 'Saintek',
//            'harga' => 20000,
//            'kuota' => 100
//        ]);
//
//        \App\JenisTiket::create([
//            'nama' => 'IPC',
//            'harga' => 20000,
//            'kuota' => 100
//        ]);
//
//        \App\JenisTiket::create([
//            'nama' => 'EXPO',
//            'harga' => 20000,
//            'kuota' => 100
//        ]);
//
//        \App\JenisTiket::create([
//            'nama' => 'On The Spot',
//            'harga' => 20000,
//            'kuota' => 100
//        ]);

//        \App\Config::create([
//            'nama' => 'registrasi',
//            'config' => 'open'
//        ]);
//
//        $role = ['Super Admin', 'Pusat Data dan informasi', 'Panitia Biasa'];
//
//        for($i=0;$i < count($role); $i++){
//            \App\RolePanitia::create([
//                'nama' => $role[$i]
//            ]);
//        }

        \App\Panitia::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'fullname' => 'imamsantosa',
            'nomor_telepon' => '085786267752',
            'role_id' => 1
        ]);


        // $this->call(UsersTableSeeder::class);
    }
}
