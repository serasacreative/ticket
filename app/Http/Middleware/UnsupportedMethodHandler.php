<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class UnsupportedMethodHandler
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (MethodNotAllowedHttpException $exception) {
            // Jika metode tidak didukung, Anda dapat mengalihkan pengguna ke halaman lain atau menampilkan pesan kesalahan.
            // Di sini, contoh redirect ke halaman tertentu:
            return redirect()->route('ticket.index'); // Ganti dengan nama rute yang sesuai.
        }
    }
}


