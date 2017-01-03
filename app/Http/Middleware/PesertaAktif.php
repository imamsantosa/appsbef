<?php

namespace App\Http\Middleware;

use Closure;

class PesertaAktif
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = auth('peserta')->user()->status_peserta_id;
        if($status == 1)
        {
            return redirect()->route('peserta_pilih_tiket');
        }

        if($status == 2){
            return redirect()->route('peserta_konfirmasi_pembayaran');
        }

        if(auth('peserta')->user()->photo == 'default.jpg'){
            return redirect()->route('peserta_upload_foto');
        }

        return $next($request);
    }
}
