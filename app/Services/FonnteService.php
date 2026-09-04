<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public static function sendMessage(string $target, string $message)
    {
        $response = Http::withHeaders([
            'Authorization' => config('fonnte.api_token')
        ])->post(config('fonnte.api_url'), [
            'target' => $target,
            'message' => $message,
            'countryCode' => '62', // kode negara Indonesia
        ]);

        return $response->json();
    }
}