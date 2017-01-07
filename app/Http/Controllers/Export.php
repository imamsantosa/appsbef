<?php

namespace App\Http\Controllers;

use App\DataPeserta;
use App\ProgramStudi;
use App\Universitas;
use Illuminate\Http\Request;

use App\Http\Requests;

class Export extends Controller
{
    public function index()
    {
        $gen = 'B0562';
        $cek = DataPeserta::where('kode_pembayaran', $gen)->count();
        dd($cek);

        return view('export');
    }

    public function process(Request $request)
    {
        ini_set('max_execution_time', 3600);

        $nama_folder = public_path() . '/csv/';
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $ext = $file->guessClientExtension();
        $size = $file->getClientSize();


        $fulldir = $nama_folder . $name;
        $file->move($nama_folder, $name);

        $csv = new parseCSV($fulldir);

        foreach ($csv->data as $item) {

            $univ = Universitas::where('nama', $item['UNIVERSITAS'])->first();

            if($univ == null){
                $univ = Universitas::create([
                    'nama' => $item['UNIVERSITAS'],
                    'kode' => '-'
                ]);
            }

            $prodi = ProgramStudi::create([
                'kode' => $item['KODE'],
                'nama' => $item['PROGRAMSTUDI'],
                'universitas_id' => $univ->id,
                'kategori_id' => $item['JURUSAN']
            ]);

        }

        unlink($fulldir);

        return "ok";
    }
}
