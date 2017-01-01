<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Index extends Controller
{
    public function index(){
        return view('peserta/page/login');
    }
}
