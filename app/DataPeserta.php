<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DataPeserta extends Model
{
    protected $table = 'data_peserta';

    protected $fillable = ['peserta_id', 'nomor_tiket','jenis_tiket_id','bukti', 'kode_pembayaran', 'total_pembayaran', 'status_pembayaran_id', 'tanggal_konfirmasi', 'panitia_konfirmasi'];

    public function jenisTiket()
    {
        return $this->belongsTo(JenisTiket::class);
    }

    public function statusPembayaran()
    {
        return $this->belongsTo(StatusPembayaran::class);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
