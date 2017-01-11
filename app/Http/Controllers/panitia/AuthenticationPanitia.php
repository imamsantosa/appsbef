<?php

namespace App\Http\Controllers\panitia;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticationPanitia extends Controller
{
    public function login()
    {
        return view('panitia/page/login');
    }

    public function loginProses(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ],[
            'required' => ':attribute harus diisi.',
        ]);

//        $secret_key = '6LdPMhAUAAAAACt--s1jFerJZwhhIYwa88tdz8hM';
//
//         $captcha = $request->input('g-recaptcha-response');
//         $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
//         $recaptcha = file_get_contents($url);
//         $recaptcha = json_decode($recaptcha, true);
//         if (!$recaptcha['success']) {
//             return redirect()
//                 ->route('panitia_login')
//                 ->with([
//                     'status-login' => 'danger',
//                     'message' => 'Terjadi Kesalahan. Silahkan isi data dan klik pastikan anda bukan robot!'
//                 ]);
//         }

        $creds = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        if(!auth('panitia')->attempt($creds)){
            return redirect()
                ->route('panitia_login')
                ->with([
                    'status-login' => 'danger',
                    'message' => 'Username atau Password salah!!!'
                ]);
        }

        return redirect()
            ->route('panitia_home');
    }

    public function logout()
    {
        auth('panitia')->logout();
        return redirect()->route('panitia_login');
    }
}
