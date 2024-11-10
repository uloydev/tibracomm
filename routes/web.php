<?php

use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionItemController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\SectionItem;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/storage-link', function (Request $request) {
    if ($request->has('token') && $request->token === 'Tibracomm2024') {
        Artisan::call('storage:link');
        return 'Storage link created';
    }
    return 'Invalid token';
});

Route::get('/grid', function () {
    return view('test-grid');
});

Route::name('dashboard.')->prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', function () {
        // Inertia::share('title', 'Dashboard');
        // Inertia::share('breadcrumbs', [
        //     ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        // ]);
        // Inertia::setRootView('dashboard-app');
        // return Inertia::render('Index');
        return redirect("dashboard/sections");
    })->name('index');

    // sections crud
    Route::name('sections.')->prefix('sections')->controller(SectionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{section}/edit', 'edit')->name('edit');
        Route::put('/{section}', 'update')->name('update');
        Route::delete('/{section}', 'destroy')->name('destroy');
        // sections items crud
        Route::name('items.')->prefix('{section}/items')->controller(SectionItemController::class)->group(function () {
            Route::delete('/{sectionItem}', 'destroy')->name('destroy');
            Route::post('/', 'store')->name('store');
            Route::put('/{sectionItem}', 'update')->name('update');
        });
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