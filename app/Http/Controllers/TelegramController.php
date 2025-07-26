<?php

namespace App\Http\Controllers;

use App\Models\TelegramMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Telegram Webhook Triggered');
        Log::info($request->all());

        $telegramToken = '8308817192:AAGKL7EPF-efA6z9_fQ8EUED39-FUke5cns';

        $data = $request->all();

        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'] ?? null;
            $userMessage = $data['message']['text'] ?? '';
            $username = $data['message']['from']['username'] ?? null;

            if ($chatId) {
                TelegramMessage::create([
                    'chat_id' => $chatId,
                    'username' => $username,
                    'message' => $userMessage,
                ]);

                Http::withOptions(['verify' => false])
                    ->post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                        'chat_id' => $chatId,
                        'text'    => "You said: " . $userMessage,
                    ]);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
