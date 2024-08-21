<?php

use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\SectionItem;
use App\Models\Section;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/grid', function () {
    return view('test-grid');
});

Route::name('dashboard.')->prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard/index');
    })->name('index');

    // sections crud
    Route::name('sections.')->prefix('sections')->controller(SectionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{section}/edit', 'edit')->name('edit');
        Route::put('/{section}', 'update')->name('update');
        Route::delete('/{section}', 'destroy')->name('destroy');
    });
});

Route::group(['name' => 'inertia SPA', ], function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('home');

    Route::get('/portfolio', function () {
        return Inertia::render('List', [
            'sections' => Section::all()->map(function ($section) {
                return [
                    'id' => $section->id,
                    'name' => $section->name,
                    'slug' => $section->slug,
                    'description' => $section->description,
                    'viewUrl' => route('portfolio-item', ['slug' => $section->slug]),
                ];
            }),
        ]);
    })->name('portfolio');

    Route::get('/portfolio/{slug}', function ($slug) {
        $section = Section::where('slug', $slug)->first();
        return Inertia::render('Grid', [
            'gridItems' => SectionItem::where('section_id', $section->id)->get(),
            'slug' => $slug,
        ]);
    })->name('portfolio-item');
});