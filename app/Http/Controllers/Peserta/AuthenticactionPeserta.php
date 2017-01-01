<?php

namespace App\Http\Controllers\Peserta;

use App\Peserta;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class AuthenticactionPeserta extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ],[
            'required' => ':attribute harus diisi.',
        ]);

        $creds = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        if(!auth('peserta')->attempt($creds)){
            return redirect()
                ->route('index')
                ->with([
                    'status-login' => 'danger',
                    'message' => 'Username atau Password salah!!!'
                ]);
        }

        return redirect()
            ->route('peserta_home');


    }

    public function register(Request $request)
    {
        $is_registration = true;
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'asal_sekolah' => 'required',
            'email' => 'required',
            'telepon' => 'required'
        ]);

        if ($validator->fails()) {

            return redirect()
                ->route('index', compact('is_registration'))
                ->with([
                    'status' => 'danger',
                    'message' => 'Terjadi Kesalahan. isi data dan klik pastikan anda bukan robot!'
                ]);
        }

         $secret_key = '6LdPMhAUAAAAACt--s1jFerJZwhhIYwa88tdz8hM';

//         $captcha = $request->input('g-recaptcha-response');
//         $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
//         $recaptcha = file_get_contents($url);
//         $recaptcha = json_decode($recaptcha, true);
//         if (!$recaptcha['success']) {
//             return redirect()
//                 ->route('index', compact('is_registration'))
//                 ->with([
//                     'status' => 'danger',
//                     'message' => 'Terjadi Kesalahan. Silahkan isi data dan klik pastikan anda bukan robot!'
//                 ]);
//         }

        $cek = Peserta::where('username', $request->input('username'))->count();
        if($cek > 1){
            return redirect()
                ->route('index', compact('is_registration'))
                ->with([
                    'status' => 'danger',
                    'message' => 'Username telah terdaftar. Jika anda melupakan password anda, silahkan hubungi contact person.'
                ]);
        }

        $newuser = Peserta::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'fullname' => $request->input('nama_lengkap'),
            'school' => $request->input('asal_sekolah'),
            'email' => $request->input('email'),
            'phone' => $request->input('telepon'),
            'status_peserta_id' => 1
        ]);

        return redirect()
            ->route('index', compact('is_registration'))
            ->with([
                'status' => 'success',
                'message' => 'Pendaftaran Sukses. Silahkan Masuk kemudian melanjutkan pendaftaran'
            ]);
    }

    public function logout()
    {
        auth('peserta')->logout();
        return redirect()
            ->route('index');
    }
}
