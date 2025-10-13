<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technology = Technology::first();

        return view('admin.pages.contents.technology.index', compact('technology'));
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
    public function store(Request $request)
    {
        $technology = new Technology();

        $technology->title = $request->title;
        $technology->slug = Str::slug($request->title);
        $technology->long_desc = $request->long_desc;
        $technology->video = $request->video;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $technology->images = json_encode($images);

        $technology->save();

        return redirect()->back()->with('success', 'Technology created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {

        $technology->title = $request->title;
        $technology->slug = Str::slug($request->title);
        $technology->long_desc = $request->long_desc;
        $technology->video = $request->video;

        $images = json_decode($technology->images) ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $technology->images = json_encode($images);

        $technology->save();

        return redirect()->back()->with('success', 'Technology created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        //
    }
}
