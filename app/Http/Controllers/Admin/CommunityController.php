<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $community = Community::first();

        return view('admin.pages.contents.community.index', compact('community'));
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
        $community = new Community();

        $community->title = $request->title;
        $community->slug = Str::slug($request->title);

        $community->content_1 = $request->content_1;
        $community->content_2 = $request->content_2;
        $community->content_3 = $request->content_3;
        $community->long_desc = $request->long_desc;

        if ($request->hasFile('image_1')) {
            $image_1 = $request->file('image_1');
            $image_1_name = time() . '_' . uniqid() . '.' . $image_1->getClientOriginalExtension();
            $image_1->move('public/admin/upload/content/', $image_1_name);
            $community->image_1 = 'public/admin/upload/content/' . $image_1_name;
        }

        if ($request->hasFile('image_2')) {
            $image_2 = $request->file('image_2');
            $image_2_name = time() . '_' . uniqid() . '.' . $image_2->getClientOriginalExtension();
            $image_2->move('public/admin/upload/content/', $image_2_name);
            $community->image_2 = 'public/admin/upload/content/' . $image_2_name;
        }

        if ($request->hasFile('image_3')) {
            $image_3 = $request->file('image_3');
            $image_3_name = time() . '_' . uniqid() . '.' . $image_3->getClientOriginalExtension();
            $image_3->move('public/admin/upload/content/', $image_3_name);
            $community->image_3 = 'public/admin/upload/content/' . $image_3_name;
        }

        $community->save();

        return redirect()->back()->with('success', 'Community created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Community $community)
    {
        $community->title = $request->title;
        $community->slug = Str::slug($request->title);

        $community->content_1 = $request->content_1;
        $community->content_2 = $request->content_2;
        $community->content_3 = $request->content_3;
        $community->long_desc = $request->long_desc;

        if ($request->hasFile('image_1')) {
            $image_1 = $request->file('image_1');
            $image_1_name = time() . '_' . uniqid() . '.' . $image_1->getClientOriginalExtension();
            $image_1->move('public/admin/upload/content/', $image_1_name);
            $community->image_1 = 'public/admin/upload/content/' . $image_1_name;
        }

        if ($request->hasFile('image_2')) {
            $image_2 = $request->file('image_2');
            $image_2_name = time() . '_' . uniqid() . '.' . $image_2->getClientOriginalExtension();
            $image_2->move('public/admin/upload/content/', $image_2_name);
            $community->image_2 = 'public/admin/upload/content/' . $image_2_name;
        }

        if ($request->hasFile('image_3')) {
            $image_3 = $request->file('image_3');
            $image_3_name = time() . '_' . uniqid() . '.' . $image_3->getClientOriginalExtension();
            $image_3->move('public/admin/upload/content/', $image_3_name);
            $community->image_3 = 'public/admin/upload/content/' . $image_3_name;
        }

        $community->save();

        return redirect()->back()->with('success', 'Community Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        //
    }
}
