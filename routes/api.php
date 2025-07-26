<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);


// Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);

// Route::post('/telegram/webhook', function (Request $request) {
//     Log::info('Telegram Webhook Triggered');
//     Log::info($request->all());

//     return response()->json(['status' => 'ok']);
// });

// Route::post('/telegram/webhook', function (Request $request) {
//     Log::info('Telegram Webhook Triggered');

//     $data = $request->all();
//     Log::info($data);

//     if (isset($data['message'])) {
//         $chatId = $data['message']['chat']['id'] ?? null;
//         $text = $data['message']['text'] ?? '';

//         // Check if data is valid
//         if ($chatId && $text) {
//             $token = '8308817192:AAGKL7EPF-efA6z9_fQ8EUED39-FUke5cns';
//             $url = "https://api.telegram.org/bot$token/sendMessage";

//             $response = Http::post($url, [
//                 'chat_id' => $chatId,
//                 'text' => "You said: $text"
//             ]);

//             Log::info('Reply sent', ['response' => $response->json()]);
//         }
//     }

//     return response()->json(['status' => 'ok']);
// });
