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
                if($dataPencarian == null || $data->status_peserta_id == 1){
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
            'nomor_tiket' => ($data->nomor_tiket == null)? "-" : $data->nomorTiket(),
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
        if(auth('panitia')->user()->rule_id == 3){
            return "not authorize";
        }

        $data = Peserta::where('username', $request->input('username'))->first();

        if($data == null){
            return "not athorize";
        }

        $data->resetPassword();

        //do anythings
        return "Berhasil mereset password username ".$request->input('username')." menjadi \"123456\"";
    }

    public function buktiPembayaran($id)
    {

        $data = \App\DataPeserta::find($id);
        $filename = $data->bukti;
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


        $ceknomor = \App\DataPeserta::where('jenis_tiket_id', $data->jenis_tiket_id)->where('nomor_tiket', '<>', null)->count();

        if($ceknomor <= 0){
            $nomortiket = 1;
        } else{
            $nomortiket = $ceknomor + 1;
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
        } else {
            $data->peserta->update([
                'status_peserta_id' => 3
            ]);
        }

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

    public function getRekap(Request $request)
    {
        $t = $request->input('t');
        
        if($t == 'fix-utara'){
            return $this->fixUtara();
        } else if($t == 'fix-selatan'){
            return $this->fixSelatan();
        } else if ($t == 'fix-all'){
            return $this->fixAll();
        } else {
            return redirect()->route('panitia_data_peserta_rekap');
        }
        
    }
    
    private function fixUtara()
    {
        \Excel::create('Data Pendaftar Utara per '.date("Y-m-d h:i:s"), function($excel) {
            $excel->sheet('Soshum', function($sheet) {

                $sheet->row(1, [
                    "No",
                    "Nomor Tiket",
                    "Username",
                    "Nama Lengkap",
                    "Asal Sekolah",
                    "Nomor Telepon",
                    "Kode Pembayaran",
                    "Panlok",
                    "Jenis Tiket",
                    "Tanggal Konfirmasi",
                    "Panitia Konfirmasi"
                ]);

                $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 1)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
                $baris = 2;
                $no = 1;
                foreach ($datapeserta as $d){
                    $sheet->row($baris++, [
                        $no++,
                        $d->nomorTiket(),
                        $d->peserta->username,
                        $d->peserta->fullname,
                        $d->peserta->school,
                        $d->peserta->phone,
                        $d->kode_pembayaran,
                        $d->panlok->nama,
                        $d->jenisTiket->nama,
                        $d->tanggal_konfirmasi,
                        $d->panitia_konfirmasi
                    ]);
                }
            });
            $excel->sheet('Saintek', function($sheet) {

                $sheet->row(1, [
                    "No",
                    "Nomor Tiket",
                    "Username",
                    "Nama Lengkap",
                    "Asal Sekolah",
                    "Nomor Telepon",
                    "Kode Pembayaran",
                    "Panlok",
                    "Jenis Tiket",
                    "Tanggal Konfirmasi",
                    "Panitia Konfirmasi"
                ]);

                $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 2)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
                $baris = 2;
                $no = 1;
                foreach ($datapeserta as $d){
                    $sheet->row($baris++, [
                        $no++,
                        $d->nomorTiket(),
                        $d->peserta->username,
                        $d->peserta->fullname,
                        $d->peserta->school,
                        $d->peserta->phone,
                        $d->kode_pembayaran,
                        $d->panlok->nama,
                        $d->jenisTiket->nama,
                        $d->tanggal_konfirmasi,
                        $d->panitia_konfirmasi
                    ]);
                }
            });
            $excel->sheet('IPC', function($sheet) {

                $sheet->row(1, [
                    "No",
                    "Nomor Tiket",
                    "Username",
                    "Nama Lengkap",
                    "Asal Sekolah",
                    "Nomor Telepon",
                    "Kode Pembayaran",
                    "Panlok",
                    "Jenis Tiket",
                    "Tanggal Konfirmasi",
                    "Panitia Konfirmasi"
                ]);

                $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 3)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
                $baris = 2;
                $no = 1;
                foreach ($datapeserta as $d){
                    $sheet->row($baris++, [
                        $no++,
                        $d->nomorTiket(),
                        $d->peserta->username,
                        $d->peserta->fullname,
                        $d->peserta->school,
                        $d->peserta->phone,
                        $d->kode_pembayaran,
                        $d->panlok->nama,
                        $d->jenisTiket->nama,
                        $d->tanggal_konfirmasi,
                        $d->panitia_konfirmasi
                    ]);
                }
            });

            $excel->sheet('Expo', function($sheet) {

                $sheet->row(1, [
                    "No",
                    "Nomor Tiket",
                    "Username",
                    "Nama Lengkap",
                    "Asal Sekolah",
                    "Nomor Telepon",
                    "Kode Pembayaran",
                    "Panlok",
                    "Jenis Tiket",
                    "Tanggal Konfirmasi",
                    "Panitia Konfirmasi"
                ]);

                $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 4)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
                $baris = 2;
                $no = 1;
                foreach ($datapeserta as $d){
                    $sheet->row($baris++, [
                        $no++,
                        $d->nomorTiket(),
                        $d->peserta->username,
                        $d->peserta->fullname,
                        $d->peserta->school,
                        $d->peserta->phone,
                        $d->kode_pembayaran,
                        $d->panlok->nama,
                        $d->jenisTiket->nama,
                        $d->tanggal_konfirmasi,
                        $d->panitia_konfirmasi
                    ]);
                }
            });



        })->export('xlsx');
    }
    
    private function fixSelatan()
    {
        \Excel::create('Data Pendaftar Selatan per '.date("Y-m-d h:i:s"), function($excel) {
            $excel->sheet('Soshum', function($sheet) {

                $sheet->row(1, [
                    "No",
                    "Nomor Tiket",
                    "Username",
                    "Nama Lengkap",
                    "Asal Sekolah",
                    "Nomor Telepon",
                    "Kode Pembayaran",
                    "Panlok",
                    "Jenis Tiket",
                    "Tanggal Konfirmasi",
                    "Panitia Konfirmasi"
                ]);

                $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 6)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
                $baris = 2;
                $no = 1;
                foreach ($datapeserta as $d){
                    $sheet->row($baris++, [
                        $no++,
                        $d->nomorTiket(),
                        $d->peserta->username,
                        $d->peserta->fullname,
                        $d->peserta->school,
                        $d->peserta->phone,
                        $d->kode_pembayaran,
                        $d->panlok->nama,
                        $d->jenisTiket->nama,
                        $d->tanggal_konfirmasi,
                        $d->panitia_konfirmasi
                    ]);
                }
            });
            $excel->sheet('Saintek', function($sheet) {

                $sheet->row(1, [
                    "No",
                    "Nomor Tiket",
                    "Username",
                    "Nama Lengkap",
                    "Asal Sekolah",
                    "Nomor Telepon",
                    "Kode Pembayaran",
                    "Panlok",
                    "Jenis Tiket",
                    "Tanggal Konfirmasi",
                    "Panitia Konfirmasi"
                ]);

                $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 7)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
                $baris = 2;
                $no = 1;
                foreach ($datapeserta as $d){
                    $sheet->row($baris++, [
                        $no++,
                        $d->nomorTiket(),
                        $d->peserta->username,
                        $d->peserta->fullname,
                        $d->peserta->school,
                        $d->peserta->phone,
                        $d->kode_pembayaran,
                        $d->panlok->nama,
                        $d->jenisTiket->nama,
                        $d->tanggal_konfirmasi,
                        $d->panitia_konfirmasi
                    ]);
                }
            });



        })->export('xlsx');
    }
    
    private function fixAll()
    {
        \Excel::create('Data Semua Peserta per '.date("Y-m-d h:i:s"), function($excel) {
            $excel->sheet('Semua', function($sheet) {

                $sheet->row(1, [
                    "No",
                    "Username",
                    "Nama Lengkap",
                    "Asal Sekolah",
                    "Nomor Telepon",
                    "Status Peserta",
                    "Kode Pembayaran",
                    "Status Pembayaran",
                    "Panlok",
                    "Nomor Tiket",
                    "Jenis Tiket",
                    "Tanggal Konfirmasi",
                    "Panitia Konfirmasi"
                ]);

                $peserta = Peserta::all();
                $baris = 2;
                $no = 1;
                foreach ($peserta as $d){
                    $sheet->row($baris++, [
                        $no++,
                        $d->username,
                        $d->fullname,
                        $d->school,
                        $d->phone,
                        $d->statusPeserta->nama,
                        ($d->dataPeserta != null)? $d->dataPeserta->kode_pembayaran : "-",
                        ($d->dataPeserta != null)? $d->dataPeserta->statusPembayaran->nama : "-",
                        ($d->dataPeserta != null)? $d->dataPeserta->panlok->nama : "-",
                        ($d->dataPeserta != null)? $d->dataPeserta->nomorTiket() : "-",
                        ($d->dataPeserta != null)? $d->dataPeserta->jenisTiket->nama : "-",
                        ($d->dataPeserta != null)? $d->dataPeserta->tanggal_konfirmasi : "-",
                        ($d->dataPeserta != null)? $d->dataPeserta->panitia_konfirmasi : "-",
                    ]);
                }
            });



        })->export('xlsx');
    }

    public function kartuMeja(Request $request)
    {
        $t = $request->input('t');

        if($t == 'soshum-utara'){
            $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 1)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
        } else if($t == 'saintek-utara'){
            $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 2)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
        } else if($t == 'ipc-utara'){
            $datapeserta = \App\DataPeserta::where('jenis_tiket_id', 2)->where('nomor_tiket', '<>', null)->orderBy('nomor_tiket', 'asc')->get();
        } else {
            return redirect()->route('panitia_data_peserta_rekap');
        }

        return view('panitia/page/kartu_meja', compact('datapeserta'));
    }
}
