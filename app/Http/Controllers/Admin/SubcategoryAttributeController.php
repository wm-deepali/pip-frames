<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubcategoryAttribute;
use App\Models\SubcategoryAttributeValue;
use App\Models\Subcategory;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcategoryAttributeController extends Controller
{
    public function index()
    {
        $links = SubcategoryAttribute::with(['subcategory', 'attribute',])->latest()->get();
        return view('admin.subcategory-attributes.index', compact('links'));
    }

    public function create()
    {
        $subcategories = Subcategory::orderBy('name')->get();
        $attributes = Attribute::orderBy('name')->get();
        $view = view('admin.subcategory-attributes.create', [
            'subcategories' => $subcategories,
            'attributes' => $attributes,
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
            'attribute_id' => 'required|array|min:1',
            'attribute_id.*' => 'required|exists:attributes,id|distinct',
            'attribute_value_ids' => 'nullable|array',
            'attribute_value_ids.*' => 'nullable|array',
            'attribute_value_ids.*.*' => 'exists:attribute_values,id',
            'is_required' => 'nullable|array',
            'is_required.*' => 'boolean',
            'sort_order' => 'required|array',
            'sort_order.*' => 'required|integer|min:0',
        ], [
            'attribute_id.*.distinct' => 'You cannot assign the same attribute more than once.',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        // ✅ Now manually validate values for attributes (only if NOT select_area)
        $errors = [];

        foreach ($request->attribute_id as $index => $attrId) {
            $attribute = Attribute::find($attrId);
            // dd($attribute && $attribute->input_type !== 'select_area');
            // If input_type is NOT 'select_area', then value must be provided
            if ($attribute && $attribute->input_type !== 'select_area') {
                $valueIds = $request->attribute_value_ids[$attrId] ?? null;

                if (empty($valueIds) || !is_array($valueIds)) {
                    $errors["attribute_value_ids.$index"] = ["Attribute values are required for '{$attribute->name}'."];
                }
            }
        }

        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'errors' => $errors,
                'code' => 422
            ], 422);
        }

        $skipped = [];

        foreach ($request->attribute_id as $index => $attrId) {
            $alreadyMapped = SubcategoryAttribute::where('subcategory_id', $request->subcategory_id)
                ->where('attribute_id', $attrId)
                ->exists();

            if ($alreadyMapped) {
                $attributeName = Attribute::find($attrId)?->name ?? "Attribute ID: $attrId";
                $skipped[] = $attributeName;
                continue;
            }

            $mapping = SubcategoryAttribute::create([
                'subcategory_id' => $request->subcategory_id,
                'attribute_id' => $attrId,
                'is_required' => $request->is_required[$index] ?? false,
                'sort_order' => $request->sort_order[$index] ?? null,
            ]);

            $valueIds = $request->attribute_value_ids[$attrId] ?? [];

            foreach ($valueIds as $valueId) {
                $already = SubcategoryAttributeValue::where([
                    'subcategory_id' => $request->subcategory_id,
                    'attribute_id' => $attrId,
                    'attribute_value_id' => $valueId,
                ])->exists();

                if (!$already) {
                    SubcategoryAttributeValue::create([
                        'subcategory_id' => $request->subcategory_id,
                        'attribute_id' => $attrId,
                        'attribute_value_id' => $valueId,
                        'is_default' => false,
                    ]);
                }
            }
        }

        $message = 'Attributes mapped successfully.';
        if (count($skipped)) {
            $message .= ' The following attribute(s) were already mapped and skipped: <br><b>' . implode(', ', $skipped) . '</b>';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }



    public function edit($id)
    {
        $subcategoryAttribute = SubcategoryAttribute::findOrFail($id);
        $subcategories = Subcategory::orderBy('name')->get();
        $attributes = Attribute::orderBy('name')->get();
        $selectedValues = SubcategoryAttributeValue::where('subcategory_id', $subcategoryAttribute->subcategory_id)
            ->where('attribute_id', $subcategoryAttribute->attribute_id)
            ->pluck('attribute_value_id')
            ->toArray();

        $view = view('admin.subcategory-attributes.edit', [
            'subcategoryAttribute' => $subcategoryAttribute,
            'subcategories' => $subcategories,
            'attributes' => $attributes,
            'selectedValues' => $selectedValues,
        ])->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Fetch attribute type
        $subcategoryAttribute = SubcategoryAttribute::findOrFail($id);

        $attribute = Attribute::find($request->attribute_id);
        if (!$attribute) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => [
                    'attribute_id' => ['Selected attribute does not exist.']
                ]
            ]);
        }
        // dd($attribute);
        // Don't require values for these input types
        $requiresValues = !in_array($attribute->input_type, ['select_area']);

        // Base validation rules
        $rules = [
            'subcategory_id' => 'required|exists:subcategories,id',
            'attribute_id' => 'required|exists:attributes,id',
            'is_required' => 'sometimes|boolean',
            'sort_order' => 'required|integer|min:0',
        ];

        if ($requiresValues) {
            $rules['attribute_value_ids'] = 'required|array';
            $rules['attribute_value_ids.*'] = 'exists:attribute_values,id';
        }

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        // ✅ Check if another mapping already exists with same subcategory, attribute and values
        $existingMapping = SubcategoryAttribute::where('subcategory_id', $request->subcategory_id)
            ->where('attribute_id', $request->attribute_id)
            ->where('id', '!=', $subcategoryAttribute->id)
            ->first();

        if ($existingMapping) {
            $existingValues = SubcategoryAttributeValue::where('subcategory_id', $request->subcategory_id)
                ->where('attribute_id', $request->attribute_id)
                ->pluck('attribute_value_id')
                ->sort()
                ->values()
                ->toArray();

            $newValues = collect($request->attribute_value_ids)->sort()->values()->toArray();

            if ($existingValues == $newValues) {
                return response()->json([
                    'success' => false,
                    'code' => 422,
                    'errors' => [
                        'attribute_id' => ['This attribute with the selected values is already mapped to the subcategory.']
                    ],
                ]);
            }
        }

        $subcategoryAttribute->update($request->only([
            'subcategory_id',
            'attribute_id',
            'is_required',
            'sort_order'
        ]));

        SubcategoryAttributeValue::where([
            'subcategory_id' => $subcategoryAttribute->subcategory_id,
            'attribute_id' => $subcategoryAttribute->attribute_id
        ])->delete();
        if (isset($request->attribute_value_ids)) {
            foreach ($request->attribute_value_ids as $valueId) {
                SubcategoryAttributeValue::create([
                    'subcategory_id' => $subcategoryAttribute->subcategory_id,
                    'attribute_id' => $subcategoryAttribute->attribute_id,
                    'attribute_value_id' => $valueId,
                    'is_default' => false,
                ]);
            }
        }

        return $this->respondSuccess($request, 'Subcategory Attribute updated successfully.');
    }


    public function destroy(SubcategoryAttribute $subcategoryAttribute)
    {
        SubcategoryAttributeValue::where([
            'subcategory_id' => $subcategoryAttribute->subcategory_id,
            'attribute_id' => $subcategoryAttribute->attribute_id
        ])->delete();

        $subcategoryAttribute->delete();
        return redirect()->route('admin.subcategory-attributes.index')
            ->with('success', 'Mapping deleted.');
    }

    private function validationError($validator)
    {
        return response()->json([
            'success' => false,
            'code' => 422,
            'errors' => $validator->errors(),
        ]);
    }

    private function respondSuccess(Request $request, string $message)
    {
        return $request->ajax()
            ? response()->json(['success' => true, 'message' => $message])
            : redirect()->route('admin.subcategory-attributes.index')->with('success', $message);
    }
}
