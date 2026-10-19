<?php

use Illuminate\Http\Request;

if (!function_exists('getRealIp')) {
    function getRealIp(Request $request)
    {
        // Cek dari X-Forwarded-For (dipakai oleh proxy/ngrok)
        if ($request->header('X-Forwarded-For')) {
            $forwardedIps = explode(',', $request->header('X-Forwarded-For'));
            return trim($forwardedIps[0]); // ambil IP pertama
        }

        // Fallback ke IP biasa
        return $request->ip();
    }
}