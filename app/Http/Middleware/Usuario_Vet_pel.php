<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Usuario_Vet_pel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->tipo == 'veterinario' or auth()->user()->tipo == 'admin' or auth()->user()->tipo == 'peluquero' ){
            return $next($request);
        }
    }
}
