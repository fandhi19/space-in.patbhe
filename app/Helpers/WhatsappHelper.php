<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class WhatsappHelper
{
    public static function send($noHp, $message)
    {
        // Bersihkan nomor dari karakter selain angka
        $noHp = preg_replace('/[^0-9]/', '', $noHp);

        // Jika diawali 08, ubah menjadi 628
        if (substr($noHp, 0, 2) === '08') {
            $noHp = '62' . substr($noHp, 1);
        }

        // Jika sudah 62, biarkan
        // Kirim ke Fonnte
        $response = Http::withHeaders([
            'Authorization' => config('services.fonnte.token') ?? env('FONNTE_TOKEN'),
        ])->post(env('FONNTE_API_URL'), [
            'target' => $noHp,
            'message' => $message,
        ]);

        return $response->successful();
    }
}