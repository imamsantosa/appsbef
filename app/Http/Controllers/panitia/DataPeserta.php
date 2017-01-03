<?php

namespace App\Http\Controllers\panitia;

use App\Peserta;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DataPeserta extends Controller
{
    public function aktif()
    {
        return view('panitia/page/peserta_aktif');
    }

    public function verifikasi(Request $request)
    {
        $dataPencarian = null;
        $errormessage = null;
        if($request->input('kode') != null || $request->input('kode') == ""){
            $dataPencarian = \App\DataPeserta::where('kode_pembayaran', $request->input('kode'))->first();
        }

        if($dataPencarian == null){
            $data = Peserta::where('username', $request->input('username'))->first();
            if($data != null){
                $dataPencarian = \App\DataPeserta::where('peserta_id', $data->id)->first();
                if($dataPencarian == null){
                    $errormessage = "Peserta belum memilih tiketnya";
                }
            }
        }

        $dataverifikasi = \App\DataPeserta::where('status_pembayaran_id', 2)->get();
        return view('panitia/page/peserta_verifikasi', compact('dataPencarian', 'errormessage', 'dataverifikasi'));
    }

    public function dataAll()
    {
        $data = Peserta::all();

        $response = [];
        $response['data'] = $data->map(function($g) {
            return [
                'id' => $g->id,
                'username' => $g->username,
                'nama_lengkap' => $g->fullname,
                'nomor_telepon' => $g->phone,
                'asal_sekolah' => $g->school,
                'status_peserta' => $g->status_peserta_id,
                'status_peserta_text' => $g->statusPeserta->nama,
                'data' => $this->dataPeserta($g->id)

            ];
        });

        return response()->json($response);
    }

    private function dataPeserta($id)
    {
        $data = \App\DataPeserta::where('peserta_id', $id)->first();

        if($data == null){
            return [];
        }

        return [
            'nomor_tiket' => ($data->nomor_tiket == null)? "-" : $data->nomor_tiket,
            'kode_pembayaran' => $data->kode_pembayaran,
            'jenis_tiket' => $data->jenisTiket->nama,
            'panlok' => $data->panlok->nama,
            'status_pembayaran' => $data->statusPembayaran->nama,
            'tanggal_konfirmasi' => $data->tanggal_konfirmasi,
            'panitia_konfirmasi' => $data->panitia_konfirmasi
        ];
    }

    public function resetPassword(Request $request)
    {
        //do anythings
        return "Berhasil mereset password username ".$request->input('username')." menjadi \"123456\"";
    }

    public function buktiPembayaran($filename)
    {
        $pathimage = 'bukti_pembayaran/'.$filename;

        return response(Storage::get($pathimage), 200)->header('Content-Type', 'image/jpeg');
    }

    public function verifikasiProses($kode)
    {
        $data = \App\DataPeserta::where('kode_pembayaran', $kode)->first();

        if($data == null){
            return redirect()
                ->route('panitia_data_peserta_verifikasi',['kode' => $kode, 'username' =>'']);
        }

        if(auth('panitia')->user()->rule_id == 3)
        {
            return redirect()
                ->route('panitia_home');
        }

        if($data->peserta->status_peserta_id == 3 || $data->peserta->status_peserta_id == 4){
            return redirect()
            ->route('panitia_data_peserta_verifikasi',['kode' => $kode, 'username' =>''])
            ->with([
                'status' => 'warning',
                'message' => 'peserta dengan username '.$data->peserta->username.' sudah diverifikasi oleh '.$data->panitia_konfirmasi
            ]);
        }


        $ceknomor = \App\DataPeserta::where('jenis_tiket_id', $data->jenis_tiket_id)->orderBy('nomor_tiket', 'desc')->first();

        if($ceknomor->nomor_tiket == null){
            $nomortiket = 1;
        } else{
            $nomortiket = $ceknomor->nomor_tiket + 1;
        }

        $data->update([
            'panitia_konfirmasi' => auth('panitia')->user()->fullname,
            'tanggal_konfirmasi' => date('Y-m-d h:i:s'),
            'status_pembayaran_id' => 3,
            'nomor_tiket' => $nomortiket
        ]);

        if($data->jenis_tiket_id == 4){
            $data->peserta->update([
                'status_peserta_id' => 4
            ]);
        }

        $data->peserta->update([
            'status_peserta_id' => 3
        ]);

        return redirect()
            ->route('panitia_data_peserta_verifikasi',['kode' => $kode, 'username' =>''])
            ->with([
                'status' => 'success',
                'message' => 'Berhasil memverifikasi pembayaran dengan username '.$data->peserta->username
            ]);
    }

    public function rekap()
    {
        return view('panitia/page/rekap');
    }
}
