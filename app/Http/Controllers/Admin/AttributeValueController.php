<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\SubcategoryAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeValueController extends Controller
{
    public function index()
    {
        $values = AttributeValue::with(['attribute', 'components'])->latest()->get();
        return view('admin.attribute-values.index', compact('values'));
    }

    public function getValues($id, Request $request)
    {

        $values = AttributeValue::where('attribute_id', $id)->get(['id', 'value']);

        $selected = [];
        if ($request->has('subcategory_id')) {
            $selected = SubcategoryAttributeValue::where('subcategory_id', $request->subcategory_id)
                ->where('attribute_id', $id)
                ->pluck('attribute_value_id')
                ->toArray();
        }

        return response()->json([
            'success' => true,
            'values' => $values,
            'selected_values' => $selected,
        ]);
    }


    public function create()
    {
        $attributes = Attribute::all();

        $attributeConfigs = $attributes->mapWithKeys(function ($attribute) {
            return [
                $attribute->id => [
                    'has_image' => $attribute->has_image,
                    'has_icon' => $attribute->has_icon,
                    'input_type' => $attribute->input_type,
                    'custom_input_type' => $attribute->custom_input_type,
                    'is_composite' => $attribute->is_composite,
                    'require_both_images' => $attribute->require_both_images,
                ],
            ];
        });

        $existingValuesGrouped = AttributeValue::with('attribute')
            ->get()
            ->groupBy('attribute_id')
            ->map(function ($group) {
                return $group->map(function ($val) {
                    return [
                        'id' => $val->id,
                        'display_value' => $val->value,
                    ];
                });
            });


        $view = view('admin.attribute-values.add', [
            'attributeConfigs' => $attributeConfigs,
            'attributes' => $attributes,
            'existingValuesGrouped' => $existingValuesGrouped
        ])->render();

        // dd($attributeConfigs);
        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function store(Request $request)
    {
        $attribute = Attribute::findOrFail($request->attribute_id);
        $inputType = $attribute->input_type;
        $requireBothImages = $attribute->require_both_images;

        // Add validation rules for portrait and landscape if needed
        $rules = [
            'attribute_id' => 'required|exists:attributes,id',
            'attribute_values' => 'required|array|min:1',
            'attribute_values.*.value' => 'required_without_all:attribute_values.*.image_portrait,attribute_values.*.image_landscape',
            'attribute_values.*.title' => 'nullable|string|max:255',
            'attribute_values.*.icon_class' => 'nullable|string|max:255',
            'attribute_values.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'attribute_values.*.custom_input_label' => 'nullable|string',
            'attribute_values.*.is_composite' => 'nullable|boolean',
            'attribute_values.*.composed_of' => 'nullable|array',
            'attribute_values.*.fixed_extra_charges' => 'nullable|boolean',
        ];

        if ($requireBothImages) {
            $rules['attribute_values.*.image_portrait'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
            $rules['attribute_values.*.image_landscape'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        foreach ($request->attribute_values as $index => $valueData) {
            $data = [
                'attribute_id' => $request->attribute_id,
                'icon_class' => $valueData['icon_class'] ?? null,
                'title' => $valueData['title'] ?? null,
                'custom_input_label' => $valueData['custom_input_label'] ?? null,
                'is_composite_value' => !empty($valueData['is_composite']) ? true : false,
                'fixed_extra_charges' => !empty($valueData['fixed_extra_charges']) ? true : false,
            ];

            if ($requireBothImages) {
                // Handle portrait image
                if ($request->hasFile("attribute_values.{$index}.image_portrait")) {
                    $data['image_portrait_path'] = $request->file("attribute_values.{$index}.image_portrait")->store('attribute_values', 'public');
                }
                // Handle landscape image
                if ($request->hasFile("attribute_values.{$index}.image_landscape")) {
                    $data['image_landscape_path'] = $request->file("attribute_values.{$index}.image_landscape")->store('attribute_values', 'public');
                }

                // Set value if needed (title or other)
                $data['value'] = $valueData['title'] ?? null;

            } elseif (in_array($inputType, ['select_image', 'select_icon'])) {
                $uploadedValueFile = $request->file("attribute_values.{$index}.value");
                if ($uploadedValueFile) {
                    $data['image_path'] = $uploadedValueFile->store('attribute_values', 'public');
                }
                $data['value'] = $valueData['title'] ?? null;
            } else {
                $data['value'] = $valueData['value'];
            }

            // Optional additional image field
            $uploadedImage = $request->file("attribute_values.{$index}.image");
            if ($uploadedImage) {
                $data['image_path'] = $uploadedImage->store('attribute_values', 'public');
            }

            if ($inputType === 'select_colour') {
                $data['value'] = $valueData['value']; // colour name
                $data['colour_code'] = $valueData['colour_code'] ?? null;
            }

            $attributeValue = AttributeValue::create($data);

            if (!empty($valueData['is_composite']) && !empty($valueData['composed_of'])) {
                $componentIds = array_map('intval', $valueData['composed_of']);
                $attributeValue->components()->sync($componentIds);
            }
        }

        return $this->respondSuccess($request, 'Attribute value(s) created successfully.');
    }


    public function edit($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attribute = Attribute::findOrFail($attributeValue->attribute_id);

        $attributeConfigs = [
            $attribute->id => [
                'has_image' => $attribute->has_image,
                'has_icon' => $attribute->has_icon,
                'input_type' => $attribute->input_type,
                'custom_input_type' => $attribute->custom_input_type,
                'is_composite' => $attribute->is_composite,
                'require_both_images' => $attribute->require_both_images,
            ]
        ];

        $data = [
            'attributeValue' => $attributeValue,
            'attribute' => $attribute,
            'attributeConfigs' => $attributeConfigs,
            'action' => route('admin.attribute-values.update', $attributeValue->id),
            'method' => 'PUT',
            'buttonText' => 'Update',
        ];

        // Only fetch composite-related data if is_composite is true
        if ($attribute->is_composite) {
            $availableValues = AttributeValue::where('attribute_id', $attribute->id)
                ->where('id', '!=', $attributeValue->id)
                ->get();

            $attributeValue->load('components');
            $attributeValue->composed_of_array = $attributeValue->components->pluck('id')->toArray();

            $data['availableValues'] = $availableValues;
        }
        $view = view('admin.attribute-values.edit', $data)->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function update(Request $request, AttributeValue $attributeValue)
    {
        $attribute = Attribute::findOrFail($request->attribute_id);
        $inputType = $attribute->input_type;
        $requireBothImages = $attribute->require_both_images;

        $rules = [
            'attribute_id' => 'required|exists:attributes,id',
            'icon_class' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'custom_input_label' => 'nullable|string',
            'is_composite_value' => 'sometimes|boolean',
            'composed_of' => 'nullable|array',
            'composed_of.*' => 'integer|exists:attribute_values,id',
            'fixed_extra_charges' => 'nullable|boolean'
        ];

        if (in_array($inputType, ['select_image', 'select_icon'])) {
            $rules['value'] = 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048';
            $rules['title'] = 'required|string|max:255';
        } else {
            $rules['value'] = 'required|string|max:255';
            $rules['title'] = 'nullable|string|max:255';
        }

        if ($inputType === 'select_colour') {
            $rules['value'] = 'required|string|max:255'; // colour name
            $rules['colour_code'] = 'nullable|string|max:20';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $data = $request->only([
            'attribute_id',
            'title',
            'icon_class',
        ]);

        $data['fixed_extra_charges'] = $request->boolean('fixed_extra_charges');
        $data['is_composite_value'] = $request->boolean('is_composite_value');
        $data['custom_input_label'] = $request->filled('custom_input_label') ? $request->input('custom_input_label') : null;

        if ($requireBothImages) {
            if ($request->hasFile('image_portrait')) {
                $data['image_portrait_path'] = $request->file('image_portrait')->store('attribute_values', 'public');
            }
            if ($request->hasFile('image_landscape')) {
                $data['image_landscape_path'] = $request->file('image_landscape')->store('attribute_values', 'public');
            }
            $data['value'] = $request->input('title'); // label for images
        } elseif (in_array($inputType, ['select_image', 'select_icon'])) {
            if ($request->hasFile('value')) {
                $data['image_path'] = $request->file('value')->store('attribute_values', 'public');
            }
            $data['value'] = $request->input('title');
        } else {
            $data['value'] = $request->input('value');
        }

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('attribute_values', 'public');
        }

        if ($inputType === 'select_colour') {
            $data['value'] = $request->input('value');
            $data['colour_code'] = $request->input('colour_code') ?? null;
        }

        $attributeValue->update($data);

        if ($data['is_composite_value']) {
            $components = $request->input('composed_of', []);
            $attributeValue->components()->sync($components);
        } else {
            $attributeValue->components()->detach();
        }

        return $this->respondSuccess($request, 'Attribute value updated successfully.');
    }


    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();

        return request()->ajax()
            ? response()->json(['success' => true, 'message' => 'Value deleted.'])
            : redirect()->route('admin.attribute-values.index')->with('success', 'Value deleted.');
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

    // ✅ Helper for success redirect or JSON
    private function respondSuccess(Request $request, string $message)
    {
        return $request->ajax()
            ? response()->json(['success' => true, 'message' => $message])
            : redirect()->route('admin.attribute-values.index')->with('success', $message);
    }
}
