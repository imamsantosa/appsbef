<?php

namespace App\Http\Controllers\panitia;

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
}
