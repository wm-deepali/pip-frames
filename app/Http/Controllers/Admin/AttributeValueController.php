<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\SubcategoryAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AttributeValueParentImage;

class AttributeValueController extends Controller
{
    public function index()
    {
        $values = AttributeValue::with([
            'attribute',
            'components',
            'parentImages', // Load parent images relationship
        ])->latest()->get();
// dd($values->toArray());
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
        // Load attributes with imageParentsWithValues eager loaded
        $attributes = Attribute::with(['imageParentsWithValues'])->get();

        // Map each attribute config including imageParents with their values
        $attributeConfigs = $attributes->mapWithKeys(function ($attribute) {
            return [
                $attribute->id => [
                    'has_image' => $attribute->has_image,
                    'has_icon' => $attribute->has_icon,
                    'input_type' => $attribute->input_type,
                    'custom_input_type' => $attribute->custom_input_type,
                    'is_composite' => $attribute->is_composite,
                    'require_both_images' => $attribute->require_both_images,
                    'has_image_dependency' => $attribute->has_image_dependency,
                    'required_file_uploads' => $attribute->required_file_uploads,

                    // Use imageParentsWithValues here, not imageParents
                    'imageParents' => $attribute->imageParentsWithValues->map(function ($parentAttr) {
                        return [
                            'id' => $parentAttr->id,
                            'name' => $parentAttr->name,
                            'values' => $parentAttr->values->map(function ($val) {
                                return [
                                    'id' => $val->id,
                                    'value' => $val->value,
                                    'title' => $val->title,
                                    // add other needed fields
                                ];
                            }),
                        ];
                    }),
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

        // dd($attributeConfigs->toArray());
        $view = view('admin.attribute-values.add', [
            'attributeConfigs' => $attributeConfigs,
            'attributes' => $attributes,
            'existingValuesGrouped' => $existingValuesGrouped,
        ])->render();

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

        // Basic validation rules
        $rules = [
            'attribute_id' => 'required|exists:attributes,id',
            'attribute_values' => 'required|array|min:1',
            'attribute_values.*.title' => 'nullable|string|max:255',
            'attribute_values.*.icon_class' => 'nullable|string|max:255',
            'attribute_values.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'attribute_values.*.custom_input_label' => 'nullable|string',
            'attribute_values.*.is_composite' => 'nullable|boolean',
            'attribute_values.*.composed_of' => 'nullable|array',
            'attribute_values.*.fixed_extra_charges' => 'nullable|boolean',
            'attribute_values.*.required_file_uploads' => 'nullable|integer|min:0',
        ];

        if (!$attribute->has_image_dependency) {
            $rules['attribute_values.*.value'] = 'required_without_all:attribute_values.*.image_portrait,attribute_values.*.image_landscape';
        } else {
            // No 'value' required if has_image_dependency = true
            $rules['attribute_values.*.value'] = 'nullable';
        }

        if ($requireBothImages) {
            $rules['attribute_values.*.image_portrait'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
            $rules['attribute_values.*.image_landscape'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        // Validate parent images inputs per parent attribute and parent value
        if ($attribute->has_image_dependency && $request->has('attribute_values')) {
            foreach ($request->attribute_values as $idx => $valueData) {
                if (!empty($valueData['parent_images'])) {
                    foreach ($valueData['parent_images'] as $parentAttrId => $parentValues) {
                        foreach ($parentValues as $parentValueId => $parentImageData) {
                            $fileInputKey = "attribute_values.$idx.parent_images.$parentAttrId.$parentValueId.file";
                            $hasFile = $request->hasFile($fileInputKey);
                            // Parent image file input is optional if checkbox enabled, adjust as needed
                            if (!empty($parentImageData['enabled']) && $hasFile) {
                                $rules[$fileInputKey] = 'image|mimes:jpeg,png,jpg,webp|max:2048';
                            }
                            // Validate orientation required if enabled
                            $orientationKey = "attribute_values.$idx.parent_images.$parentAttrId.$parentValueId.orientation";
                            if (!empty($parentImageData['enabled'])) {
                                $rules[$orientationKey] = 'required|in:portrait,landscape';
                            }
                        }
                    }
                }
            }
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
                'is_composite_value' => !empty($valueData['is_composite']),
                'fixed_extra_charges' => !empty($valueData['fixed_extra_charges']),
                'required_file_uploads' => $valueData['required_file_uploads'] ?? null,
            ];

            if ($requireBothImages) {
                if ($request->hasFile("attribute_values.{$index}.image_portrait")) {
                    $data['image_portrait_path'] = $request->file("attribute_values.{$index}.image_portrait")->store('attribute_values', 'public');
                }
                if ($request->hasFile("attribute_values.{$index}.image_landscape")) {
                    $data['image_landscape_path'] = $request->file("attribute_values.{$index}.image_landscape")->store('attribute_values', 'public');
                }
                $data['value'] = $valueData['title'] ?? null;
            } elseif (in_array($inputType, ['select_image', 'select_icon'])) {
                if ($request->hasFile("attribute_values.{$index}.value")) {
                    $data['image_path'] = $request->file("attribute_values.{$index}.value")->store('attribute_values', 'public');
                }
                $data['value'] = $valueData['title'] ?? null;
            } else {
                $data['value'] = $valueData['value'] ?? null;
            }

            if ($request->hasFile("attribute_values.{$index}.image")) {
                $data['image_path'] = $request->file("attribute_values.{$index}.image")->store('attribute_values', 'public');
            }

            if ($inputType === 'select_colour') {
                $data['value'] = $valueData['value'] ?? null;
                $data['colour_code'] = $valueData['colour_code'] ?? null;
            }

            $attributeValue = AttributeValue::create($data);

            // Handle composite components sync
            if (!empty($valueData['is_composite']) && !empty($valueData['composed_of'])) {
                $componentIds = array_map('intval', $valueData['composed_of']);
                $attributeValue->components()->sync($componentIds);
            }

            // Handle parent image dependencies - save uploaded files and save records accordingly
            if (!empty($valueData['parent_images'])) {
                foreach ($valueData['parent_images'] as $parentAttrId => $parentValues) {
                    foreach ($parentValues as $parentValueId => $parentImageData) {
                        // Only if enabled and file uploaded
                        if (!empty($parentImageData['enabled']) && $request->hasFile("attribute_values.{$index}.parent_images.{$parentAttrId}.{$parentValueId}.file")) {
                            $file = $request->file("attribute_values.{$index}.parent_images.{$parentAttrId}.{$parentValueId}.file");
                            $path = $file->store('attribute_values/parent_images', 'public');

                            // Save or create attributeValueParentImage record (you must create this model/table)
                            \App\Models\AttributeValueParentImage::create([
                                'attribute_value_id' => $attributeValue->id,
                                'parent_attribute_id' => $parentAttrId,
                                'parent_attribute_value_id' => $parentValueId,
                                'image_path' => $path,
                                'orientation' => $parentImageData['orientation'] ?? null,
                            ]);
                        }
                    }
                }
            }
        }

        return $this->respondSuccess($request, 'Attribute value(s) created successfully.');
    }



    public function edit($id)
    {
        $attributeValue = AttributeValue::with('parentImages')->findOrFail($id);
        $attribute = Attribute::with('imageParentsWithValues')->findOrFail($attributeValue->attribute_id);

        $attributeConfigs = [
            $attribute->id => [
                'has_image' => $attribute->has_image,
                'has_icon' => $attribute->has_icon,
                'input_type' => $attribute->input_type,
                'custom_input_type' => $attribute->custom_input_type,
                'is_composite' => $attribute->is_composite,
                'require_both_images' => $attribute->require_both_images,
                'has_image_dependency' => $attribute->has_image_dependency,
                'required_file_uploads' => $attribute->required_file_uploads,
                'imageParents' => $attribute->imageParentsWithValues->map(function ($parentAttr) {
                    return [
                        'id' => $parentAttr->id,
                        'name' => $parentAttr->name,
                        'values' => $parentAttr->values->map(function ($val) {
                            return [
                                'id' => $val->id,
                                'value' => $val->value,
                                'title' => $val->title,
                            ];
                        }),
                    ];
                }),
            ],
        ];

        // Prepare existing parent images structured for JS use
        $parentImagesData = [];
        foreach ($attributeValue->parentImages as $pi) {
            $parentImagesData[$pi->parent_attribute_id][$pi->parent_attribute_value_id] = [
                'id' => $pi->id,
                'image_path' => $pi->image_path,
                'preview' => $pi->image_path ? asset('storage/' . $pi->image_path) : null,
                'orientation' => $pi->orientation,
            ];
        }

        $data = [
            'attributeValue' => $attributeValue,
            'attribute' => $attribute,
            'attributeConfigs' => $attributeConfigs,
            'parentImagesData' => $parentImagesData,
            // Other data like available values for composite, etc.
        ];

        if ($attribute->is_composite) {
            $availableValues = AttributeValue::where('attribute_id', $attribute->id)
                ->where('id', '!=', $attributeValue->id)->get();

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
            'fixed_extra_charges' => 'nullable|boolean',
            'required_file_uploads' => 'nullable|integer|min:0',
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
            'custom_input_label',
            'required_file_uploads',
        ]);

        $data['fixed_extra_charges'] = $request->boolean('fixed_extra_charges');
        $data['is_composite_value'] = $request->boolean('is_composite_value');

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

        // Sync composite components if applicable
        if ($data['is_composite_value']) {
            $components = $request->input('composed_of', []);
            $attributeValue->components()->sync($components);
        } else {
            $attributeValue->components()->detach();
        }

        // Handle parent image dependencies update
        // dd($request->parent_images);
        if ($request->has('parent_images')) {
            $existingParentImages = $attributeValue->parentImages()->get()->keyBy(function ($item) {
                return $item->parent_attribute_id . '-' . $item->parent_attribute_value_id;
            });

            $newKeys = [];
            foreach ($request->parent_images as $parentAttrId => $parentValues) {
                foreach ($parentValues as $parentValueId => $parentImageData) {
                    $key = $parentAttrId . '-' . $parentValueId;
                    $newKeys[] = $key;

                    if (!empty($parentImageData['enabled'])) {
                        if ($existingParentImages->has($key)) {
                            // dd($existingParentImages->has($key));
                            $existing = $existingParentImages->get($key);

                            if ($request->hasFile("parent_images.{$parentAttrId}.{$parentValueId}.file")) {
                                // Update file
                                $file = $request->file("parent_images.{$parentAttrId}.{$parentValueId}.file");
                                $path = $file->store('attribute_values/parent_images', 'public');
                                $existing->image_path = $path;
                            }
                            $existing->orientation = $parentImageData['orientation'] ?? $existing->orientation;
                            $existing->save();
                        } else {
                            // Create new
                            if ($request->hasFile("parent_images.{$parentAttrId}.{$parentValueId}.file")) {
                                $file = $request->file("parent_images.{$parentAttrId}.{$parentValueId}.file");
                                $path = $file->store('attribute_values/parent_images', 'public');
                                AttributeValueParentImage::create([
                                    'attribute_value_id' => $attributeValue->id,
                                    'parent_attribute_id' => $parentAttrId,
                                    'parent_attribute_value_id' => $parentValueId,
                                    'image_path' => $path,
                                    'orientation' => $parentImageData['orientation'] ?? null,
                                ]);
                            }
                        }
                    } else {
                        // If not enabled and exists, delete it
                        if ($existingParentImages->has($key)) {
                            $existingParentImages->get($key)->delete();
                        }
                    }
                }
            }

            // Delete any existing entries that are NOT in the new keys (if needed)
            foreach ($existingParentImages as $key => $existing) {
                if (!in_array($key, $newKeys)) {
                    $existing->delete();
                }
            }
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
