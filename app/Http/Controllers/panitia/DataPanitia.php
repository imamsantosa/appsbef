<?php

namespace App\Http\Controllers\panitia;

use App\Panitia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataPanitia extends Controller
{
    public function dataAll()
    {
        $data = Panitia::all();

        $response = [];
        $response['data'] = $data->map(function($g) {
            return [
                'id' => $g->id,
                'username' => $g->username,
                'nama_lengkap' => $g->fullname,
                'nomor_telepon' => $g->nomor_telepon,
                'panlok' => $g->panlok->nama,
                'posisi_id' => $g->role_id,
                'posisi' => $g->role->nama,

            ];
        });

        return response()->json($response);
    }

    public function all()
    {
        return view('panitia/page/panitia_all');
    }

    public function create()
    {
        if(auth('panitia')->user()->role_id == 3){
            return redirect()
                ->route('panitia_data_panitia_semua');
        }

        return view('panitia/page/panitia_create');
    }

    public function createProses(Request $request)
    {
        if(auth('panitia')->user()->role_id == 3){
            return redirect()
                ->route('panitia_data_panitia_semua');
        }

        $secret_key = '6LdPMhAUAAAAACt--s1jFerJZwhhIYwa88tdz8hM';

        $captcha = $request->input('g-recaptcha-response');
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
        $recaptcha = file_get_contents($url);
        $recaptcha = json_decode($recaptcha, true);
        if (!$recaptcha['success']) {
            return redirect()
                ->route('panitia_data_panitia_create')
                ->with([
                    'status' => 'danger',
                    'message' => 'Terjadi Kesalahan. Silahkan isi data dan klik pastikan anda bukan robot!'
                ]);
        }

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'fullname' => 'required',
            'nomor_telepon' => 'required',
            'panlok' => 'required',
            'posisi' => 'required'
        ],[
            'required' => ':attribute harus diisi.',
        ]);

        $cek = Panitia::where('username', $request->input('username'))->count();

        if($cek >= 1){
            return redirect()
                ->route('panitia_data_panitia_semua')
                ->with([
                    'status' => 'danger',
                    'message' => 'Username Telah Digunakan.'
                ]);
        }

        if($request->input('panlok') > 2 || $request->input('panlok') < 1 || $request->input('posisi') < 1 || $request->input('posisi') > 3){
            return redirect()
                ->route('panitia_data_panitia_semua');
        }

        $newdata = Panitia::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('username')),
            'fullname' => $request->input('fullname'),
            'nomor_telepon' => $request->input('nomor_telepon'),
            'panlok_id' => $request->input('panlok'),
            'role_id' => $request->input('posisi'),
        ]);


        return redirect()
            ->route('panitia_data_panitia_semua')
            ->with([
                'status' => 'success',
                'message' => 'Berhasil menambahkan panitia baru.'
            ]);
    }

    public function deletePanitia(Request $request)
    {
        if(auth('panitia')->user()->role_id == 3){
            return "not authorize";
        }

        $data = Panitia::where('username', $request->input('username'))->first();

        if($data == null || $data->role_id == 1){
            return "not authorize";
        }

        $data->delete();

        return "sukses menghapus panitia dengan username ".$data->username;
    }

    public function resetPassword(Request $request)
    {
        if(auth('panitia')->user()->rule_id == 3){
            return "not authorize";
        }

        $data = Panitia::where('username', $request->input('username'))->first();

        if($data == null || $data->role_id == 1){
            return "not athorize";
        }

        $data->resetPassword();

        return "Berhasil mereset password username ".$request->input('username')." menjadi \"123456\"";

    }
}
