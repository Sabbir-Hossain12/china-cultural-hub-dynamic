<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Geography;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GeographyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $geography = Geography::first();

        return view('admin.pages.contents.geography.index', compact('geography'));
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
        $geography = new Geography();

        $geography->title = $request->title;
        $geography->slug = Str::slug($request->title);
        $geography->short_desc = $request->short_desc;
        $geography->long_desc = $request->long_desc;
        $geography->btn_text = $request->btn_text;
        $geography->video = $request->video;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $geography->images = json_encode($images);

        $geography->save();

        return redirect()->back()->with('success', 'Geography created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Geography $geography)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Geography $geography)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Geography $geography)
    {
        $geography->title = $request->title;
        $geography->short_desc = $request->short_desc;
        $geography->long_desc = $request->long_desc;
        $geography->btn_text = $request->btn_text;
        $geography->video = $request->video;

        $images = json_decode($geography->images) ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $geography->images = json_encode($images);

        $geography->save();

        return redirect()->back()->with('success', 'Geography Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Geography $geography)
    {
        //
    }
}
