<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard/index');
});

Route::get('/grid', function () {
    return view('test-grid');
});

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard/index');
});