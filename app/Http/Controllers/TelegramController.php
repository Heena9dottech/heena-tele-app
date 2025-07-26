<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        $data = $request->all();
        Log::info('Telegram Webhook Data:', $data);

        // Optional: reply to message
        if (isset($data['message']['chat']['id'])) {
            $chatId = $data['message']['chat']['id'];
            $this->sendMessage($chatId, "Hi Heena! Message received 🎉");
        }

        return response()->json(['status' => 'ok']);
    }

    private function sendMessage($chatId, $text)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $payload = [
            'chat_id' => $chatId,
            'text' => $text
        ];

        $client = new \GuzzleHttp\Client();
        $client->post($url, ['form_params' => $payload]);
    }
}
