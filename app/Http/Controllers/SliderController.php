<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'html' => view('admin.sliders.create')->render(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'nullable|string',
            'status' => 'in:active,inactive',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('sliders', 'public');
            $data['image_path'] = $path;
        }


        Slider::create($data);

        return response()->json(['success' => true, 'message' => 'Slider Created.']);
    }

    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return response()->json([
            'success' => true,
            'html' => view(
                'admin.sliders.edit',
                [
                    'slider' => $slider,
                ]
            )->render(),
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        // dd($request->all());
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'nullable|string',
            'status' => 'in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exist
            if ($slider->image_path ) {
                Storage::disk('public')->delete($slider->image_path);
            }

            // Save new image
            $image = $request->file('image');
            $path = $image->store('sliders', 'public');
            $data['image_path'] = $path;
        }


        $slider->update($data);
        return response()->json(['success' => true, 'message' => 'Slider updated.']);
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return response()->json(['success' => true, 'message' => 'Slider deleted.']);
    }
}
