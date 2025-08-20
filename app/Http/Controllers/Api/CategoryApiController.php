<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::with(['subcategories' => function ($query) {
            $query->select('subcategories.id', 'name', 'slug', 'status');
        }])->select('id', 'name', 'slug', 'status')->get();

        return response()->json($categories);
    }
}

