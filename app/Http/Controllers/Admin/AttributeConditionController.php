<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeCondition;
use App\Models\Subcategory;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\SubcategoryAttribute;
use App\Models\SubcategoryAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttributeConditionController extends Controller
{
    public function index()
    {
        $conditions = AttributeCondition::with([
            'subcategory',
            'parentAttribute',
            'parentValue',
            'affectedAttribute',
            'affectedValues'
        ])->latest()->get();

        return view('admin.attribute-conditions.index', compact('conditions'));
    }

    // AttributeConditionController.php
    public function getSubcategoryAttributes($subcategoryId)
    {
        $subcategoryAttributes = SubcategoryAttribute::with('attribute')
            ->where('subcategory_id', $subcategoryId)
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
                        'is_composite_value' => $sav->value->is_composite_value,
                    ];
                });

            return [
                'id' => $sa->attribute->id,
                'name' => $sa->attribute->name,
                'input_type' => $sa->attribute->input_type,
                'area_unit' => $sa->attribute->area_unit,
                'values' => $values,
                'pricing_basis' => $sa->attribute->pricing_basis,
                'has_setup_charge' => $sa->attribute->has_setup_charge,
                'has_dependency' => $sa->attribute->has_dependency,
                'dependency_parents' => $sa->attribute->parents->pluck('id')
            ];
        });

        return response()->json([
            'success' => true,
            'attributes' => $attributes,
        ]);
    }

    public function create()
    {
        $subcategories = Subcategory::orderBy('name')->get();

        $view = view('admin.attribute-conditions.create', [
            'subcategories' => $subcategories,
        ])->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subcategory_id' => 'required|exists:subcategories,id',
            'conditions' => 'required|array|min:1',
            'conditions.*.parent_attribute_id' => 'required|exists:attributes,id',
            'conditions.*.parent_value_id' => 'required|exists:attribute_values,id',
            'conditions.*.affected_attribute_id' => 'required|exists:attributes,id',
            'conditions.*.action' => 'required|in:hide_attribute,show_attribute,hide_values,show_values',
            'conditions.*.affected_value_ids' => 'nullable|array',
            'conditions.*.affected_value_ids.*' => 'exists:attribute_values,id',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        foreach ($request->conditions as $conditionData) {
            $condition = AttributeCondition::create([
                'subcategory_id' => $request->subcategory_id,
                'parent_attribute_id' => $conditionData['parent_attribute_id'],
                'parent_value_id' => $conditionData['parent_value_id'],
                'affected_attribute_id' => $conditionData['affected_attribute_id'],
                'action' => $conditionData['action'],
            ]);

            if (!empty($conditionData['affected_value_ids'])) {
                $condition->affectedValues()->attach($conditionData['affected_value_ids']);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'All attribute conditions created successfully.',
        ]);
    }

    public function edit($id)
    {
        $condition = AttributeCondition::with(['affectedValues', 'subcategory'])->findOrFail($id);

        $subcategoryAttributes = SubcategoryAttribute::with('attribute')
            ->where('subcategory_id', $condition->subcategory_id)
            ->get();

        $attributes = $subcategoryAttributes->map(function ($sa) {
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


        return response()->json([
            'success' => true,
            'html' => view('admin.attribute-conditions.edit', [
                'condition' => $condition,
                'attributes' => $attributes,
            ])->render(),
        ]);
    }


    public function update(Request $request, AttributeCondition $attributeCondition)
    {
        $validator = Validator::make($request->all(), [
            'subcategory_id' => 'required|exists:subcategories,id',
            'parent_attribute_id' => 'required|exists:attributes,id',
            'parent_value_id' => 'required|exists:attribute_values,id',
            'affected_attribute_id' => 'required|exists:attributes,id',
            'action' => 'required|in:hide_attribute,show_attribute,hide_values,show_values',
            'affected_value_ids' => 'nullable|array',
            'affected_value_ids.*' => 'exists:attribute_values,id',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator);
        }
        $data = $request->all();
        DB::beginTransaction();
        try {
            $attributeCondition->update([
                'subcategory_id' => $data['subcategory_id'],
                'parent_attribute_id' => $data['parent_attribute_id'],
                'parent_value_id' => $data['parent_value_id'],
                'affected_attribute_id' => $data['affected_attribute_id'],
                'action' => $data['action'],
            ]);

            // Sync affected values
            $attributeCondition->affectedValues()->sync($data['affected_value_ids'] ?? []);

            DB::commit();

            // For AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Attribute condition updated successfully.',
                ]);
            }

            return redirect()->route('admin.attribute-conditions.index')->with('success', 'Condition updated.');

        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->withErrors(['error' => 'Update failed.']);
        }
    }


    public function destroy(AttributeCondition $attributeCondition)
    {
        try {
            // Detach pivot values (assuming `affectedValues()` is the relation)
            $attributeCondition->affectedValues()->detach();

            // Then delete the condition
            $attributeCondition->delete();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete condition.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // 🔄 Helper for validation failure
    private function validationError($validator)
    {
        return response()->json([
            'success' => false,
            'code' => 422,
            'errors' => $validator->errors(),
        ]);
    }

}
