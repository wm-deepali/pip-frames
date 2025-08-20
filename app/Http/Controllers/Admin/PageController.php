<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.content.dynamic_pages', compact('pages'));
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('front.dynamic_page', compact('page'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:published,draft',
        ]);

        $page = Page::create($validated);

        return response()->json([
            'message' => 'Page created successfully',
            'data' => $page
        ], 201); // HTTP 201 = Created
    }

    public function edit($id)
    {
        return Page::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->update($request->all());

        return response()->json(['message' => 'Page updated successfully']);
    }

    public function destroy($id)
    {
        Page::destroy($id);
        return response()->json(['message' => 'Page deleted']);
    }

}
