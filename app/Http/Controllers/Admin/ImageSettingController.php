<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageCondition;
use App\Models\Subcategory;
use App\Models\SubcategoryAttribute;
use App\Models\SubcategoryAttributeValue;
use Illuminate\Http\Request;

class ImageSettingController extends Controller
{
    public function index()
    {
        $images = ImageCondition::with([
            'subcategory',
            'dependencies.attribute',
            'dependencies.value',
            'affectedAttribute',
            'affectedValues.value',
        ])->latest()->get();

        return view('admin.images.index', compact('images'));
    }


    public function create()
    {
        $subcategories = Subcategory::orderBy('name')->get();
        return view('admin.images.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'conditions' => 'required|array',
        ]);

        foreach ($request->conditions as $conditionIndex => $conditionData) {
            // Save the condition
            $condition = ImageCondition::create([
                'subcategory_id' => $request->subcategory_id,
                'affected_attribute_id' => $conditionData['affected_attribute_id'] ?? null,
            ]);

            // Save dependencies (attribute → value pair)
            if (!empty($conditionData['dependencies'])) {
                foreach ($conditionData['dependencies'] as $dep) {
                    if (!empty($dep['attribute_id']) && !empty($dep['value_id'])) {
                        $condition->dependencies()->create([
                            'attribute_id' => $dep['attribute_id'],
                            'value_id' => $dep['value_id'],
                        ]);
                    }
                }
            }

            // Save affected values + images
            if (!empty($conditionData['affected_value_ids'])) {
                foreach ($conditionData['affected_value_ids'] as $valueId) {
                    $imagePath = null;

                    // Check if file uploaded for this value
                    if ($request->hasFile("conditions.$conditionIndex.value_images.$valueId")) {
                        $file = $request->file("conditions.$conditionIndex.value_images.$valueId");

                        // ✅ Better naming: tie image directly to condition + value
                        $extension = $file->getClientOriginalExtension();
                        $filename = "cond{$condition->id}_val{$valueId}_" . time() . "." . $extension;

                        $imagePath = $file->storeAs('image_conditions', $filename, 'public');
                    }
                    $orientation = $conditionData['orientation'][$valueId] ?? null;

                    $condition->affectedValues()->create([
                        'value_id' => $valueId,
                        'image' => $imagePath,
                        'orientation' => $orientation,
                    ]);
                }
            }
        }

        return response()->json(['success' => true]);
    }


    public function show($id)
    {
        $image = ImageCondition::with('affectedValues', 'dependencies')->findOrFail($id);
        return view('admin.images.show', compact('image'));
    }

    public function edit($id)
    {
        $condition = ImageCondition::with(['dependencies', 'affectedValues'])->findOrFail($id);
        $subcategories = Subcategory::orderBy('name')->get();

        $subcategoryAttributes = SubcategoryAttribute::with('attribute')
            ->where('subcategory_id', $condition->subcategory_id)
            ->get();

        $attributes = $subcategoryAttributes->map(function ($sa) {
            // Fetch values manually filtered by subcategory + attribute
            $values = SubcategoryAttributeValue::with('value')
                ->where('subcategory_id', $sa->subcategory_id)
                ->where('attribute_id', $sa->attribute_id)
                ->get()
                ->map(function ($sav) {
                    return [
                        'id' => $sav->value->id,
                        'value' => $sav->value->value,
                    ];
                });

            return [
                'id' => $sa->attribute->id,
                'name' => $sa->attribute->name,
                'values' => $values,
            ];
        });

        $attributeValueMap = [];
        foreach ($attributes as $attr) {
            $attributeValueMap[$attr['id']] = $attr['values'];
        }

        return view('admin.images.edit', compact('condition', 'subcategories', 'attributes', 'attributeValueMap'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'conditions' => 'required|array',
        ]);

        $existingCondition = ImageCondition::findOrFail($id);

        // Update base info of the main condition
        $existingCondition->update([
            'subcategory_id' => $request->subcategory_id,
        ]);

        foreach ($request->conditions as $conditionIndex => $conditionData) {

            // Update existing condition or create a new one
            $condition = ImageCondition::updateOrCreate(
                ['id' => $conditionData['id'] ?? null],
                [
                    'subcategory_id' => $request->subcategory_id,
                    'affected_attribute_id' => $conditionData['affected_attribute_id'] ?? null,
                ]
            );

            // Handle dependencies
            if (!empty($conditionData['dependencies'])) {
                foreach ($conditionData['dependencies'] as $dep) {
                    if (!empty($dep['attribute_id']) && !empty($dep['value_id'])) {
                        // Update existing dependency or create new
                        $condition->dependencies()->updateOrCreate(
                            [
                                'attribute_id' => $dep['attribute_id'],
                                'value_id' => $dep['value_id'],
                            ]
                        );
                    }
                }
            }

            // Handle affected values and images
            if (!empty($conditionData['affected_value_ids'])) {
                foreach ($conditionData['affected_value_ids'] as $valueId) {
                    $imagePath = null;

                    $old = $condition->affectedValues()->where('value_id', $valueId)->first();

                    // Check for uploaded file
                    if ($request->hasFile("conditions.$conditionIndex.value_images.$valueId")) {
                        $file = $request->file("conditions.$conditionIndex.value_images.$valueId");
                        $filename = "cond{$condition->id}_val{$valueId}_" . time() . "." . $file->getClientOriginalExtension();
                        $imagePath = $file->storeAs('image_conditions', $filename, 'public');

                        // Delete old image if exists
                        if ($old && !empty($old->image) && \Storage::disk('public')->exists($old->image)) {
                            \Storage::disk('public')->delete($old->image);
                        }
                    } else {
                        // Keep existing image if present
                        $imagePath = $old ? $old->image : null;
                    }

                    $orientation = $conditionData['orientation'][$valueId] ?? null;
                    $condition->affectedValues()->updateOrCreate(
                        ['value_id' => $valueId],
                        [
                            'image' => $imagePath,
                            'orientation' => $orientation,
                        ]
                    );

                }
            }

        }

        return response()->json(['success' => true]);
    }


    public function destroy($id)
    {
        $imageCondition = ImageCondition::with('affectedValues')->findOrFail($id);

        // Delete related affected images from storage
        foreach ($imageCondition->affectedValues as $affected) {
            if (!empty($affected->image) && \Storage::disk('public')->exists($affected->image)) {
                \Storage::disk('public')->delete($affected->image);
            }
        }

        // Delete the record itself (dependencies and affectedValues will be deleted if relationships have cascade or you can delete manually)
        $imageCondition->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image condition and related images deleted successfully.'
        ]);
    }

}
