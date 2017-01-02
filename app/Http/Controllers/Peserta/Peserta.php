<?php

namespace App\Http\Controllers\Peserta;

use Illuminate\Http\Request;

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

    
}
