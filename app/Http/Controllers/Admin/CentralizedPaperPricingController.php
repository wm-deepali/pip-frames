<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\CentralizedAttributePricing;
use App\Models\Sra3SheetCount;
use Illuminate\Http\Request;

class CentralizedPaperPricingController extends Controller
{
    public function index()
    {
        $attribute = Attribute::with('values')->where('name', 'Paper Size')->firstOrFail();
        $paperSizePricing = CentralizedAttributePricing::with([
            'dependencies.attribute',
            'dependencies.value',
            'quantityRanges'
        ])
            ->where('attribute_id', $attribute->id)
            ->get();

        $sra3Counts = Sra3SheetCount::get()->keyBy('attribute_value_id');

        $paperWeight = Attribute::where('name', 'Paper Weight')->firstOrFail();
        $paperWeightPricing = CentralizedAttributePricing::with([
            'attribute',
            'value',
            'dependencies.attribute',
            'dependencies.value',
        ])
            ->where('attribute_id', $paperWeight->id)
            ->get();

        // dd($paperWeightPricing->toArray());
        return view('admin.centralized-paper-pricing.index', compact('paperSizePricing', 'attribute', 'sra3Counts', 'paperWeightPricing', 'paperWeight'));
    }

}
