<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Telegram Webhook Triggered');
        Log::info($request->all());

        $telegramToken = '8308817192:AAGKL7EPF-efA6z9_fQ8EUED39-FUke5cns'; // 🔁 Use your new bot token

        $data = $request->all();

        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'] ?? null;
            $userMessage = $data['message']['text'] ?? '';

            if ($chatId) {
                $responseText = "You said: " . $userMessage;

                Http::withOptions(['verify' => false]) // 👈 Disable SSL verification
                    ->post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                        'chat_id' => $chatId,
                        'text'    => $responseText,
                    ]);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
