<?php

namespace App\Http\Controllers\panitia;

use App\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Konfigurasi extends Controller
{
    public function index()
    {
        $data = [

            'lokasi_selatan' => Config::find(5)->config,
            'tanggal_selatan' => Config::find(7)->config,

            'jam_simulasi_selatan' => Config::find(10)->config,
            'jam_expo_selatan'=> Config::find(11)->config,

            'lokasi_utara' => Config::find(4)->config,
            'tanggal_utara' => Config::find(6)->config,

            'jam_simulasi_utara' => Config::find(8)->config,
            'jam_expo_utara'=> Config::find(9)->config,
        ];
        return view('panitia/page/konfigurasi', compact('data'));
    }

    public function save(Request $request, $panlok)
    {
        if($panlok == 'selatan'){
            Config::find(5)->update([
                'config' => $request->input('lokasi_selatan')
            ]);

            Config::find(7)->update([
                'config' => $request->input('tanggal_selatan')
            ]);

            Config::find(10)->update([
                'config' => $request->input('jam_simulasi_selatan')
            ]);

            Config::find(11)->update([
                'config' => $request->input('jam_expo_selatan')
            ]);

            return redirect()
                ->route('panitia_konfigurasi')
                ->with([
                    'status' => 'success',
                    'message' => 'Berhasil memperbarui data'
                ]);
        }

        if($panlok == 'utara'){
            Config::find(4)->update([
                'config' => $request->input('lokasi_utara')
            ]);

            Config::find(6)->update([
                'config' => $request->input('tanggal_utara')
            ]);

            Config::find(8)->update([
                'config' => $request->input('jam_simulasi_utara')
            ]);

            Config::find(9)->update([
                'config' => $request->input('jam_expo_utara')
            ]);

            return redirect()
                ->route('panitia_konfigurasi')
                ->with([
                    'status' => 'success',
                    'message' => 'Berhasil memperbarui data'
                ]);
        }

        return redirect()
            ->route('panitia_konfigurasi');
    }
}
