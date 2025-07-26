<?php

namespace App\Http\Controllers;

use App\Models\TelegramMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TelegramWebhookController extends Controller
{
     public function webhook(Request $request)
    {
        Log::info('Webhook Data:', $request->all());
        return response()->json(['message' => 'Webhook received']);
    }
}
