<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectTimezone
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil dari cookie yang dikirim browser user (Jakarta/Makassar/dll)
        $timezone = $request->cookie('client_timezone');

        // Jika valid, set zona waktu PHP dan Laravel Carbon
        if ($timezone && in_array($timezone, \DateTimeZone::listIdentifiers(), true)) {
            date_default_timezone_set($timezone);
            config(['app.timezone' => $timezone]);
        }

        return $next($request);
    }
}

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

// class DetectTimezone
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  Closure(Request): (Response)  $next
//      */
//     public function handle(Request $request, Closure $next): Response
//     {
//         return $next($request);
//     }
// }
