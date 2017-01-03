<?php

namespace App\Http\Controllers\Peserta;

use App\Config;
use App\Universitas;
use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Peserta extends Controller
{
    public function home()
    {
        if(auth('peserta')->user()->status_peserta_id == 3){
            $dataUniv = Universitas::all();
            return View('peserta/page/home', compact('dataUniv'));
        }

        return View('peserta/page/home');
    }

    public function PhotoProfile()
    {
        $pathimage = 'profile/'.auth('peserta')->user()->photo;

        return response(Storage::get($pathimage), 200)->header('Content-Type', 'image/jpeg');
    }

    public function uploadFoto()
    {
        return view('peserta/page/upload_foto');
    }

    public function uploadFotoProses(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image' => 'required|max:100|mimes:jpeg,jpg,png'
        ]);

        if($validation->fails()){
            return redirect()
                ->route('peserta_upload_foto')
                ->with([
                    'status' => 'danger',
                    'message' => 'Terjadi kesalahan. File yang anda upload tidak sesuai dengan ketentuan'
                ]);
        }

        $filename = md5(auth('peserta')->user()->id.date('Y-m-d h:i:s').'foto').'.'.$request->file('image')->getClientOriginalExtension();

        Storage::put(
            'profile/'.$filename,
            file_get_contents($request->file('image')->getRealPath())
        );

        $foto = auth('peserta')->user()->photo;
        if($foto != 'default.jpg'){
            Storage::delete('profile/'.$foto);
        }


        auth('peserta')->user()->update([
            'photo' => $filename,
        ]);

        return redirect()
            ->route('peserta_home')
            ->with([
                'status' => 'success',
                'message' => 'Berhasil memperbarui foto anda.']);
    }

    public function cetakTiket()
    {
        if(auth('peserta')->user()->status_peserta_id != 4){
            return redirect()
                ->route('peserta_home');
        }

        if(auth('peserta')->user()->dataPeserta->panlok_id == 1){
            $data = [
                'lokasi' => Config::find(4)->config,
                'tanggal' => Config::find(6)->config,

                'jam_simulasi' => Config::find(8)->config,
                'jam_expo'=> Config::find(9)->config,
            ];
        } else{

            $data = [

                'lokasi' => Config::find(5)->config,
                'tanggal' => Config::find(7)->config,

                'jam_simulasi' => Config::find(10)->config,
                'jam_expo'=> Config::find(11)->config,
            ];
        }

        return view('peserta/page/cetak_tiket', compact('data'));
    }

    public function profile()
    {
        return view('peserta/page/profile');
    }

    public function updateBiodata(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'phone' => 'required',
        ],[
            'required' => ':attribute harus diisi.',
        ]);

        auth('peserta')->user()->update([
            'fullname' => $request->input('fullname'),
            'phone' => $request->input('phone')
        ]);

        return redirect()
            ->route('peserta_profile')
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

        if( !(auth('peserta')->user()->comparePassword($request->input('password'))) ){
            return redirect()
                ->route('peserta_profile')
                ->with([
                    'status' => 'danger',
                    'message' => 'Password lama anda salah.']);
        }

        if($request->input('password1') !== $request->input('password2')){
            return redirect()
                ->route('peserta_profile')
                ->with([
                    'status' => 'danger',
                    'message' => 'Password Baru tidak sama.']);
        }

        auth('peserta')->user()->changePassword($request->input('password1'));

        return redirect()
            ->route('peserta_profile')
            ->with([
                'status' => 'success',
                'message' => 'Password berhasil diperbarui']);
    }
}
