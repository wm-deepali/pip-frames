<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubcategoryAttributeValue;
use App\Models\Subcategory;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class SubcategoryAttributeValueController extends Controller
{
    public function index()
    {
        $entries = SubcategoryAttributeValue::with(['subcategory', 'attribute', 'value'])->latest()->get();
        return view('admin.subcategory-attribute-values.index', compact('entries'));
    }

    public function create()
    {
        $subcategories = Subcategory::orderBy('name')->get();
        $attributes    = Attribute::orderBy('name')->get();
        $values        = AttributeValue::orderBy('value')->get();
        return view('admin.subcategory-attribute-values.create', compact('subcategories', 'attributes', 'values'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id'      => 'required|exists:subcategories,id',
            'attribute_id'        => 'required|exists:attributes,id',
            'attribute_value_id'  => 'required|exists:attribute_values,id',
            'is_default'          => 'sometimes|boolean',
        ]);

        SubcategoryAttributeValue::create($request->only([
            'subcategory_id', 'attribute_id', 'attribute_value_id', 'is_default'
        ]));

        return redirect()->route('admin.subcategory-attribute-values.index')
                         ->with('success', 'Entry created.');
    }

    public function edit(SubcategoryAttributeValue $subcategoryAttributeValue)
    {
        $subcategories = Subcategory::orderBy('name')->get();
        $attributes    = Attribute::orderBy('name')->get();
        $values        = AttributeValue::orderBy('value')->get();
        return view('admin.subcategory-attribute-values.edit', compact(
            'subcategoryAttributeValue', 'subcategories', 'attributes', 'values'
        ));
    }

    public function update(Request $request, SubcategoryAttributeValue $subcategoryAttributeValue)
    {
        $request->validate([
            'subcategory_id'      => 'required|exists:subcategories,id',
            'attribute_id'        => 'required|exists:attributes,id',
            'attribute_value_id'  => 'required|exists:attribute_values,id',
            'is_default'          => 'sometimes|boolean',
        ]);

        $subcategoryAttributeValue->update($request->only([
            'subcategory_id', 'attribute_id', 'attribute_value_id', 'is_default'
        ]));

        return redirect()->route('admin.subcategory-attribute-values.index')
                         ->with('success', 'Entry updated.');
    }

    public function destroy(SubcategoryAttributeValue $subcategoryAttributeValue)
    {
        $subcategoryAttributeValue->delete();
        return redirect()->route('admin.subcategory-attribute-values.index')
                         ->with('success', 'Entry deleted.');
    }
}
