<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/grid', function () {
    return view('test-grid');
});

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard/index');
});

Route::group(['name' => 'inertia SPA', ], function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('home');
});