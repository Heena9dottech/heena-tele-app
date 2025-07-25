<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/cacheclear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return response()->json(["message" => "Cache clear", "status" => true]);
});
