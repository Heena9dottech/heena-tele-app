<?php

use App\Http\Controllers\TelegramController;
use App\Http\Controllers\TelegramWebhookController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyTelegramWebhook;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return "Database connected: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "DB ERROR: " . $e->getMessage();
    }
});


// Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);
// Route::post('/telegram/webhook', [TelegramWebhookController::class, 'handle']);


Route::post('/telegram/webhook', [TelegramWebhookController::class, 'handle'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::middleware('api')->group(function () {
    Route::post('/telegram/webhook', [TelegramWebhookController::class, 'handle']);
});


Route::get('/cacheclear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return response()->json(["message" => "Cache clear", "status" => true]);
});
