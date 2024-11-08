<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;
use Illuminate\Support\Str;

use function Psy\debug;

class SectionController extends Controller
{
    public function __construct()
    {
        Inertia::share('breadcrumbs', [
            ['name' => 'Sections', 'url' => route('dashboard.sections.index')],
        ]);
        Inertia::setRootView('dashboard-app');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check session success and pass to inertia
        if (session('success')) {
            Inertia::share('success', session('success'));
        }
        Inertia::share('title', 'Section List');
        $sections = Section::withCount('items')->get();

        $sections->transform(function ($section) {
            $section->view_url = route('portfolio-item', $section->slug);
            $section->edit_url = route('dashboard.sections.edit', $section->id);
            $section->delete_url = route('dashboard.sections.destroy', $section->id);
            return $section;
        });

        return Inertia::render('Sections/Index', [
            'sections' => $sections,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Inertia::share('title', 'Create Section');
        return Inertia::render('Sections/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data['slug'] = Str::slug($data['name']);

        Section::create($data);

        return redirect()->route('dashboard.sections.index')->with('success', 'Section created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($section)
    {
        $section = Section::with('items')->find($section);
        Inertia::share('title', 'Edit Section');
        Inertia::share('sectionID', $section->id);
        return Inertia::render('Sections/Edit', [
            'section' => $section,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data['slug'] = Str::slug($data['name']);

        $section->update($data);

        return redirect()->route('dashboard.sections.index')->with('success', 'Section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        // delete section items and section
        $section->items()->delete();
        $section->delete();
        return redirect()->route('dashboard.sections.index');
    }
}
