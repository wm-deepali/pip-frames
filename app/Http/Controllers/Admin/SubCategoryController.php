<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::with('categories')->latest()->get();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $categories = Category::where('status', 'active')->latest()->get();
            return response()->json([
                "success" => true,
                "html" => view('admin.subcategories.ajax.add-subcategory')->with([
                    'categories' => $categories,
                ])->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'name' => 'required|max:155',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'calculator_required' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        DB::beginTransaction();

        try {
            // Handle thumbnail upload
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('subcategories/thumbnails', 'public');
            }

            // Handle gallery uploads
            $galleryPaths = [];
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $galleryPaths[] = $file->store('subcategories/gallery', 'public');
                }
            }

            // Create subcategory
            $subcategory = SubCategory::create([
                'name' => $request->name,
                'description' => $request->description ?? null,
                'thumbnail' => $thumbnailPath,
                'gallery' => $galleryPaths,
                'status' => $request->status,
                'calculator_required' => $request->calculator_required ?? 0,
            ]);

            // Attach multiple categories
            $subcategory->categories()->attach($request->category_ids);

            // Create detail record
            $subcategory->details()->create([
                'information' => $request->information,
                'available_sizes' => $request->available_sizes,
                'binding_options' => $request->binding_options,
                'paper_types' => $request->paper_types,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'code' => 500,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    public function edit($id)
    {
        try {
            $categories = Category::where('status', 'active')->latest()->get();
            $subcategory = SubCategory::with(['categories', 'details'])->findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.subcategories.ajax.edit-subcategory')->with([
                    'categories' => $categories,
                    'subcategory' => $subcategory,
                ])->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'name' => 'required|max:255',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'calculator_required' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        DB::beginTransaction();

        try {
            $subcategory = SubCategory::findOrFail($id);

            // Handle thumbnail replacement
            if ($request->hasFile('thumbnail')) {
                if ($subcategory->thumbnail) {
                    Storage::disk('public')->delete($subcategory->thumbnail);
                }
                $subcategory->thumbnail = $request->file('thumbnail')->store('subcategories/thumbnails', 'public');
            }

            // Handle deleted images from gallery
            $existingGallery = $subcategory->gallery ?? [];
            $deletedPaths = explode(',', $request->input('deleted_image_paths'));
            $deletedPaths = array_filter($deletedPaths); // remove empty strings

            foreach ($deletedPaths as $path) {
                if (in_array($path, $existingGallery)) {
                    Storage::disk('public')->delete($path);
                    $existingGallery = array_diff($existingGallery, [$path]);
                }
            }

            // Add new uploads to gallery
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $existingGallery[] = $file->store('subcategories/gallery', 'public');
                }
            }

            $subcategory->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'thumbnail' => $subcategory->thumbnail,
                'gallery' => array_values($existingGallery), // reset keys
                'calculator_required' => $request->calculator_required ?? 0,
            ]);

            $subcategory->categories()->sync($request->category_ids);

            $subcategory->details()->updateOrCreate([], [
                'information' => $request->information,
                'available_sizes' => $request->available_sizes,
                'binding_options' => $request->binding_options,
                'paper_types' => $request->paper_types,
            ]);

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'code' => 500,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $subcategory = SubCategory::findOrFail($id);

            if ($subcategory->thumbnail) {
                Storage::disk('public')->delete($subcategory->thumbnail);
            }

            if ($subcategory->gallery) {
                foreach ($subcategory->gallery as $file) {
                    Storage::disk('public')->delete($file);
                }
            }

            $subcategory->details()->delete();
            $subcategory->categories()->detach();
            $subcategory->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
}
