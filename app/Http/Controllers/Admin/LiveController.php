<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Live;
use App\Models\Modern;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $live = Live::first();

        return view('admin.pages.contents.live.index', compact('live'));
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
        $live = new Live();

        $live->title = $request->title;
        $live->slug = Str::slug($request->title);

        $live->content_1 = $request->content_1;
        $live->content_2 = $request->content_2;
        $live->content_3 = $request->content_3;
        $live->long_desc = $request->long_desc;

        if ($request->hasFile('image_1')) {
            $image_1 = $request->file('image_1');
            $image_1_name = time() . '_' . uniqid() . '.' . $image_1->getClientOriginalExtension();
            $image_1->move('public/admin/upload/content/', $image_1_name);
            $live->image_1 = 'public/admin/upload/content/' . $image_1_name;
        }

        if ($request->hasFile('image_2')) {
            $image_2 = $request->file('image_2');
            $image_2_name = time() . '_' . uniqid() . '.' . $image_2->getClientOriginalExtension();
            $image_2->move('public/admin/upload/content/', $image_2_name);
            $live->image_2 = 'public/admin/upload/content/' . $image_2_name;
        }

        if ($request->hasFile('image_3')) {
            $image_3 = $request->file('image_3');
            $image_3_name = time() . '_' . uniqid() . '.' . $image_3->getClientOriginalExtension();
            $image_3->move('public/admin/upload/content/', $image_3_name);
            $live->image_3 = 'public/admin/upload/content/' . $image_3_name;
        }

        $live->save();

        return redirect()->back()->with('success', 'Modern created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Live $live)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Live $live)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Live $live)
    {
        $live->title = $request->title;
        $live->content_1 = $request->content_1;
        $live->content_2 = $request->content_2;
        $live->content_3 = $request->content_3;
        $live->long_desc = $request->long_desc;

        if ($request->hasFile('image_1')) {
            $image_1 = $request->file('image_1');
            $image_1_name = time() . '_' . uniqid() . '.' . $image_1->getClientOriginalExtension();
            $image_1->move('public/admin/upload/content/', $image_1_name);
            $live->image_1 = 'public/admin/upload/content/' . $image_1_name;
        }

        if ($request->hasFile('image_2')) {
            $image_2 = $request->file('image_2');
            $image_2_name = time() . '_' . uniqid() . '.' . $image_2->getClientOriginalExtension();
            $image_2->move('public/admin/upload/content/', $image_2_name);
            $live->image_2 = 'public/admin/upload/content/' . $image_2_name;
        }

        if ($request->hasFile('image_3')) {
            $image_3 = $request->file('image_3');
            $image_3_name = time() . '_' . uniqid() . '.' . $image_3->getClientOriginalExtension();
            $image_3->move('public/admin/upload/content/', $image_3_name);
            $live->image_3 = 'public/admin/upload/content/' . $image_3_name;
        }

        $live->save();

        return redirect()->back()->with('success', 'Live  Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Live $live)
    {
        //
    }
}
