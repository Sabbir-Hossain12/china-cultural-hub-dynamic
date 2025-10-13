<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChinaMigration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChinaMigrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $migration = ChinaMigration::first();

        return view('admin.pages.contents.migration.index', compact('migration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.contents.migration.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $migrations = new ChinaMigration();

        $migrations->title = $request->title;
        $migrations->slug = Str::slug($request->title);
        $migrations->long_desc = $request->long_desc;
        $migrations->video = $request->video;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'admin/upload/content/' . $image_name;
            }
        }

        $migrations->images = json_encode($images);

        $migrations->save();

        return redirect()->back()->with('success', 'Migration created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ChinaMigration $chinaMigration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChinaMigration $chinaMigration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChinaMigration $migrations)
    {

        $migrations->title = $request->title;
        $migrations->slug = Str::slug($request->title);
        $migrations->long_desc = $request->long_desc;
        $migrations->video = $request->video;

       $images = json_decode($migrations->images) ?? []; // keep old images

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('public/admin/upload/content/', $image_name);
                $images[] = 'admin/upload/content/' . $image_name;
            }
        }

        $migrations->images = json_encode($images);

        $migrations->save();

        return redirect()->back()->with('success', 'Migration Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChinaMigration $chinaMigration)
    {
        //
    }
}
