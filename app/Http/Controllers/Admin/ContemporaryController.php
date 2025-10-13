<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contemporary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ContemporaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contemporary = Contemporary::first();

        return view('admin.pages.contents.contemporary.index', compact('contemporary'));
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
        $contemporary = new Contemporary();

        $contemporary->title = $request->title;
        $contemporary->slug = Str::slug($request->title);
        $contemporary->short_desc = $request->short_desc;
        $contemporary->long_desc = $request->long_desc;
        $contemporary->btn_text = $request->btn_text;
        $contemporary->video = $request->video;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $contemporary->images = json_encode($images);

        $contemporary->save();

        return redirect()->back()->with('success', 'Contemporary created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contemporary $contemporary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contemporary $contemporary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contemporary $contemporary)
    {
        $contemporary->title = $request->title;
        $contemporary->slug = Str::slug($request->title);
        $contemporary->short_desc = $request->short_desc;
        $contemporary->long_desc = $request->long_desc;
        $contemporary->btn_text = $request->btn_text;
        $contemporary->video = $request->video;

        $images = json_decode($contemporary->images) ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $contemporary->images = json_encode($images);

        $contemporary->save();

        return redirect()->back()->with('success', 'Contemporary created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contemporary $contemporary)
    {
        //
    }
}
