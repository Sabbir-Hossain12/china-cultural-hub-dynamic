<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tradition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TraditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tradition = Tradition::first();

        return view('admin.pages.contents.tradition.index', compact('tradition'));
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
        $tradition = new Tradition();

        $tradition->title = $request->title;
        $tradition->slug = Str::slug($request->title);
        $tradition->short_desc = $request->short_desc;
        $tradition->long_desc = $request->long_desc;
        $tradition->btn_text = $request->btn_text;
        $tradition->video = $request->video;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $tradition->images = json_encode($images);

        $tradition->save();

        return redirect()->back()->with('success', 'Tradition created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tradition $tradition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tradition $tradition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tradition $tradition)
    {
        $tradition->title = $request->title;
        $tradition->slug = Str::slug($request->title);
        $tradition->short_desc = $request->short_desc;
        $tradition->long_desc = $request->long_desc;
        $tradition->btn_text = $request->btn_text;
        $tradition->video = $request->video;

        $images = json_decode($tradition->images) ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'public/admin/upload/content/' . $image_name;
            }
        }

        $tradition->images = json_encode($images);

        $tradition->save();

        return redirect()->back()->with('success', 'Tradition Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tradition $tradition)
    {
        //
    }
}
