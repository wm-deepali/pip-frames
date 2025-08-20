<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function getOptions($subcategoryId)
    {
        // This will return all static options used for quotes

        return response()->json([
            'paper_types' => \App\Models\PaperType::all(['id', 'name']),
            'paper_weights' => \App\Models\PaperWeight::all(['id', 'gsm']),
            'paper_sizes' => \App\Models\PaperSize::all(['id', 'name']),
            'bindings' => \App\Models\Binding::all(['id', 'name']),
            'cover_types' => \App\Models\CoverType::all(['id', 'name']),
            'cover_finishes' => \App\Models\CoverFinish::all(['id', 'name']),
            'cover_foilings' => \App\Models\CoverFoiling::all(['id', 'name']),
            'cover_colours' => \App\Models\CoverPrintingColour::all(['id', 'name']),
            'orientations' => \App\Models\Orientation::all(['id', 'name']),
            'page_printing_colours' => \App\Models\PrintingColour::all(['id', 'name']),
        ]);
    }
}

