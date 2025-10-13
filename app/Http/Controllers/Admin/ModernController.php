<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modern;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModernController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modern = Modern::first();

        return view('admin.pages.contents.modern.index', compact('modern'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $modern = new Modern();

        $modern->title = $request->title;
        $modern->slug = Str::slug($request->title);

        $modern->content_1 = $request->content_1;
        $modern->content_2 = $request->content_2;
        $modern->content_3 = $request->content_3;
        $modern->long_desc = $request->long_desc;

        if ($request->hasFile('image_1')) {
            $image_1 = $request->file('image_1');
            $image_1_name = time() . '_' . uniqid() . '.' . $image_1->getClientOriginalExtension();
            $image_1->move('public/admin/upload/content/', $image_1_name);
            $modern->image_1 = 'public/admin/upload/content/' . $image_1_name;
        }

        if ($request->hasFile('image_2')) {
            $image_2 = $request->file('image_2');
            $image_2_name = time() . '_' . uniqid() . '.' . $image_2->getClientOriginalExtension();
            $image_2->move('public/admin/upload/content/', $image_2_name);
            $modern->image_2 = 'public/admin/upload/content/' . $image_2_name;
        }

        if ($request->hasFile('image_3')) {
            $image_3 = $request->file('image_3');
            $image_3_name = time() . '_' . uniqid() . '.' . $image_3->getClientOriginalExtension();
            $image_3->move('public/admin/upload/content/', $image_3_name);
            $modern->image_3 = 'public/admin/upload/content/' . $image_3_name;
        }

        $modern->save();

        return redirect()->back()->with('success', 'Modern created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Modern $modern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modern $modern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modern $modern)
    {


        $modern->title = $request->title;
        $modern->slug = Str::slug($request->title);

        $modern->content_1 = $request->content_1;
        $modern->content_2 = $request->content_2;
        $modern->content_3 = $request->content_3;
        $modern->long_desc = $request->long_desc;

        if ($request->hasFile('image_1')) {
            $image_1 = $request->file('image_1');
            $image_1_name = time() . '_' . uniqid() . '.' . $image_1->getClientOriginalExtension();
            $image_1->move('public/admin/upload/content/', $image_1_name);
            $modern->image_1 = 'public/admin/upload/content/' . $image_1_name;
        }

        if ($request->hasFile('image_2')) {
            $image_2 = $request->file('image_2');
            $image_2_name = time() . '_' . uniqid() . '.' . $image_2->getClientOriginalExtension();
            $image_2->move('public/admin/upload/content/', $image_2_name);
            $modern->image_2 = 'public/admin/upload/content/' . $image_2_name;
        }

        if ($request->hasFile('image_3')) {
            $image_3 = $request->file('image_3');
            $image_3_name = time() . '_' . uniqid() . '.' . $image_3->getClientOriginalExtension();
            $image_3->move('public/admin/upload/content/', $image_3_name);
            $modern->image_3 = 'public/admin/upload/content/' . $image_3_name;
        }

        $modern->save();

        return redirect()->back()->with('success', 'Modern Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modern $modern)
    {
        //
    }
}
