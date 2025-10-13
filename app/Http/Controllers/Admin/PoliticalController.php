<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Political;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PoliticalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $political = Political::first();

        return view('admin.pages.contents.political.index',compact('political'));
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
        $political = new Political();

        $political->title = $request->title;
        $political->slug = Str::slug($request->title);
        $political->short_desc = $request->short_desc;
        $political->long_desc = $request->long_desc;
        $political->btn_text = $request->btn_text;
        $political->video = $request->video;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $political->images = json_encode($images);

        $political->save();

        return redirect()->back()->with('success', 'Political created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Political $political)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Political $political)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Political $political)
    {
        $political->title = $request->title;
        $political->slug = Str::slug($request->title);
        $political->short_desc = $request->short_desc;
        $political->long_desc = $request->long_desc;
        $political->btn_text = $request->btn_text;
        $political->video = $request->video;

        $images = json_decode($political->images) ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $political->images = json_encode($images);

        $political->save();

        return redirect()->back()->with('success', 'Political created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Political $political)
    {
        //
    }
}
