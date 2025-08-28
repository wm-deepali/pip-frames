<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\PricingRule;
use App\Models\PricingRuleAttribute;
use App\Models\PricingRuleAttributeQuantity;
use App\Models\PricingRuleQuantity;
use App\Models\Subcategory;
use App\Models\SubcategoryAttribute;
use App\Models\SubcategoryAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PricingRuleAttributeDependency;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PricingRuleController extends Controller
{

    public function index()
    {
        $rules = PricingRule::with([
            'category',
            'subcategory',
            'attributes.attribute',
            'attributes.value',
            'attributes.quantityRanges',
            'attributes.dependencies.parentAttribute',
            'attributes.dependencies.parentValue',
        ])->latest()->get();

        // Collect all non-null pages_dragger_dependency IDs
        $dependencyAttrIds = $rules->pluck('pages_dragger_dependency')->filter()->unique();

        // Get those attributes and key them by ID
        $dependencyAttrs = Attribute::whereIn('id', $dependencyAttrIds)->get()->keyBy('id');

        // dd($rules->toArray());
        return view('admin.pricing-rules.index', compact('rules', 'dependencyAttrs'));
    }

    public function show($id)
    {
        $rule = PricingRule::with([
            'category',
            'subcategory',
            'attributes.attribute',
            'attributes.value',
            'attributes.quantityRanges',
            'attributes.dependencies.parentAttribute',
            'attributes.dependencies.parentValue',
        ])->latest()->find($id);

        // Collect all non-null pages_dragger_dependency IDs
        $dependencyAttrIds = $rule->pluck('pages_dragger_dependency')->filter()->unique();

        // Get those attributes and key them by ID
        $dependencyAttrs = Attribute::whereIn('id', $dependencyAttrIds)->get()->keyBy('id');

        // dd($rules->toArray());
        return view('admin.pricing-rules.view', compact('rule', 'dependencyAttrs'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->get();
        return view('admin.pricing-rules.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rows = $request->input('rows', []);
        $attributeInputTypes = [];

        foreach ($rows as $i => $row) {
            $attribute = \App\Models\Attribute::find($row['attribute_id'] ?? null);
            $attributeInputTypes[$i] = $attribute ? $attribute->input_type : null;
        }

        $rules = [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'pages_dragger_required' => 'nullable',
            'pages_dragger_dependency' => 'nullable|numeric',
            'default_quantity' => 'nullable|integer|min:1',
            'proof_reading_required' => 'nullable|boolean',
            'delivery_charges_required' => 'nullable|boolean',
            'centralized_paper_rates' => 'nullable|boolean',
            'centralized_weight_rates' => 'nullable|boolean',
            'min_quantity' => 'nullable|integer|min:1|lte:max_quantity',
            'max_quantity' => 'nullable|integer|min:1|gte:min_quantity',
            'min_pages' => 'nullable|integer|min:1|lte:max_pages',
            'max_pages' => 'nullable|integer|min:1|gte:min_pages',

            'default_pages' => [
                'nullable',
                'integer',
                'min:1',
                Rule::requiredIf($request->pages_dragger_required == '1'),
            ],

            'rows' => 'array',
        ];

        foreach ($rows as $i => $row) {
            $rules["rows.$i.attribute_id"] = 'required|exists:attributes,id';

            if ($attributeInputTypes[$i] === 'select_area') {
                $rules["rows.$i.max_width"] = 'nullable|numeric|min:0.1';
                $rules["rows.$i.max_height"] = 'nullable|numeric|min:0.1';
                $rules["rows.$i.min_width"] = 'nullable|numeric|min:0.1';
                $rules["rows.$i.min_height"] = 'nullable|numeric|min:0.1';
            } else {
                $rules["rows.$i.value_id"] = 'required|exists:attribute_values,id';
            }

            $rules["rows.$i.dependency_value_ids"] = 'nullable|array';
            $rules["rows.$i.dependency_value_ids.*"] = 'nullable|exists:attribute_values,id';
            $rules["rows.$i.modifier_type"] = 'nullable|in:add,multiply';
            $rules["rows.$i.modifier_value"] = 'nullable|numeric';
            $rules["rows.$i.base_charges_type"] = 'nullable|in:amount,percentage';
            $rules["rows.$i.flat_rate_per_page"] = 'nullable|numeric|min:0';
            $rules["rows.$i.extra_copy_charge"] = 'nullable|numeric|min:0';
            $rules["rows.$i.extra_copy_charge_type"] = 'nullable|in:amount,percentage';
            $rules["rows.$i.is_default"] = 'nullable|boolean';

            if (!empty($row['per_page_pricing'])) {
                foreach ($row['per_page_pricing'] as $j => $pricing) {
                    $rules["rows.$i.per_page_pricing.$j.quantity_from"] = 'required|integer|min:1';
                    $rules["rows.$i.per_page_pricing.$j.quantity_to"] = "required|integer|min:1|gte:rows.$i.per_page_pricing.$j.quantity_from";
                    $rules["rows.$i.per_page_pricing.$j.price"] = 'required|numeric|min:0';
                }
            }
        }

        $request->validate($rules);



        DB::beginTransaction();

        try {
            $pricingRule = PricingRule::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'pages_dragger_required' => (int) $request->pages_dragger_required,
                'pages_dragger_dependency' => $request->pages_dragger_dependency ?? null,
                'default_quantity' => $request->default_quantity ?? null,
                'default_pages' => $request->default_pages ?? null,
                'min_quantity' => $request->min_quantity ?? null,
                'max_quantity' => $request->max_quantity ?? null,
                'min_pages' => $request->min_pages ?? null,
                'max_pages' => $request->max_pages ?? null,
                'proof_reading_required' => (int) $request->proof_reading_required,
                'delivery_charges_required' => (int) $request->delivery_charges_required,
                'centralized_paper_rates' => (int) $request->centralized_paper_rates,
                'centralized_weight_rates' => (int) $request->centralized_weight_rates,
            ]);

            foreach ($request->rows as $row) {
                $attribute = PricingRuleAttribute::create([
                    'pricing_rule_id' => $pricingRule->id,
                    'attribute_id' => $row['attribute_id'],
                    'value_id' => $row['value_id'] ?? null,
                    // 'dependency_value_id' => $row['dependency_value_id'] ?? null,
                    'price_modifier_type' => $row['modifier_type'] ?? 'add',
                    'price_modifier_value' => $row['modifier_value'] ?? 0,
                    'is_default' => isset($row['is_default']) && $row['is_default'] ? 1 : 0,
                    'base_charges_type' => $row['base_charges_type'] ?? null,
                    'extra_copy_charge' => $row['extra_copy_charge'] ?? null,
                    'extra_copy_charge_type' => $row['extra_copy_charge_type'] ?? null,
                    'flat_rate_per_page' => $row['flat_rate_per_page'] ?? null,

                    'max_width' => $row['max_width'] ?? null,
                    'max_height' => $row['max_height'] ?? null,
                    'min_width' => $row['min_width'] ?? null,
                    'min_height' => $row['min_height'] ?? null,
                ]);

                // Save quantity ranges if provided
                if (!empty($row['per_page_pricing'])) {
                    foreach ($row['per_page_pricing'] as $range) {
                        PricingRuleAttributeQuantity::create([
                            'pricing_rule_attribute_id' => $attribute->id,
                            'quantity_from' => $range['quantity_from'],
                            'quantity_to' => $range['quantity_to'],
                            'price' => $range['price'],
                        ]);
                    }
                }
                if (!empty($row['dependency_value_ids'])) {
                    foreach ($row['dependency_value_ids'] as $parentAttrId => $valueId) {
                        if ($valueId) {
                            PricingRuleAttributeDependency::create([
                                'pricing_rule_attribute_id' => $attribute->id,
                                'parent_attribute_id' => $parentAttrId,
                                'parent_value_id' => $valueId,
                            ]);
                        }
                    }
                }

            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Pricing rule created successfully!',
                'redirect' => route('admin.pricing-rules.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(PricingRule $pricingRule)
    {
        $pricingRule->load([
            'attributes.attribute',
            'attributes.value',
            'attributes.quantityRanges',
            'attributes.dependencies',
            'subcategory',
            'category'
        ]);
        $subcategoryAttributes = SubcategoryAttribute::with('attribute.parents')
            ->where('subcategory_id', $pricingRule->subcategory_id)
            ->get();

        $attributes = $subcategoryAttributes->map(function ($sa) {
            // Fetch filtered values
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
                'area_unit' => $sa->attribute->area_unit ?? 'inch',
                'values' => $values,
                'pricing_basis' => $sa->attribute->pricing_basis,
                'has_setup_charge' => $sa->attribute->has_setup_charge,
                'has_dependency' => $sa->attribute->has_dependency,
                'dependency_parents' => $sa->attribute->parents->pluck('id'),
            ];

        });
        // dd($pricingRule->toArray());
        return view('admin.pricing-rules.edit', [
            'pricingRule' => $pricingRule,
            'subcategoryAttributes' => $attributes,
        ]);
    }


    public function update(Request $request, PricingRule $pricingRule)
    {
        // dd($request->all());
        $rows = $request->input('rows', []);

        $rules = [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'pages_dragger_required' => 'nullable|boolean',
            'pages_dragger_dependency' => 'nullable|numeric',
            'default_quantity' => 'nullable|integer|min:1',
            'proof_reading_required' => 'nullable|boolean',
            'delivery_charges_required' => 'nullable|boolean',
            'min_quantity' => 'nullable|integer|min:1|lte:max_quantity',
            'max_quantity' => 'nullable|integer|min:1|gte:min_quantity',
            'min_pages' => 'nullable|integer|min:1|lte:max_pages',
            'max_pages' => 'nullable|integer|min:1|gte:min_pages',
            'centralized_paper_rates' => 'nullable|boolean',
            'centralized_weight_rates' => 'nullable|boolean',
            'default_pages' => [
                'nullable',
                'integer',
                'min:1',
                Rule::requiredIf($request->pages_dragger_required == '1'),
            ],
            'rows' => 'nullable|array',
        ];

        foreach ($rows as $i => $row) {
            $attributeId = $row['attribute_id'] ?? null;
            $attribute = \App\Models\Attribute::find($attributeId);
            $inputType = $attribute?->input_type;

            $rules["rows.$i.id"] = 'nullable|exists:pricing_rule_attributes,id';
            $rules["rows.$i.attribute_id"] = 'required|exists:attributes,id';

            // Conditionally require value_id
            if ($inputType !== 'select_area') {
                $rules["rows.$i.value_id"] = 'required|exists:attribute_values,id';
            } else {
                $rules["rows.$i.value_id"] = 'nullable';
                $rules["rows.$i.max_width"] = 'nullable|numeric|min:0.1';
                $rules["rows.$i.max_height"] = 'nullable|numeric|min:0.1';
                $rules["rows.$i.min_width"] = 'nullable|numeric|min:0.1';
                $rules["rows.$i.min_height"] = 'nullable|numeric|min:0.1';
            }

            $rules["rows.$i.dependency_value_ids"] = 'nullable|array';
            $rules["rows.$i.dependency_value_ids.*"] = 'nullable|exists:attribute_values,id';

            $rules["rows.$i.modifier_type"] = 'nullable|in:add,multiply';
            $rules["rows.$i.modifier_value"] = 'nullable|numeric';

            $rules["rows.$i.base_charges_type"] = 'nullable|in:amount,percentage';
            $rules["rows.$i.flat_rate_per_page"] = 'nullable|numeric|min:0';
            $rules["rows.$i.extra_copy_charge"] = 'nullable|numeric|min:0';
            $rules["rows.$i.extra_copy_charge_type"] = 'nullable|in:amount,percentage';
            $rules["rows.$i.is_default"] = 'nullable|in:1';

            // Loop per_page_pricing for this row
            if (!empty($row['per_page_pricing']) && is_array($row['per_page_pricing'])) {
                foreach ($row['per_page_pricing'] as $j => $pricing) {
                    $rules["rows.$i.per_page_pricing.$j.quantity_from"] = 'required|integer|min:1';
                    $rules["rows.$i.per_page_pricing.$j.quantity_to"] = 'required|integer|min:1|gte:rows.' . $i . '.per_page_pricing.' . $j . '.quantity_from';
                    $rules["rows.$i.per_page_pricing.$j.price"] = 'required|numeric|min:0';
                    $rules["rows.$i.per_page_pricing.$j.id"] = 'nullable|exists:pricing_rule_attribute_quantities,id';
                }
            }
        }

        Validator::make($request->all(), $rules)->validate();

        // dd((int) $request->delivery_charges_required);
        DB::beginTransaction();

        try {
            // Update main pricing rule
            $pricingRule->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'pages_dragger_required' => filter_var($request->pages_dragger_required, filter: FILTER_VALIDATE_BOOLEAN),
                'pages_dragger_dependency' => $request->pages_dragger_dependency ?? null,
                'default_quantity' => $request->default_quantity ?? null,
                'default_pages' => $request->default_pages ?? null,
                'min_quantity' => $request->min_quantity ?? null,
                'max_quantity' => $request->max_quantity ?? null,
                'min_pages' => $request->min_pages ?? null,
                'max_pages' => $request->max_pages ?? null,
                'proof_reading_required' => filter_var($request->proof_reading_required, filter: FILTER_VALIDATE_BOOLEAN),
                'delivery_charges_required' => filter_var($request->delivery_charges_required, filter: FILTER_VALIDATE_BOOLEAN),
                'centralized_paper_rates' => filter_var($request->centralized_paper_rates, filter: FILTER_VALIDATE_BOOLEAN),
                'centralized_weight_rates' => filter_var($request->centralized_weight_rates, filter: FILTER_VALIDATE_BOOLEAN),
            ]);

            foreach ($request->input('rows', []) as $row) {
                $data = [
                    'attribute_id' => $row['attribute_id'],
                    'value_id' => $row['value_id'] ?? null,
                    // 'dependency_value_id' => $row['dependency_value_id'] ?? null,
                    'price_modifier_type' => $row['modifier_type'] ?? 'add',
                    'price_modifier_value' => $row['modifier_value'] ?? 0,
                    'is_default' => isset($row['is_default']) ? 1 : 0,
                    'base_charges_type' => $row['base_charges_type'] ?? null,
                    'extra_copy_charge' => $row['extra_copy_charge'] ?? null,
                    'extra_copy_charge_type' => $row['extra_copy_charge_type'] ?? null,
                    'flat_rate_per_page' => $row['flat_rate_per_page'] ?? null,

                    'max_width' => $row['max_width'] ?? null,
                    'max_height' => $row['max_height'] ?? null,
                    'min_width' => $row['min_width'] ?? null,
                    'min_height' => $row['min_height'] ?? null,
                ];

                if (!empty($row['id'])) {
                    // Update existing attribute
                    $attribute = $pricingRule->attributes()->where('id', $row['id'])->first();
                    $attribute->update($data);
                } else {
                    // Create new attribute
                    $attribute = $pricingRule->attributes()->create($data);
                }

                // Handle per_page_pricing
                $submittedRangeIds = [];

                if (!empty($row['per_page_pricing']) && is_array($row['per_page_pricing'])) {
                    // dd($row['per_page_pricing']);
                    foreach ($row['per_page_pricing'] as $range) {
                        if (!empty($range['quantity_from']) && !empty($range['quantity_to']) && isset($range['price'])) {
                            if (!empty($range['id'])) {
                                // Update existing range
                                $attribute->quantityRanges()->updateOrCreate(
                                    ['id' => $range['id']],
                                    [
                                        'quantity_from' => $range['quantity_from'],
                                        'quantity_to' => $range['quantity_to'],
                                        'price' => $range['price'],
                                    ]
                                );
                                $submittedRangeIds[] = $range['id'];
                            } else {
                                // Create new range
                                $newRange = $attribute->quantityRanges()->create([
                                    'quantity_from' => $range['quantity_from'],
                                    'quantity_to' => $range['quantity_to'],
                                    'price' => $range['price'],
                                ]);
                                $submittedRangeIds[] = $newRange->id;
                            }
                        }
                    }

                    // Delete ranges that were removed
                    $attribute->quantityRanges()
                        ->whereNotIn('id', $submittedRangeIds)
                        ->delete();
                }

                if (!empty($row['dependency_value_ids'])) {
                    $submittedDepKeys = [];

                    foreach ($row['dependency_value_ids'] as $parentAttrId => $valueId) {
                        if ($valueId) {
                            $submittedDepKeys[] = $parentAttrId;

                            // Update if exists, otherwise create
                            PricingRuleAttributeDependency::updateOrCreate(
                                [
                                    'pricing_rule_attribute_id' => $attribute->id,
                                    'parent_attribute_id' => $parentAttrId,
                                ],
                                ['parent_value_id' => $valueId]
                            );
                        }
                    }

                    // Delete dependencies that were not submitted (i.e., removed)
                    PricingRuleAttributeDependency::where('pricing_rule_attribute_id', $attribute->id)
                        ->whereNotIn('parent_attribute_id', $submittedDepKeys)
                        ->delete();
                }

            }

            // 1. Handle deleted rows
            $rawDeletedIds = $request->input('deleted_ids', []);
            $deletedIds = [];

            foreach ($rawDeletedIds as $item) {
                if (is_string($item) && str_starts_with($item, '[')) {
                    $decoded = json_decode($item, true);
                    if (is_array($decoded)) {
                        $deletedIds = array_merge($deletedIds, $decoded);
                    }
                } else {
                    $deletedIds[] = $item;
                }
            }

            if (!empty($deletedIds)) {
                PricingRuleAttributeQuantity::whereIn('pricing_rule_attribute_id', $deletedIds)->delete();
                PricingRuleAttributeDependency::whereIn('pricing_rule_attribute_id', $deletedIds)->delete();
                $pricingRule->attributes()->whereIn('id', $deletedIds)->delete();
            }



            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pricing rule updated successfully!',
                'redirect' => route('admin.pricing-rules.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update pricing rule.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(PricingRule $pricingRule)
    {
        DB::beginTransaction();
        try {
            // Delete related quantity ranges
            $pricingRule->quantities()->delete();

            // Delete related attribute modifiers
            $pricingRule->attributes()->delete();

            // Delete the pricing rule itself
            $pricingRule->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Rule deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete the rule.']);
        }
    }

}
