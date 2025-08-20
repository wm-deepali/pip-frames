<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\CentralizedAttributePricing;
use Illuminate\Http\Request;

class PaperRatesController extends Controller
{
    public function create()
    {
        $attribute = Attribute::with('values', 'parents.values')
            ->where('name', 'Paper Size')  // or ->where('id', X) if you prefer by ID
            ->firstOrFail();

        // dd($attribute->toArray());
        return view('admin.centralized-paper-pricing.paper-rates.create', compact('attribute'));
    }

    public function edit($attributeId)
    {
        $attribute = Attribute::with('values', 'parents.values')->findOrFail($attributeId);

        $pricingRules = CentralizedAttributePricing::with([
            'dependencies.attribute',
            'dependencies.value',
            'quantityRanges'
        ])->where('attribute_id', $attributeId)->get();

        $existingDependencies = $pricingRules->map(function ($rule) {
            return [
                'dependency_values' => $rule->dependencies->pluck('value_id', 'attribute_id')->toArray(),
                'per_page_pricing' => $rule->quantityRanges->map(function ($range) {
                    return [
                        'quantity_from' => $range->quantity_from,
                        'quantity_to' => $range->quantity_to,
                        'price' => $range->price,
                        'is_default' => (bool) $range->is_default,
                    ];
                })->toArray(),
            ];
        })->toArray();

        return view('admin.centralized-paper-pricing.paper-rates.edit', compact(
            'attribute',
            'existingDependencies'
        ));
    }


    public function store(Request $request)
    {
        foreach ($request->rows as $row) {
            $pricing = CentralizedAttributePricing::create([
                'attribute_id' => $request->attribute_id,
            ]);

            // Save dependencies
            foreach ($row['dependency_values'] as $attributeId => $valueId) {
                $pricing->dependencies()->create([
                    'attribute_id' => $attributeId,
                    'value_id' => $valueId,
                ]);
            }

            // Save quantity ranges
            foreach ($row['per_page_pricing'] as $range) {
                $pricing->quantityRanges()->create([
                    'quantity_from' => $range['quantity_from'],
                    'quantity_to' => $range['quantity_to'],
                    'price' => $range['price'],
                ]);
            }
        }

        return response()->json(['message' => 'Centralized pricing saved']);
    }

    public function update(Request $request, $attributeId)
    {
        $request->validate([
            'rows' => 'required|array',
            'rows.*.dependency_values' => 'required|array',
            'rows.*.per_page_pricing' => 'required|array',
        ]);

        $existingPricingIds = CentralizedAttributePricing::where('attribute_id', $attributeId)->pluck('id')->toArray();
        $submittedPricingIds = [];

        foreach ($request->rows as $row) {
            // Check if this is an existing pricing rule or a new one
            if (!empty($row['id']) && in_array($row['id'], $existingPricingIds)) {
                $pricing = CentralizedAttributePricing::find($row['id']);
                $submittedPricingIds[] = $pricing->id;

                // Update dependencies
                $pricing->dependencies()->delete();
                foreach ($row['dependency_values'] as $attributeIdKey => $valueId) {
                    $pricing->dependencies()->create([
                        'attribute_id' => $attributeIdKey,
                        'value_id' => $valueId,
                    ]);
                }

                // Update quantity ranges
                $pricing->quantityRanges()->delete();
                foreach ($row['per_page_pricing'] as $range) {
                    $pricing->quantityRanges()->create([
                        'quantity_from' => $range['quantity_from'],
                        'quantity_to' => $range['quantity_to'],
                        'price' => $range['price'],
                    ]);
                }

            } else {
                // New entry
                $pricing = CentralizedAttributePricing::create([
                    'attribute_id' => $attributeId,
                ]);

                foreach ($row['dependency_values'] as $attributeIdKey => $valueId) {
                    $pricing->dependencies()->create([
                        'attribute_id' => $attributeIdKey,
                        'value_id' => $valueId,
                    ]);
                }

                foreach ($row['per_page_pricing'] as $range) {
                    $pricing->quantityRanges()->create([
                        'quantity_from' => $range['quantity_from'],
                        'quantity_to' => $range['quantity_to'],
                        'price' => $range['price'],
                    ]);
                }

                $submittedPricingIds[] = $pricing->id;
            }
        }

        // Delete pricing rules that were removed in the UI
        $toDelete = array_diff($existingPricingIds, $submittedPricingIds);
        if (!empty($toDelete)) {
            CentralizedAttributePricing::whereIn('id', $toDelete)->delete();
        }

        return response()->json(['message' => 'Centralized pricing updated successfully.']);
    }
}
