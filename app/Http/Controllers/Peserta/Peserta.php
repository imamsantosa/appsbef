<?php

namespace App\Http\Controllers\Peserta;

use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Peserta extends Controller
{
    public function home()
    {
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
        return view('peserta/page/cetak_tiket');
    }
}
