<?php

namespace App\Http\Controllers\panitia;

use App\DataPeserta;
use App\Expo;
use Validator;
use App\Config;
use App\Peserta;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Panitia extends Controller
{
    public function home()
    {
        $data = [
            'peserta_utara' => DataPeserta::where('panlok_id', 1)->count(),
            'peserta_selatan' => DataPeserta::where('panlok_id', 2)->count(),

            'panitia_utara' => \App\Panitia::where('panlok_id', 1)->count(),
            'panitia_selatan' => \App\Panitia::where('panlok_id', 2)->count(),
            'expo_utara' => Expo::where('utara', 1)->count(),
            'expo_selatan' => Expo::where('selatan', 1)->count(),

            'saintek_utara' => DataPeserta::where(['jenis_tiket_id' => 2,'panlok_id'=> 1])->count(),
            'saintek_selatan' => DataPeserta::where(['jenis_tiket_id'=> 2,'panlok_id'=> 2])->count(),
            'soshum_utara' => DataPeserta::where(['jenis_tiket_id'=> 1,'panlok_id'=> 1])->count(),
            'soshum_selatan' => DataPeserta::where(['jenis_tiket_id'=> 1,'panlok_id'=> 2])->count(),
            'ipc_utara' => DataPeserta::where(['jenis_tiket_id'=> 3,'panlok_id'=> 1])->count(),
            'ipc_selatan' => DataPeserta::where(['jenis_tiket_id'=> 3,'panlok_id'=> 2])->count(),

            'peserta_expo_utara' => DataPeserta::where(['jenis_tiket_id'=> 4,'panlok_id'=> 1])->count(),
            'peserta_expo_selatan' => DataPeserta::where(['jenis_tiket_id'=> 4,'panlok_id'=> 2])->count(),

            'status_registrasi_utara' => Config::find(2)->config,
            'status_registrasi_selatan' => Config::find(3)->config,
            'status_registrasi' => Config::find(1)->config,

            'lokasi_selatan' => Config::find(5)->config,
            'tanggal_selatan' => Config::find(7)->config,
            'jam_simulasi_selatan' => Config::find(10)->config,
            'jam_expo_selatan'=> Config::find(11)->config,

            'lokasi_utara' => Config::find(4)->config,
            'tanggal_utara' => Config::find(6)->config,
            'jam_simulasi_utara' => Config::find(8)->config,
            'jam_expo_utara'=> Config::find(9)->config,
        ];
        
        return view('panitia/page/dashboard', compact('data'));
    }

    public function PhotoProfile()
    {
        $pathimage = 'profile/'.auth('panitia')->user()->photo;

        return response(Storage::get($pathimage), 200)->header('Content-Type', 'image/jpeg');
    }

    public function profile()
    {
        return view('panitia/page/profile');
    }

    public function uploadFoto(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image' => 'required|max:100|mimes:jpeg,jpg,png'
        ]);

        if($validation->fails()){
            return redirect()
                ->route('panitia_profile')
                ->with([
                    'status' => 'danger',
                    'message' => 'Terjadi kesalahan. File yang anda upload tidak sesuai dengan ketentuan'
                ]);
        }

        $filename = md5(auth('panitia')->user()->id.date('Y-m-d h:i:s').'foto').'.'.$request->file('image')->getClientOriginalExtension();

        Storage::put(
            'profile/'.$filename,
            file_get_contents($request->file('image')->getRealPath())
        );

        $foto = auth('panitia')->user()->photo;
        if($foto != 'default.jpg'){
            Storage::delete('profile/'.$foto);
        }


        auth('panitia')->user()->update([
            'photo' => $filename,
        ]);

        return redirect()
            ->route('panitia_profile')
            ->with([
                'status' => 'success',
                'message' => 'Berhasil memperbarui foto anda.']);
    }

    public function updateBiodata(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'nomor_telepon' => 'required',
        ],[
            'required' => ':attribute harus diisi.',
        ]);

        auth('panitia')->user()->update([
           'fullname' => $request->input('fullname'),
            'nomor_telepon' => $request->input('nomor_telepon')
        ]);

        return redirect()
            ->route('panitia_profile')
            ->with([
                'status' => 'success',
                'message' => 'Berhasil memperbarui biodata.']);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'password1' => 'required',
            'password2' => 'required',
        ],[
            'required' => ':attribute harus diisi.',
        ]);

        if( !(auth('panitia')->user()->comparePassword($request->input('password'))) ){
            return redirect()
                ->route('panitia_profile')
                ->with([
                    'status' => 'danger',
                    'message' => 'Password lama anda salah.']);
        }

        if($request->input('password1') !== $request->input('password2')){
            return redirect()
                ->route('panitia_profile')
                ->with([
                    'status' => 'danger',
                    'message' => 'Password Baru tidak sama.']);
        }

        auth('panitia')->user()->changePassword($request->input('password'));

        return redirect()
            ->route('panitia_profile')
            ->with([
                'status' => 'success',
                'message' => 'Password berhasil diperbarui']);
    }
}
