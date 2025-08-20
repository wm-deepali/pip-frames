<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use App\Models\Subcategory;
use App\Models\AttributeGroupSubcategoryAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeGroupSubcategoryAssignmentController extends Controller
{
    public function index()
    {
        $assignments = AttributeGroupSubcategoryAssignment::with(['group', 'subcategory'])
            ->orderBy('subcategory_id')
            ->orderBy('sort_order')
            ->get();

        return view('admin.group-assignments.index', compact('assignments'));
    }

    public function create()
    {
        $attributeGroups = AttributeGroup::all();
        $subcategories = Subcategory::all();

        return response()->json([
            'success' => true,
            'html' => view('admin.group-assignments.create', [
                'assignment' => null,
                'subcategories' => $subcategories,
                'attributeGroups' => $attributeGroups,
            ])->render(),
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attribute_group_id' => 'required|exists:attribute_groups,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'sort_order' => 'nullable|integer',
            'is_toggleable' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        AttributeGroupSubcategoryAssignment::create([
            'attribute_group_id' => $request->attribute_group_id,
            'subcategory_id' => $request->subcategory_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_toggleable' => $request->boolean('is_toggleable'),
        ]);

        return $request->ajax()
            ? response()->json(['success' => true, 'message' => 'Group Assignment created.'])
            : redirect()->route('admin.group-assignments.index')->with('success', 'Group Assignment created.');
    }

    public function edit($id)
    {
        $assignment = AttributeGroupSubcategoryAssignment::findOrFail($id);
        $attributeGroups = AttributeGroup::all();
        $subcategories = Subcategory::all();

        return response()->json([
            'success' => true,
            'html' => view('admin.group-assignments.create', [
                'assignment' => $assignment,
                'subcategories' => $subcategories,
                'attributeGroups' => $attributeGroups,
                'action' => route('admin.group-assignments.update', $assignment->id),
            ])->render(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $assignment = AttributeGroupSubcategoryAssignment::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'attribute_group_id' => 'required|exists:attribute_groups,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'sort_order' => 'nullable|integer',
            'is_toggleable' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $assignment->update([
            'attribute_group_id' => $request->attribute_group_id,
            'subcategory_id' => $request->subcategory_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_toggleable' => $request->boolean('is_toggleable'),
        ]);

        return $request->ajax()
            ? response()->json(['success' => true, 'message' => 'Assignment updated successfully.'])
            : redirect()->route('admin.group-assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy($id)
    {
        $assignment = AttributeGroupSubcategoryAssignment::findOrFail($id);
        $assignment->delete();

        return response()->json(['success' => true]);
    }
}
