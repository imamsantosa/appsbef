<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisTiket extends Model
{
    protected $table = 'jenis_tiket';
    protected $fillable = ['nama', 'harga', 'kuota'];

    public function sisaTiket(){
        return ($this->kuota) - ($this->hasMany(DataPeserta::class, 'jenis_tiket_id')->count());
    }

    public function harga()
    {
        $angka  = number_format(
            (double)$this->harga,     // parsing bahwa nilai $angka harus angka (double), boleh int atau float
            2,                  // jumlah angka dibelakang koma
            ",",                // pemisah desimal -> 0,00
            "."                 // pemisah ribuan  -> 1.000
        );

        $decimal = '00';

            //kalo tidak pake decimal
        if(trim($decimal) == "") $angka = substr($angka, 0,-3); //buang tiga karakter terakhhir (,00)
        //kalo mau formatnya berakhiran dengan -
        if(trim($decimal) == "-") {
            $angka = substr($angka, 0,-2);  //buang dua karakter terakhir (00)
            $angka = $angka . "-";          // tambahkan karakter strip "-"
        }

        $hasil = "Rp " . $angka;        // tambahkan RP didepan angka


        return $hasil;
    }
}
