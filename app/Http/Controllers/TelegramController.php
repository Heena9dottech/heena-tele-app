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
            $userMessage = strtolower(trim($data['message']['text'] ?? ''));

            if ($chatId) {
                if ($userMessage === '/start' || $userMessage === 'game') {
                    // Send button to open Mini App
                    Http::post("https://api.telegram.org/bot{$telegramToken}/sendPhoto", [
                        'chat_id' => $chatId,
                        //   'photo' => 'https://heena-tele-app.onrender.com/images/miniapp-banner.jpg',
                        'photo' => 'https://i.imgur.com/I8YQv2f.jpg',
                        'caption' => "🎮 *Welcome to the Heena Mini Game!*\n\nThis is a fun interactive game built just for you.\n\n👇 Click the button below to start playing!",

                        'parse_mode' => 'Markdown',
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [
                                [
                                    [
                                        'text' => '🚀 Start Game',
                                        'web_app' => [
                                            'url' => 'https://heena-tele-app.onrender.com/game'
                                        ]
                                    ],
                                    [
                                        'text' => '📋 About the Game',
                                        'web_app' => [
                                            'url' => 'https://heena-tele-app.onrender.com/about'
                                        ]
                                    ]
                                ]
                            ]
                        ])
                    ]);
                } else {
                    // Just echo what user said
                    Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                        'chat_id' => $chatId,
                        'text' => 'You said: ' . $userMessage,
                    ]);
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }

    public function webhook_old(Request $request)
    {
        Log::info('Telegram Webhook Triggered');
        Log::info($request->all());

        $telegramToken = '8308817192:AAGKL7EPF-efA6z9_fQ8EUED39-FUke5cns';

        $data = $request->all();

        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'] ?? null;
            $userMessage = strtolower(trim($data['message']['text'] ?? ''));

            if ($chatId) {
                if ($userMessage === '/start' || $userMessage === 'game') {
                    // Send button to open Mini App
                    Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                        'chat_id' => $chatId,
                        'text' => 'Click below to open the Mini App 👇',
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [
                                [
                                    [
                                        'text' => '🎮 Open Heena Mini App',
                                        'web_app' => [
                                            'url' => 'https://heena-tele-app.onrender.com/game'
                                        ]
                                    ]
                                ]
                            ]
                        ])
                    ]);
                } else {
                    // Just echo what user said
                    Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                        'chat_id' => $chatId,
                        'text' => 'You said: ' . $userMessage,
                    ]);
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
