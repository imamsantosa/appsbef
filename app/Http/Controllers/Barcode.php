<?php

namespace App\Http\Controllers;

use App\DataPeserta;
use App\Kehadiran;
use Illuminate\Http\Request;

use App\Http\Requests;

class Barcode extends Controller
{

    public function scan()
    {
        return view('scan');
    }

    public function process(Request $request)
    {
        $input = $request->input('q');

        $data = json_decode($input, true);
        $id = $data['id'];
//         dd($data['id']);



        $simpan = Kehadiran::firstOrNew([
            'data_peserta_id' => $id
        ]);

        $simpan->fill([
            'kehadiran' => 'hadir'.rand(0,1000)
        ]);

        $simpan->save();

        $getdata = DataPeserta::find($id);
        
        $hasil = [
            'nama' => $getdata->peserta->fullname,
            'asal_sekolah' => $getdata->peserta->school,
            'nomor' => $getdata->nomorTiket(),
            'foto' => route('panitia_photo_peserta', ['id' => $getdata->peserta->id])
        ];

        return response()->json($hasil);
    }
}
