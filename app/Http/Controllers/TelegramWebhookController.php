<?php

namespace App\Http\Controllers;

use App\Models\TelegramMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TelegramWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $message = $request->input('message');
        $chatId = $message['chat']['id'] ?? null;
        $text   = $message['text'] ?? '';
        $username = $message['chat']['username'] ?? '';

        // Store in DB
        TelegramMessage::create([
            'chat_id' => $chatId,
            'username' => $username,
            'message' => $text,
        ]);

        // Optional: reply
        if ($chatId && $text) {
            Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
                'chat_id' => $chatId,
                'text' => "Saved your message: $text",
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
