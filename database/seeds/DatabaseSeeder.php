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
        
        \App\Kategori::create([
           'nama' => 'saintek'
        ]);

        \App\Kategori::create([
            'nama' => 'Soshum'
        ]);

        \App\Kategori::create([
            'nama' => 'IPC'
        ]);

        \App\StatusPeserta::create([
            'nama' => 'Belum Memesan Tiket'
        ]);

        \App\StatusPeserta::create([
            'nama' => 'Belum Membayar'
        ]);

        \App\StatusPeserta::create([
            'nama' => 'Belum Mengisi Univ'
        ]);

        \App\StatusPeserta::create([
            'nama' => 'Aktif'
        ]);
        
        \App\StatusPembayaran::create([
            'nama' => 'Belum Membayar'
        ]);

        \App\StatusPembayaran::create([
            'nama' => 'Menunggu Verifikasi'
        ]);

        \App\StatusPembayaran::create([
            'nama' => 'Sudah Bayar'
        ]);

        \App\JenisTiket::create([
            'nama' => 'Soshum',
            'harga' => 20000,
            'kuota' => 100
        ]);

        \App\JenisTiket::create([
            'nama' => 'Saintek',
            'harga' => 20000,
            'kuota' => 100
        ]);

        \App\JenisTiket::create([
            'nama' => 'IPC',
            'harga' => 20000,
            'kuota' => 100
        ]);

        \App\JenisTiket::create([
            'nama' => 'EXPO',
            'harga' => 20000,
            'kuota' => 100
        ]);

        \App\JenisTiket::create([
            'nama' => 'On The Spot',
            'harga' => 20000,
            'kuota' => 100
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
