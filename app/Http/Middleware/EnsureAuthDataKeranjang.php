<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthDataKeranjang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() == null) {
            return redirect()->route('login')->with('error', 'Silakan Login Terlebih Terdahulu');
        }
        // if (auth()->user()->kerajangs->count() == 0) {
        //     return redirect()->route('produk')->with('error', 'Keranjang Kosong, Silakan Belanja');
        // }

        return $next($request);
    }
}
