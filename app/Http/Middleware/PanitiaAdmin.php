<?php

namespace App\Http\Middleware;

use Closure;

class PanitiaAdmin
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
        $status = auth('panitia')->user()->role_id;
        if($status == 3)
        {
            return redirect()->route('panitia_home');
        }

        return $next($request);
    }
}
