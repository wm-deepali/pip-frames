<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Sra3SheetCount;

class Sra3SheetController extends Controller
{

    // Show form to create SRA3 counts
    public function create(Attribute $attribute)
    {
        $attribute = Attribute::with('values', 'parents.values')
            ->find($attribute->id);

        return view('admin.centralized-paper-pricing.sra3.create', compact('attribute'));
    }

    // Show form to edit existing SRA3 counts
    public function edit(Attribute $attribute)
    {
        $attributeValueIds = $attribute->values->pluck('id');
        $sra3Counts = Sra3SheetCount::whereIn('attribute_value_id', $attributeValueIds)
            ->pluck('sheet_count', 'attribute_value_id');

        return view('admin.centralized-paper-pricing.sra3.edit', compact('sra3Counts', 'attribute'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'sra3_counts' => 'required|array',
        ]);

        foreach ($request->sra3_counts as $valueId => $count) {
            if (!is_null($count)) {
                Sra3SheetCount::updateOrCreate(
                    [
                        // 'attribute_id' => $request->attribute_id,
                        'attribute_value_id' => $valueId
                    ],
                    [
                        'sheet_count' => $count
                    ]
                );
            }
        }

        return response()->json(['message' => 'SRA3 sheet counts saved.']);
    }


    public function update(Request $request, $attributeId)
    {
        $request->validate([
            'sra3_counts' => 'required|array',
            'sra3_counts.*' => 'nullable|numeric|min:1'
        ]);

        foreach ($request->sra3_counts as $attributeValueId => $sheetCount) {
            if ($sheetCount) {
                Sra3SheetCount::updateOrCreate(
                    ['attribute_value_id' => $attributeValueId],
                    ['sheet_count' => $sheetCount]
                );
            } else {
                // Optional: delete if sheetCount is empty/null
                Sra3SheetCount::where('attribute_value_id', $attributeValueId)->delete();
            }
        }

        return response()->json([
            'message' => 'SRA3 sheet counts updated successfully.'
        ]);
    }
}
