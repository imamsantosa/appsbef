<?php

namespace App\Http\Controllers\panitia;

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
            'total_pendaftar' => Peserta::count(),
            'user_panitia' => \App\Panitia::count(),
            'total_expo' => '0',
            'status_registrasi' => Config::find(1)->config
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
