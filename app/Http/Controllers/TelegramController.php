<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Bot received:', $request->all());

        $data = $request->all();

        // Optional: Save message to DB
        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'];
            $text = $data['message']['text'] ?? '';
            $username = $data['message']['from']['username'] ?? '';
            $firstName = $data['message']['from']['first_name'] ?? '';
            $lastName = $data['message']['from']['last_name'] ?? '';

            // Example: Store in users table
            DB::table('users')->updateOrInsert(
                ['chat_id' => $chatId],
                [
                    'username' => $username,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'message' => $text,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        return response()->json(['status' => 'ok']);
    }
}
