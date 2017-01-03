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
            'nama' => 'Simulasi Soshum',
            'harga' => 20000,
            'kuota' => 100
        ]);

        \App\JenisTiket::create([
            'nama' => 'Simulasi Saintek',
            'harga' => 20000,
            'kuota' => 100
        ]);

        \App\JenisTiket::create([
            'nama' => 'Simulasi IPC',
            'harga' => 25000,
            'kuota' => 100
        ]);

        \App\JenisTiket::create([
            'nama' => 'EXPO',
            'harga' => 15000,
            'kuota' => 100
        ]);

        \App\Panlok::create([
            'nama' => 'utara',
        ]);

        \App\Panlok::create([
            'nama' => 'selatan'
        ]);

        \App\JenisTiket::create([
            'nama' => 'On The Spot',
            'harga' => 20000,
            'kuota' => 100
        ]);

        \App\Config::create([
            'nama' => 'registrasi',
            'config' => 'open'
        ]);

        \App\Config::create([
            'nama' => 'registrasi_utara',
            'config' => 'open'
        ]);

        \App\Config::create([
            'nama' => 'registrasi_selatan',
            'config' => 'open'
        ]);

        \App\Config::create([
            'nama' => 'lokasi_utara',
            'config' => 'Brebes'
        ]);

        \App\Config::create([
            'nama' => 'lokasi_selatan',
            'config' => 'bumiayu'
        ]);

        \App\Config::create([
            'nama' => 'tanggal_utara',
            'config' => '17 Agustus 45'
        ]);

        \App\Config::create([
            'nama' => 'tanggal_selatan',
            'config' => '17 Agustus 45 selatan'
        ]);

        \App\Config::create([
            'nama' => 'jam_utara_simulasi',
            'config' => 'sampai selesai'
        ]);

        \App\Config::create([
            'nama' => 'jam_utara_expo',
            'config' => 'sampai selesai'
        ]);

        \App\Config::create([
            'nama' => 'jam_selatan_simulasi',
            'config' => 'sampai selesai'
        ]);

        \App\Config::create([
            'nama' => 'jam_selatan_expo',
            'config' => 'sampai selesai'
        ]);

        $role = ['Super Admin', 'Pusat Data dan informasi', 'Panitia Biasa'];

        for($i=0;$i < count($role); $i++){
            \App\RolePanitia::create([
                'nama' => $role[$i]
            ]);
        }

        \App\Panitia::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'fullname' => 'imamsantosa',
            'nomor_telepon' => '085786267752',
            'panlok_id' => 1,
            'role_id' => 1
        ]);


        \App\Panitia::create([
            'username' => 'pusdatinutara',
            'password' => bcrypt('pusdatinutara'),
            'fullname' => 'pusdatinutara',
            'nomor_telepon' => '-',
            'panlok_id' => 1,
            'role_id' => 2
        ]);

        \App\Panitia::create([
            'username' => 'pusdatinselatan',
            'password' => bcrypt('pusdatinselatan'),
            'fullname' => 'pusdatinselatan',
            'nomor_telepon' => '-',
            'panlok_id' => 2,
            'role_id' => 2
        ]);


        // $this->call(UsersTableSeeder::class);
    }
}
