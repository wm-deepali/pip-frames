<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\CentralizedAttributePricing;
use Illuminate\Http\Request;
use App\Models\CentralizedAttributeDependency;
use Illuminate\Support\Facades\DB;

class PaperWeightRatesController extends Controller
{
    public function create()
    {
        $attribute = Attribute::with('values', 'parents.values')
            ->where('name', 'Paper Weight')  // or ->where('id', X) if you prefer by ID
            ->firstOrFail();

        // dd($attribute->toArray());
        return view('admin.centralized-paper-pricing.paper-weight-rates.create', compact('attribute'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'rows' => 'required|array',
            'rows.*.dependency_values' => 'required|array',
            'rows.*.price' => 'required|numeric',
        ]);

        // DB::beginTransaction();

        // try {
        foreach ($validated['rows'] as $row) {
            $dependencyValues = $row['dependency_values'];
            $price = $row['price'];

            // Extract attribute_value_id (of the current attribute)
            $attributeValueId = $dependencyValues[$validated['attribute_id']] ?? null;

            // dd($attributeValueId);
            // Create the centralized pricing row
            $centralizedPricing = CentralizedAttributePricing::create([
                'attribute_id' => $validated['attribute_id'],
                'value_id' => $attributeValueId,
                'price' => $price,
            ]);
            // Store other dependency values (excluding self)
            foreach ($dependencyValues as $attrId => $attrValueId) {
                if ($attrId != $validated['attribute_id']) {
                    CentralizedAttributeDependency::create([
                        'centralized_pricing_id' => $centralizedPricing->id,
                        'attribute_id' => $attrId,
                        'value_id' => $attrValueId,
                    ]);
                }
            }
        }
        return response()->json(['message' => 'Centralized pricing created successfully.']);
        //     DB::commit();
        //     return back()->with('success', 'Pricing saved successfully.');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return back()->with('error', 'Error saving pricing: ' . $e->getMessage());
        // }
    }

    public function edit($attributeId)
    {
        // dd($attributeId);
        $attribute = Attribute::with('values', 'parents.values')->findOrFail($attributeId);

        $pricingRules = CentralizedAttributePricing::with([
            'dependencies.attribute',
            'dependencies.value',
        ])->where('attribute_id', $attributeId)->get();


        return view('admin.centralized-paper-pricing.paper-weight-rates.edit', compact(
            'attribute',
            'pricingRules'
        ));
    }


    public function update(Request $request, $attributeId)
    {
        // dd($request->all());
        $validated = $request->validate([
            'rows' => 'required|array',
            'rows.*.dependency_values' => 'required|array',
            'rows.*.price' => 'required|numeric',
        ]);

        // Get existing pricing rules
        $existingPricings = CentralizedAttributePricing::with('dependencies')
            ->where('attribute_id', $attributeId)
            ->get();

        // Prepare a list of "unique keys" for incoming data
        $processedKeys = [];

        foreach ($validated['rows'] as $row) {
            $dependencyValues = $row['dependency_values'];
            $price = $row['price'];

            $attributeValueId = $dependencyValues[$attributeId] ?? null;

            // Generate a unique key for the dependency set
            $key = collect($dependencyValues)->map(fn($v, $k) => "$k:$v")->sortKeys()->implode('|');
            $processedKeys[] = $key;

            // Try to find an existing matching pricing rule
            $matched = $existingPricings->first(function ($pricing) use ($attributeValueId, $dependencyValues) {
                if ($pricing->value_id != $attributeValueId)
                    return false;

                $existingDeps = $pricing->dependencies->pluck('value_id', 'attribute_id')->toArray();

                // Exclude self attribute when comparing dependencies
                unset($dependencyValues[$pricing->attribute_id]);

                return $dependencyValues == $existingDeps;
            });

            if ($matched) {
                // Update price if changed
                if ($matched->price != $price) {
                    $matched->update(['price' => $price]);
                }
            } else {
                // Create new pricing row
                $centralizedPricing = CentralizedAttributePricing::create([
                    'attribute_id' => $attributeId,
                    'value_id' => $attributeValueId,
                    'price' => $price,
                ]);

                foreach ($dependencyValues as $attrId => $attrValueId) {
                    if ($attrId != $attributeId) {
                        CentralizedAttributeDependency::create([
                            'centralized_pricing_id' => $centralizedPricing->id,
                            'attribute_id' => $attrId,
                            'value_id' => $attrValueId,
                        ]);
                    }
                }
            }
        }

        // Delete any pricing rows not present in the updated input
        foreach ($existingPricings as $pricing) {
            $existingDeps = $pricing->dependencies->pluck('value_id', 'attribute_id')->toArray();
            $fullSet = $existingDeps;
            $fullSet[$attributeId] = $pricing->value_id;

            $key = collect($fullSet)->map(fn($v, $k) => "$k:$v")->sortKeys()->implode('|');

            if (!in_array($key, $processedKeys)) {
                $pricing->dependencies()->delete();
                $pricing->delete();
            }
        }

        return response()->json(['message' => 'Centralized pricing updated successfully.']);
    }


}
