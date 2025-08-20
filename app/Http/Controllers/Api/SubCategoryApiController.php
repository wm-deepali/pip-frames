<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryApiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('category_id')) {
            $category = Category::with('subcategories')->find($request->category_id);

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            return response()->json($category->subcategories);
        }

        return response()->json(['message' => 'category_id is required'], 422);
    }
}

