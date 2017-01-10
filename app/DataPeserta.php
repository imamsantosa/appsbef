<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;

class DataPeserta extends Model
{
    protected $table = 'data_peserta';

    protected $fillable = ['peserta_id', 'panlok_id', 'nomor_tiket','jenis_tiket_id','bukti', 'kode_pembayaran', 'total_pembayaran', 'status_pembayaran_id', 'tanggal_konfirmasi', 'panitia_konfirmasi'];

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

    public function nomorTiket()
    {
        switch ($this->jenis_tiket_id){
            case 1:
                $jenis = 'soshum-';
                break;
            case 2:
                $jenis = 'saintek-';
                break;
            case 3:
                $jenis = 'ipc-';
                break;
            case 4:
                $jenis = 'expo-';
                break;
            case 5:
                $jenis = 'OTS-';
                break;
            case 6:
                $jenis = 'soshum-';
                break;
            case 7:
                $jenis = 'saintek-';
                break;
            default:
                $jenis = '-';
                break;
        }
        return strtoupper($jenis) . sprintf("%05d", $this->nomor_tiket);
    }

    public function panlok()
    {
        return $this->belongsTo(Panlok::class, 'panlok_id');
    }

    public function qrCode()
    {
        $qr = [
            'nomor_tiket' => $this->nomorTiket(),
            'id' => $this->id,
        ];
        return "data:image/png;base64,". \DNS2D::getBarcodePNG(json_encode($qr), 'QRCODE',4,4);
    }

    public function qrCodeParam($p, $l)
    {
        $qr = [
            'nomor_tiket' => $this->nomorTiket(),
            'id' => $this->id,
        ];
        return "data:image/png;base64,". \DNS2D::getBarcodePNG(json_encode($qr), 'QRCODE',$p,$l);
    }
}
