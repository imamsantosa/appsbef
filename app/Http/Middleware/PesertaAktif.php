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
//            dd('h');

            return redirect()->route('peserta_konfirmasi_pembayaran');
        }

        return $next($request);
    }
}
