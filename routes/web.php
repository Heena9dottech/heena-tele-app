<?php

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
