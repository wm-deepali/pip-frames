<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::with('parents')->latest()->get();
        return view('admin.attributes.index', compact('attributes'));
    }
    public function create()
    {
        $attributes = Attribute::latest()->get(); // Fetch existing attributes

        return response()->json([
            'success' => true,
            'html' => view('admin.attributes.add', [
                'action' => route('admin.attributes.store'),
                'attributes' => $attributes, // Pass to view
            ])->render(),
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'attributes' => 'required|array',
            'attributes.*.name' => 'required|string|max:255|distinct|unique:attributes,name',
            'attributes.*.input_type' => 'required|in:dropdown,radio,select_image,select_area',
            'attributes.*.custom_input_type' => 'nullable|in:number,text,file,none',
            'attributes.*.has_image' => 'nullable|boolean',
            'attributes.*.has_icon' => 'nullable|boolean',
            'attributes.*.has_dependency' => 'nullable|boolean',
            // 'attributes.*.allow_quantity' => 'nullable|boolean',
            'attributes.*.is_composite' => 'nullable|boolean',
            'attributes.*.has_setup_charge' => 'nullable|boolean',
            'attributes.*.pricing_basis' => 'nullable|string|in:per_page,per_product,per_extra_copy,fixed_per_page',
            'attributes.*.detail' => 'nullable|string|max:1000',
            'attributes.*.dependency_parent' => 'nullable|array',
            'attributes.*.dependency_parent.*' => 'exists:attributes,id',
            'attributes.*.area_unit' => 'nullable|in:sq_inch,sq_feet,sq_meter',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $attributes = $request->input('attributes');

        // Loop through attributes and create them
        foreach ($attributes as $attr) {
            $attribute = Attribute::create([
                'name' => $attr['name'],
                'input_type' => $attr['input_type'],
                'custom_input_type' => $attr['custom_input_type'] ?? null,
                'area_unit' => $attr['area_unit'] ?? null,
                'pricing_basis' => $attr['pricing_basis'] ?? null,
                'detail' => $attr['detail'] ?? null,
                'has_image' => filter_var($attr['has_image'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'has_icon' => filter_var($attr['has_icon'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'has_dependency' => filter_var($attr['has_dependency'] ?? false, FILTER_VALIDATE_BOOLEAN),
                // 'allow_quantity' => filter_var($attr['allow_quantity'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'is_composite' => filter_var($attr['is_composite'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'has_setup_charge' => filter_var($attr['has_setup_charge'] ?? false, FILTER_VALIDATE_BOOLEAN),
                // 'dependency_parent' => $attr['dependency_parent'] ?? null,
            ]);

            // Save dependency parents
            if (!empty($attr['dependency_parent'])) {
                $attribute->parents()->sync($attr['dependency_parent']);
            }
        }

        // Return success response
        return $request->ajax()
            ? response()->json(['success' => true, 'message' => 'Attributes added.'])
            : redirect()->route('admin.attributes.index')->with('success', 'Attributes added.');
    }


    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attributes = Attribute::where('id', '!=', $id)->get(); // exclude current one

        return response()->json([
            'success' => true,
            'html' => view('admin.attributes.edit', [
                'attribute' => $attribute,
                'attributes' => $attributes,
                'action' => route('admin.attributes.update', $attribute->id),
            ])->render(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:attributes,name,' . $attribute->id,
            'input_type' => 'required|in:dropdown,radio,select_area,select_image',
            'has_image' => 'sometimes|boolean',
            'has_icon' => 'sometimes|boolean',
            'has_dependency' => 'sometimes|boolean',
            'pricing_basis' => 'nullable|string|in:per_page,per_product,per_extra_copy,fixed_per_page',
            'area_unit' => 'nullable|in:sq_inch,sq_feet,sq_meter',
            'detail' => 'nullable|string|max:1000',
            'is_composite' => 'sometimes|boolean',
            'custom_input_type' => 'nullable|in:number,text,file,none',
            // 'allow_quantity' => 'sometimes|boolean',
            'has_setup_charge' => 'sometimes|boolean',
            'dependency_parent' => 'nullable|array',
            'dependency_parent.*' => 'exists:attributes,id',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        // $allowQuantity = $request->input('allow_quantity', $request->input('allow_quantity_hidden'));

        $attribute->update([
            'name' => $request->name,
            'input_type' => $request->input_type,
            'has_image' => $request->boolean('has_image'),
            'has_icon' => $request->boolean('has_icon'),
            'has_dependency' => $request->boolean('has_dependency'),
            'area_unit' => $request->area_unit,
            'pricing_basis' => $request->pricing_basis,
            'detail' => $request->detail,
            'is_composite' => $request->boolean('is_composite'),
            'composite_input_type' => $request->custom_input_type,
            // 'allow_quantity' => (bool) $allowQuantity,
            'has_setup_charge' => $request->boolean('has_setup_charge'),
        ]);

        if ($request->has('dependency_parent')) {
            $attribute->parents()->sync($request->dependency_parent);
        } else {
            $attribute->parents()->detach();
        }

        return $request->ajax()
            ? response()->json(['success' => true, 'message' => 'Attribute updated successfully.'])
            : redirect()->route('admin.attributes.index')->with('success', 'Attribute updated successfully.');
    }

    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);

        $attribute->delete();

        return response()->json(['success' => true]);

    }
}
