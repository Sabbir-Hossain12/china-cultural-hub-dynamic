<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $history = History::first();

        return view('admin.pages.contents.history.index',compact('history'));
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
        $history = new History();
        $history->title = $request->title;
        $history->slug = Str::slug($request->title);
        $history->short_desc = $request->short_desc;
        $history->long_desc = $request->long_desc;
        $history->video = $request->video;

        $history->save();

        return redirect()->back()->with('success','History created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        $history->title = $request->title;
        $history->slug = Str::slug($request->title);
        $history->short_desc = $request->short_desc;
        $history->long_desc = $request->long_desc;
        $history->video = $request->video;

        $history->save();

        return redirect()->back()->with('success','History Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        //
    }
}
