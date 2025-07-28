<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/cacheclear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    // dd("Done");
    return response()->json(["message" => "Cache clear", "status" => true]);
});

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);

Route::get('/game', function () {
    return view('game'); // This will look for resources/views/game.blade.php
});
// routes/web.php
Route::get('/about', function () {
    return view('about');
});


// curl -X POST "https://api.telegram.org/bot8308817192:AAGKL7EPF-efA6z9_fQ8EUED39-FUke5cns/setWebhook" -d "url=https://heena-tele-app.onrender.com/api/telegram/webhook"