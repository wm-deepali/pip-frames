<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'html' => view('admin.testimonials.create')->render(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'location' => 'nullable|string|max:255',
            'feedback' => 'required|string',
            'status' => 'in:active,inactive',
        ]);

        // Handle file upload
        if ($request->hasFile('author_image')) {
            $image = $request->file('author_image');
            $path = $image->store('testimonials', 'public');
            $data['author_image'] = $path;
        }

        Testimonial::create($data);

        return response()->json(['success' => true, 'message' => 'Testimonial added.']);
    }


    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return response()->json([
            'success' => true,
            'html' => view(
                'admin.testimonials.edit',
                [
                    'testimonial' => $testimonial,
                ]
            )->render(),
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'location' => 'nullable|string|max:255',
            'feedback' => 'required|string',
            'status' => 'in:active,inactive',
        ]);

        if ($request->hasFile('author_image')) {
            // Delete old image if exists
            if ($testimonial->author_image) {
                Storage::disk('public')->delete($testimonial->author_image);
            }

            // Save new image
            $image = $request->file('author_image');
            $path = $image->store('testimonials', 'public');
            $data['author_image'] = $path;
        }

        $testimonial->update($data);
        return response()->json(['success' => true, 'message' => 'Testimonial updated.']);
    }


    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return response()->json(['success' => true, 'message' => 'Testimonial deleted.']);
    }
}
