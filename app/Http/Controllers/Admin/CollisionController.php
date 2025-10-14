<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collision;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collision = Collision::first();

        return view('admin.pages.contents.collision.index', compact('collision'));
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
        $collision = new Collision();

        $collision->title = $request->title;
        $collision->slug = Str::slug($request->title);
        $collision->short_desc = $request->short_desc;
        $collision->long_desc = $request->long_desc;
        $collision->btn_text = $request->btn_text;
        $collision->video = $request->video;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $collision->images = json_encode($images);

        $collision->save();

        return redirect()->back()->with('success', 'Collision created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collision $collision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collision $collision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collision $collision)
    {


        $collision->title = $request->title;
        $collision->short_desc = $request->short_desc;
        $collision->long_desc = $request->long_desc;
        $collision->btn_text = $request->btn_text;
        $collision->video = $request->video;

        $images = json_decode($collision->images) ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $collision->images = json_encode($images);

        $collision->save();

        return redirect()->back()->with('success', 'Collision created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collision $collision)
    {
        //
    }
}
