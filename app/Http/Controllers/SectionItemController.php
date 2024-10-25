<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SectionItem;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SectionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Section $section)
    {
        $data = $request->validate([
            'title' => 'required',
            'animation' => 'required_if:isCarousel,false|in:grid-to-right,grid-to-left,grid-to-top,grid-to-bottom',
            'mobileAnimation' => 'required_if:isCarousel,false|in:mobile-grid-to-top,mobile-grid-to-bottom',
            'bgColor' => ['required_if:isCarousel,false','regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'textColor' => ['required_if:isCarousel,false', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'colSpan' => 'nullable|numeric|max:3',
            'rowSpan' => 'nullable|numeric|max:2',
            'colStart' => 'nullable|numeric|max:3',
            'rowStart' => 'nullable|numeric|max:2',
            'isCarousel' => 'required|boolean',
            'deletedImages.*' => 'nullable|string',
            'newImages.*' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required_if:isCarousel,false',

        ]);
        $data['images'] = [];
        if ($request->hasFile('newImages')) {
            foreach ($request->file('newImages') as $newImage) {
                // save the image
                $newImage->store('public/section-items');
                $data['images'][] = '/storage/section-items/' . $newImage->hashName();
            }
        }
        SectionItem::create([
            'section_id' => $section->id,
            'title' => $data['title'],
            'animation' => $data['animation'] ?? null,
            'mobileAnimation' => $data['mobileAnimation'] ?? null,
            'bgColor' => $data['bgColor'] ?? null,
            'textColor' => $data['textColor'] ?? null,
            'colSpan' => $data['colSpan'],
            'rowSpan' => $data['rowSpan'],
            'colStart' => $data['colStart'],
            'rowStart' => $data['rowStart'],
            'isCarousel' => $data['isCarousel'],
            'images' => $data['images'],
            'description' => $data['description'] ?? null,
        ]);
        return redirect()->back()->with('success', 'Section item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SectionItem $sectionItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionItem $sectionItem)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section, SectionItem $sectionItem)
    {
        // dd($section, $sectionItem);
        $data = $request->validate([
            'title' => 'required',
            'animation' => 'required_if:isCarousel,false|in:grid-to-right,grid-to-left,grid-to-top,grid-to-bottom',
            'mobileAnimation' => 'required_if:isCarousel,false|in:mobile-grid-to-top,mobile-grid-to-bottom',
            'bgColor' => ['required_if:isCarousel,false', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'textColor' => ['required_if:isCarousel,false', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'colSpan' => 'nullable|numeric|max:3',
            'rowSpan' => 'nullable|numeric|max:2',
            'colStart' => 'nullable|numeric|max:3',
            'rowStart' => 'nullable|numeric|max:2',
            'isCarousel' => 'required|boolean',
            'deletedImages.*' => 'nullable|string',
            'newImages.*' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required_if:isCarousel,false',
            
        ]);
        $data['images'] = $sectionItem->images;

        if ($request->has('deletedImages')) {
            foreach ($request->deletedImages as $deletedImage) {
                // delete the image
                $imagePath = str_replace('/storage', 'public', $deletedImage);
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
                $data['images'] = array_diff($data['images'], [$deletedImage]);
            }
        }


        if ($request->hasFile('newImages')) {
            foreach ($request->file('newImages') as $newImage) {
                // save the image
                $newImage->store('public/section-items');
                $data['images'][] = '/storage/section-items/' . $newImage->hashName();
            }
        }
        $sectionItem->update([
            'title' => $data['title'],
            'animation' => $data['animation'] ?? null,
            'mobileAnimation' => $data['mobileAnimation'] ?? null,
            'bgColor' => $data['bgColor'] ?? null,
            'textColor' => $data['textColor'] ?? null,
            'colSpan' => $data['colSpan'],
            'rowSpan' => $data['rowSpan'],
            'colStart' => $data['colStart'],
            'rowStart' => $data['rowStart'],
            'isCarousel' => $data['isCarousel'],
            'images' => $data['images'],
            'description' => $data['description'] ?? null,
        ]);
        return redirect()->back()->with('success', 'Section item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section, SectionItem $sectionItem)
    {
        // delete the images
        foreach ($sectionItem->images as $image) {
            // check if the image exists
            $imagePath = str_replace('/storage', 'public', $image);
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
        $sectionItem->delete();
        return redirect()->back()->with('success', 'Section item deleted successfully');
    }
}
