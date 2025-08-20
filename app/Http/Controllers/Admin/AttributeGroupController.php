<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeGroup;
use Illuminate\Support\Facades\Validator;

class AttributeGroupController extends Controller
{
    public function index()
    {
        $attributeGroups = AttributeGroup::with('attributes')->latest()->get();
        return view('admin.attribute-groups.index', compact('attributeGroups'));

    }

    public function create()
    {
        $attributes = \App\Models\Attribute::all();
        return response()->json([
            'success' => true,
            'html' => view('admin.attribute-groups.create', [
                'action' => route('admin.attribute-groups.store'),
                'attributes' => $attributes,
            ])->render(),
        ]);
    }

    public function store(Request $request)
    {
        // ✅ Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'attribute_ids' => 'required|array',
            'attribute_ids.*' => 'exists:attributes,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        // ✅ Create the attribute group
        $group = AttributeGroup::create([
            'name' => $request->name,
        ]);

        // ✅ Attach selected attributes to the group
        $group->attributes()->attach($request->attribute_ids);

        return $request->ajax()
            ? response()->json(['success' => true, 'message' => 'Attribute group created and attributes mapped.'])
            : redirect()->route('admin.attribute-groups.index')->with('success', 'Attribute group created and attributes mapped.');
    }


    public function edit($id)
    {
        $group = AttributeGroup::with('attributes')->findOrFail($id);
        $allAttributes = Attribute::all();

        return response()->json([
            'success' => true,
            'html' => view('admin.attribute-groups.edit', [
                'group' => $group,
                'attributes' => $allAttributes,
                'action' => route('admin.attribute-groups.update', $group->id),
            ])->render(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'attribute_ids' => 'required|array',
            'attribute_ids.*' => 'exists:attributes,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $group = AttributeGroup::findOrFail($id);
        $group->update(['name' => $request->name]);
        $group->attributes()->sync($request->attribute_ids);

        return response()->json(['success' => true, 'message' => 'Group updated successfully']);
    }

    public function destroy($id)
    {
        $group = AttributeGroup::findOrFail($id);
        $group->attributes()->detach();
        $group->delete();

        return response()->json(['success' => true]);
    }
}
