<?php

namespace App\Http\Controllers\Peserta;

use App\Panlok;
use App\PesertaProgramStudi;
use App\ProgramStudi;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\DataPeserta;
use App\JenisTiket;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Pendaftaran extends Controller
{
    public function PilihTiket()
    {
        if(auth('peserta')->user()->status_peserta_id != 1){
            return redirect()
                ->route('peserta_home');
        }

        $jenisTiket = JenisTiket::where('nama', '<>', 'On The Spot')->get();
        $panlok = Panlok::all();
        return View('peserta/page/pilih_tiket', compact('jenisTiket', 'panlok'));
    }

    public function getTiket(Request $request)
    {
        $idpanlok = $request->input('panlok');

        $panlok = Panlok::find($idpanlok);

        if($panlok == null){
            return "unauthorize";
        }

        $datas = JenisTiket::where('panlok_id', $idpanlok)
            ->where('id', '<>', 5)
            ->get();

        $response = [];
        $response['options'] = $datas->map(function($data) {
            return [
                'value' => $data->id,
                'text' => $data->nama .' - '. $data->harga(),
            ];
        });

        return response()->json($response);
    }

    public function pilihTiketProses(Request $request)
    {
        if(auth('peserta')->user()->status_peserta_id != 1){
            return redirect()
                ->route('peserta_home');
        }

        $jenisTiket = JenisTiket::find($request->input('jenis_tiket'));
        $panlok = Panlok::find($request->input('panlok'));

        if($jenisTiket == null || $panlok == null){
            return redirect()
                ->route('peserta_pilih_tiket');
        }

        $dataPeserta = DataPeserta::where('peserta_id', auth('peserta')->user()->id)->get();
        if($dataPeserta->count() == 0){
            $newData = DataPeserta::create([
                'peserta_id' => auth('peserta')->user()->id,
                'kode_pembayaran' => $this->generateKodePembayaran($jenisTiket->id),
                'total_pembayaran' => $jenisTiket->harga,
                'jenis_tiket_id' => $jenisTiket->id,
                'panlok_id' => $panlok->id,
                'status_pembayaran_id' => 1

            ]);
        } else {
            $dataPeserta->first()->update([
                'kode_pembayaran' => $this->generateKodePembayaran($jenisTiket->id),
                'total_pembayaran' => $jenisTiket->harga,
                'jenis_tiket_id' => $jenisTiket->id,
                'panlok_id' => $panlok->id,
                'status_pembayaran_id' => 1
            ]);
        }

        return redirect()
            ->route('peserta_konfirmasi_tiket');
    }

    private function generateKodePembayaran($jenis)
    {
        $k = '';
        if($jenis == 1)
            $k = 'A';
        else if($jenis == 2)
            $k = 'B';
        else if($jenis == 3)
            $k = 'C';
        else if($jenis == 4)
            $k = 'D';
        else if($jenis == 5)
            $k = 'E';
        else if($jenis == 6)
            $k = 'F';
        else if($jenis == 7)
            $k = 'G';

        $gen = $k.date('d').rand(0, 100);
        $cek = DataPeserta::where('kode_pembayaran', $gen)->count();
        if($cek > 1 ) return $this->generateKodePembayaran($jenis);
        else return $gen;
    }

    public function konfirmasiTiket()
    {
        if(auth('peserta')->user()->status_peserta_id != 1){
            return redirect()
                ->route('peserta_home');
        }

        $data = DataPeserta::where('peserta_id', auth('peserta')->user()->id)->get();

        if($data->count() == 0)
            return redirect()->route('peserta_pilih_tiket');

        $data = $data->first();
        
        return view('peserta/page/konfirmasi_tiket', compact('data'));
    }

    public function konfirmasiTiketProses()
    {
        $data = DataPeserta::where('peserta_id', auth('peserta')->user()->id)->get();

        if($data->count() == 0)
            return redirect()->route('peserta_home');

        if(auth('peserta')->user()->status_peserta_id != 1){
            return redirect()
                ->route('peserta_home');
        }

        auth('peserta')->user()->update([
            'status_peserta_id' => 2
        ]);

        return redirect()
            ->route('peserta_home');
    }

    public function konfirmasiPembayaran()
    {
        if(auth('peserta')->user()->status_peserta_id != 2){
            return redirect()
                ->route('peserta_home');
        }

        $data = DataPeserta::where('peserta_id', auth('peserta')->user()->id)->first();
        if($data == null)
            return redirect()->route('peserta_pilih_tiket');

        return view('peserta/page/konfirmasi_pembayaran', compact('data'));
    }

    public function konfirmasiPembayaranProses(Request $request)
    {
        if(auth('peserta')->user()->status_peserta_id != 2){
            return redirect()
                ->route('peserta_home');
        }

        $validation = Validator::make($request->all(), [
            'bukti' => 'required|max:200|mimes:jpeg,jpg,png'
        ]);

        if($validation->fails()){
            return redirect()
                ->route('peserta_konfirmasi_pembayaran')
                ->with([
                    'status-upload' => 'danger',
                    'message' => 'Terjadi kesalahan. File yang anda upload tidak sesuai dengan ketentuan'
                ]);
        }

//        dd($request->file('bukti'));

        $filename = md5(auth('peserta')->user()->id.date('Y-m-d h:i:s').'bukti').'.'.$request->file('bukti')->getClientOriginalExtension();

        Storage::put(
            'bukti_pembayaran/'.$filename,
            file_get_contents($request->file('bukti')->getRealPath())
        );

        $data = DataPeserta::where('peserta_id', auth('peserta')->user()->id)->first();
        if($data == null) return redirect()->route('peserta_home');

        if($data->bukti != null) {
            Storage::delete('bukti_pembayaran/'.$data->bukti);
        }

        $data->update([
            'status_pembayaran_id' => 2,
            'bukti' => $filename
        ]);

        return redirect()
            ->route('peserta_konfirmasi_pembayaran')
            ->with([
                'status-upload' => 'success',
                'message' => 'Bukti pembayaran berhasil terunggah. Silahkan tunggu dalam waktu maksimal 2 X 24 jam untuk panitia menverifikasi pembayaran anda'
            ]);

    }
    
    public function buktiPembayaranImage($url)
    {
        $pathimage = 'bukti_pembayaran/'.$url;

        return response(Storage::get($pathimage), 200)->header('Content-Type', 'image/jpeg');
    }

    public function getProdi(Request $request)
    {
        $iduniv = $request->input('univ');
        $jenisTiket = auth('peserta')->user()->dataPeserta->jenis_tiket_id;

        if($jenisTiket == 1 || $jenisTiket == 6){
            $datas = ProgramStudi::where(['universitas_id'=> $iduniv, 'kategori_id' => 2])->get();
        } else if($jenisTiket == 2 || $jenisTiket == 7)
        {
            $datas = ProgramStudi::where(['universitas_id'=> $iduniv, 'kategori_id' => 1])->get();
        } else {
            $datas = ProgramStudi::where(['universitas_id'=> $iduniv])->get();

        }

        $response = [];
        $response['options'] = $datas->map(function($data) {
            return [
                'value' => $data->id,
                'text' => $data->kode .' - '. $data->nama,
            ];
        });

        return response()->json($response);
    }

    public function pilihUnivProses(Request $request)
    {

        $univ = $request->input('univ');
        $prodi = $request->input('jurusan');

        if($univ[1] == '-'){
            return redirect()
                ->route('peserta_home');
        }

        for($i=1; $i<=3; $i++){
            if($univ[$i] != '-'){
                PesertaProgramStudi::create([
                    'peserta_id' => auth('peserta')->user()->id,
                    'program_studi_id' => $prodi[$i],
                    'urutan' => $i,
                ]);
            }
        }

        auth('peserta')->user()->update([
            'status_peserta_id' => 4
        ]);

        return redirect()
            ->route('peserta_home')
            ->with([
                'status' => 'success',
                'message' => 'Berhasil Menyimpan universitas'
            ]);

    }
}
