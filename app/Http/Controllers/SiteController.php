<?php
namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Blog;
use App\Models\CentralizedAttributePricing;
use App\Models\DeliveryCharge;
use App\Models\PricingRule;
use App\Models\ProofReading;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Vat;
use Illuminate\Http\Request;
use App\Models\PricingRuleAttribute;
use App\Models\AttributeValue;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')->get();
        $blogs = Blog::where('status', 'published')  // if you have status
            ->latest()
            ->take(6)
            ->get();

        return view('front.index', compact('categories', 'blogs'));
    }


    // public function subcateDetails($slug){
    //     $subcategory = Subcategory::with('details')->where('slug', $slug)->where('status', 'active')->first();
    //     return view('front.subcategory-detail', compact('subcategory'));

    // }

    public function subcateDetails($slug)
    {
        $subcategory = Subcategory::with('details')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $subcategoryId = $subcategory->id;

        // NEW: Check if calculator is required
        $calculatorRequired = $subcategory->calculator_required;

        $attributeGroups = collect();
        $conditionsMap = collect();
        $pagesDraggerRequired = null;
        $pagesDraggerAttributeId = null;
        $compositeDraggerValues = collect();
        $compositeMap = collect();
        $quantityDefaults = [
            'default' => null,
            'min' => null,
            'max' => null,
        ];

        $pagesDefaults = [
            'default' => null,
            'min' => null,
            'max' => null,
        ];

        $deliveryCharges = collect();
        $deliveryChargesRequired = false;
        $proofReadingRequired = false;
        $proofReadings = collect();


        if ($calculatorRequired) {
            $pricingRule = PricingRule::where('subcategory_id', $subcategoryId)->first();

            if ($pricingRule) {
                $quantityDefaults = [
                    'default' => $pricingRule->default_quantity ?? null,
                    'min' => $pricingRule->min_quantity ?? null,
                    'max' => $pricingRule->max_quantity ?? null,
                ];

                $pagesDraggerRequired = $pricingRule->pages_dragger_required;

                if ($pagesDraggerRequired) {
                    $pagesDefaults['default'] = $pricingRule->default_pages ?? 1;
                    $pagesDefaults['min'] = $pricingRule->min_pages ?? 1;
                    $pagesDefaults['max'] = $pricingRule->max_pages ?? 840;

                    $pagesDraggerAttributeId = $pricingRule->pages_dragger_dependency;
                }

                if ($pagesDraggerAttributeId) {
                    $attribute = \App\Models\Attribute::find($pagesDraggerAttributeId);
                    if ($attribute && $attribute->is_composite) {
                        $compositeDraggerValues = \App\Models\SubcategoryAttributeValue::with('value.components')
                            ->where('subcategory_id', $subcategoryId)
                            ->where('attribute_id', $pagesDraggerAttributeId)
                            ->get()
                            ->filter(fn($sav) => $sav->value->is_composite_value)
                            ->map(function ($sav) {
                                return [
                                    'id' => $sav->value->id,
                                    'value' => $sav->value->value,
                                    'component_count' => $sav->value->components->count(),
                                    'components' => $sav->value->components->pluck('value')->toArray(),
                                ];
                            })
                            ->values();
                    }
                }

                $deliveryChargesRequired = $pricingRule->delivery_charges_required;
                if ($deliveryChargesRequired) {
                    $deliveryCharges = DeliveryCharge::orderByDesc('is_default')
                        ->orderBy('no_of_days')
                        ->get();
                }

                $proofReadingRequired = $pricingRule->proof_reading_required;
                if ($proofReadingRequired) {
                    $proofReadings = ProofReading::get();
                }
            }


            // Fetch attribute groups and mappings
            $attributeValues = \App\Models\SubcategoryAttributeValue::with('value')
                ->where('subcategory_id', $subcategoryId)
                ->get()
                ->groupBy('attribute_id');

            $groupAssignments = \App\Models\AttributeGroupSubcategoryAssignment::with(['group', 'group.attributes'])
                ->where('subcategory_id', $subcategoryId)
                ->orderBy('sort_order', 'asc')
                ->get();

            $subcategoryAttributes = \App\Models\SubcategoryAttribute::with('attribute')
                ->where('subcategory_id', $subcategoryId)
                ->orderBy('sort_order')
                ->get();

            $subcategoryAttrMap = $subcategoryAttributes->keyBy('attribute_id');

            $mapAttributeData = function ($attribute, $is_required) use ($attributeValues, $pricingRule) {
                $values = $attributeValues[$attribute->id] ?? collect();
                $maxHeight = null;
                $maxWidth = null;
                $isDefault = false;

                if ($attribute->input_type === 'select_area' && $pricingRule) {
                    $pra = PricingRuleAttribute::where('pricing_rule_id', $pricingRule->id)
                        ->where('attribute_id', $attribute->id)
                        ->first();

                    if ($pra) {
                        $maxHeight = $pra->max_height;
                        $maxWidth = $pra->max_width;
                    }
                    // dd($pra->toArray(),$maxWidth, $maxHeight);
                }

                return [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'area_unit' => $attribute->area_unit ?? null,
                    'input_type' => $attribute->input_type,
                    'has_image' => $attribute->has_image,
                    'is_composite' => $attribute->is_composite,
                    'is_required' => (bool) $is_required,
                    'max_height' => $maxHeight,
                    'max_width' => $maxWidth,
                    'values' => $values->map(function ($sav) use ($attribute, $pricingRule, $isDefault) {
                        $valueId = $sav->value->id;

                        if ($pricingRule) {
                            $isDefault = PricingRuleAttribute::where('pricing_rule_id', $pricingRule->id)->where(function ($q) use ($attribute, $valueId) {
                                $q->where('attribute_id', $attribute->id)
                                    ->where('value_id', $valueId);
                            })
                                ->orWhereHas('dependencies', function ($q) use ($attribute, $valueId) {
                                    $q->where('parent_attribute_id', $attribute->id)
                                        ->where('parent_value_id', $valueId);
                                })
                                ->value('is_default');

                        }

                        return [
                            'id' => $valueId,
                            'value' => $sav->value->value,
                            'image_path' => $sav->value->image_path,
                            'is_default' => (bool) $isDefault,
                            'is_composite_value' => $sav->value->is_composite_value,
                        ];
                    }),
                ];
            };

            $attributeGroups = $groupAssignments->map(function ($assignment) use ($mapAttributeData, $subcategoryAttrMap) {
                return [
                    'group_name' => $assignment->group->name,
                    'sort_order' => $assignment->sort_order,
                    'is_toggleable' => $assignment->is_toggleable,
                    'attributes' => $assignment->group->attributes->map(function ($attr) use ($mapAttributeData, $subcategoryAttrMap) {
                        $is_required = $subcategoryAttrMap[$attr->id]->is_required ?? false;
                        return $mapAttributeData($attr, $is_required);
                    }),
                ];
            });

            $groupedAttributeIds = $groupAssignments
                ->flatMap(fn($ga) => $ga->group->attributes->pluck('id'))
                ->unique()
                ->toArray();

            $ungroupedAttributes = $subcategoryAttributes
                ->filter(function ($sa) use ($groupedAttributeIds) {
                    return !in_array($sa->attribute_id, $groupedAttributeIds);
                })
                ->map(fn($sa) => $mapAttributeData($sa->attribute, $sa->is_required));

            if ($ungroupedAttributes->isNotEmpty()) {
                $attributeGroups->prepend([
                    'group_name' => 'Main Attributes',
                    'sort_order' => 0,
                    'is_toggleable' => false,
                    'attributes' => $ungroupedAttributes->values(),
                ]);
            }

            $attributeConditions = \App\Models\AttributeCondition::with(['parentAttribute', 'parentValue', 'affectedAttribute', 'affectedValues'])
                ->where('subcategory_id', $subcategoryId)
                ->get();

            $conditionsMap = $attributeConditions->map(function ($cond) use ($subcategoryId) {
                $affectedValueIds = $cond->affectedValues->pluck('id')->toArray();

                $allValueIds = \App\Models\SubcategoryAttributeValue::where('subcategory_id', $subcategoryId)
                    ->where('attribute_id', $cond->affected_attribute_id)
                    ->pluck('attribute_value_id')
                    ->toArray();
                return [
                    'parent_attribute_id' => $cond->parent_attribute_id,
                    'parent_value_id' => $cond->parent_value_id,
                    'affected_attribute_id' => $cond->affected_attribute_id,
                    'affected_value_ids' => $affectedValueIds,
                    'all_values_affected' => !array_diff($allValueIds, $affectedValueIds),
                    'action' => $cond->action,
                ];
            });

            $compositeMap = collect($compositeDraggerValues)->pluck('component_count', 'id');
            $compositeMap = $compositeMap->prepend('-- Select --', '');
        }

        return view('front.subcategory-detail', compact(
            'subcategory',
            'attributeGroups',
            'conditionsMap',
            'pagesDraggerRequired',
            'pagesDraggerAttributeId',
            'compositeDraggerValues',
            'compositeMap',
            'quantityDefaults',
            'pagesDefaults',
            'deliveryChargesRequired',
            'deliveryCharges',
            'proofReadingRequired',
            'proofReadings'
        ));

    }

    public function shopCategories()
    {
        $shpcategories = Category::with('subcategories')->where('status', 'active')->get();
        return view('front.shop-categories', compact('shpcategories'));

    }

    public function calculate(Request $request)
    {
        $subcategoryId = $request->input('subcategory_id');
        $componentPages = [];
        $total = 0;

        // Step 1: Get the pricing rule for the subcategory
        $pricingRule = PricingRule::where('subcategory_id', $subcategoryId)->first();

        // Step 2: Early return if pricing rule doesn't exist
        if (!$pricingRule) {
            return response()->json([
                'success' => false,
                'message' => 'No pricing rule found for this subcategory.',
                'total_price' => 0,
                'formatted_price' => '£0.00',
            ]);
        }

        // Step 3: Check centralized flags
        $useCentralizedPaper = $pricingRule->centralized_paper_rates;
        $useCentralizedWeight = $pricingRule->centralized_weight_rates;


        // Step 4: Extract page count for component values inside composite values
        if ($request->has('composite_pages')) {
            foreach ($request->input('composite_pages') as $compositeValueId => $labelPages) {
                $composite = AttributeValue::with('components')->find($compositeValueId);
                if ($composite && $composite->is_composite_value) {
                    foreach ($composite->components as $component) {
                        $label = $component->value;
                        if (isset($labelPages[$label])) {
                            $componentPages[$component->id] = (int) $labelPages[$label];
                        }
                    }
                }
            }
        }

        $quantity = (int) $request->input('quantity', 1);
        $defaultPages = (int) $request->input('pages', 0);
        $selectedAttributes = $request->input('attributes', []); // [attribute_id => value_id]

        // Step 5: Expand composite values into individual components
        $expandedAttributes = [];
        foreach ($selectedAttributes as $attributeId => $valueData) {
            if (is_array($valueData) && isset($valueData['length'], $valueData['width'])) {
                // select_area field
                $expandedAttributes[$attributeId] = $valueData;
            } else {
                $value = AttributeValue::with('components')->find($valueData);
                if ($value && $value->is_composite_value) {
                    foreach ($value->components as $component) {
                        $expandedAttributes[$attributeId][] = $component->id;
                    }
                } else {
                    $expandedAttributes[$attributeId][] = $valueData;
                }
            }
        }

        // Step 6: Process each expanded value for pricing
        foreach ($expandedAttributes as $attributeId => $valueData) {
            $attribute = Attribute::find($attributeId);

            // Handle select_area fields
            if (is_array($valueData) && ($valueData['type'] ?? null) === 'select_area' && $attribute && $attribute->input_type === 'select_area') {
                $area = isset($valueData['area']) ? floatval($valueData['area']) : (
                    (isset($valueData['length'], $valueData['width'])) ? floatval($valueData['length']) * floatval($valueData['width']) : 0
                );

                $attrs = PricingRuleAttribute::with(['quantityRanges', 'attribute', 'dependencies'])
                    ->where('attribute_id', $attributeId)
                    ->where('pricing_rule_id', $pricingRule->id)
                    ->get();

                $validAttrs = $attrs->filter(function ($item) use ($selectedAttributes, $expandedAttributes) {
                    foreach ($item->dependencies as $dep) {
                        $selected = $selectedAttributes[$dep->parent_attribute_id] ?? null;
                        $matches = $expandedAttributes[$dep->parent_attribute_id] ?? ($selected ? [$selected] : []);
                        if (!in_array($dep->parent_value_id, $matches)) {
                            return false;
                        }
                    }
                    return true;
                });

                foreach ($validAttrs as $attr) {
                    $basis = $attr->attribute->pricing_basis ?? null;
                    $rangeInput = $quantity;

                    $range = $attr->quantityRanges->first(function ($r) use ($rangeInput) {
                        return $rangeInput >= $r->quantity_from && $rangeInput <= $r->quantity_to;
                    });

                    if (!$range && $attr->quantityRanges->isNotEmpty()) {
                        $range = $attr->quantityRanges->sortBy(function ($r) use ($rangeInput) {
                            return min(abs($rangeInput - $r->quantity_from), abs($rangeInput - $r->quantity_to));
                        })->first();
                    }

                    if ($range) {
                        $price = $range->price;
                        $total += $price * $area * $quantity;
                    }

                    if ($basis === 'per_extra_copy') {
                        $total += ($attr->extra_copy_charge ?? 0) * $area * $quantity;
                    }

                    if ($basis === 'fixed_per_page' || $basis === 'per_extra_copy') {
                        $total += ($attr->flat_rate_per_page ?? 0) * $area * $quantity;
                    }

                    if ($attr->attribute->has_setup_charge ?? false) {
                        $total += $attr->price_modifier_value ?? 0;
                    }
                }
            }

            // Handle normal (non-area) attributes
            elseif (is_array($valueData)) {
                foreach ($valueData as $valueId) {
                    // Decide whether to use centralized or regular pricing
                    if ($useCentralizedWeight && in_array(strtolower($attribute->name), ['paper weight'])) {
                        // Use Centralized Pricing
                        $attrs = CentralizedAttributePricing::with(['quantityRanges', 'attribute', 'dependencies'])
                            ->where('attribute_id', $attributeId)
                            ->where('value_id', $valueId)
                            ->get();

                        $validAttrs = $attrs->filter(function ($item) use ($selectedAttributes, $expandedAttributes) {
                            foreach ($item->dependencies as $dep) {
                                $selected = $selectedAttributes[$dep->attribute_id] ?? null;
                                $matches = $expandedAttributes[$dep->attribute_id] ?? ($selected ? [$selected] : []);
                                if (!in_array($dep->value_id, $matches)) {
                                    return false;
                                }
                            }
                            return true;
                        });


                        foreach ($validAttrs as $attr) {
                            $pages = $defaultPages;

                            foreach ($attr->dependencies as $dep) {
                                if (isset($componentPages[$dep->value_id])) {
                                    $pages = $componentPages[$dep->value_id];
                                    break; // Stop at the first match
                                }
                            }
                            // Default sheet count
                            $sheetCount = 1000;

                            // Try to fetch paper size attribute value from selectedAttributes
                            $paperSizeAttr = Attribute::whereRaw('LOWER(name) = ?', ['paper size'])->first();
                            if ($paperSizeAttr && isset($selectedAttributes[$paperSizeAttr->id])) {
                                $paperSizeValueId = $selectedAttributes[$paperSizeAttr->id];

                                // Handle array case
                                if (is_array($paperSizeValueId)) {
                                    $paperSizeValueId = $paperSizeValueId[0]; // Take first if multiple
                                }

                                $sheetInfo = \App\Models\Sra3SheetCount::where('attribute_value_id', $paperSizeValueId)->first();
                                // dd($sheetInfo);
                                if ($sheetInfo && $sheetInfo->sheet_count > 0) {
                                    $pages = $pages / $sheetInfo->sheet_count;
                                }
                                $pricePerSheet = ($attr->price ?? 0) / $sheetCount;
                                // dd($pricePerSheet);
                                $total += $pricePerSheet * $pages * $quantity;
                            } else {
                                $total += 0;
                            }

                        }

                    } elseif ($useCentralizedPaper && in_array(strtolower($attribute->name), ['paper size'])) {

                        $attrs = CentralizedAttributePricing::with(['quantityRanges', 'attribute', 'dependencies'])
                            ->where('attribute_id', $attributeId)
                            ->get();

                        $validAttrs = $attrs->filter(function ($item) use ($selectedAttributes, $expandedAttributes) {
                            foreach ($item->dependencies as $dep) {
                                $selected = $selectedAttributes[$dep->attribute_id] ?? null;
                                $matches = $expandedAttributes[$dep->attribute_id] ?? ($selected ? [$selected] : []);
                                if (!in_array($dep->value_id, $matches)) {
                                    return false;
                                }
                            }
                            return true;
                        });

                        foreach ($validAttrs as $attr) {
                            $pages = $defaultPages;

                            foreach ($attr->dependencies as $dep) {
                                if (isset($componentPages[$dep->value_id])) {
                                    $pages = $componentPages[$dep->value_id];
                                    break; // Stop at the first match
                                }
                            }
                            $rangeInput = $pages * $quantity;

                            $range = $attr->quantityRanges->first(function ($r) use ($rangeInput) {
                                return $rangeInput >= $r->quantity_from && $rangeInput <= $r->quantity_to;
                            });

                            if (!$range && $attr->quantityRanges->isNotEmpty()) {
                                $range = $attr->quantityRanges->sortBy(function ($r) use ($rangeInput) {
                                    return min(abs($rangeInput - $r->quantity_from), abs($rangeInput - $r->quantity_to));
                                })->first();
                            }

                            if ($range) {
                                $price = $range->price;
                                $sheetCount = 1;

                                // Try to fetch SRA3 sheet count for selected paper size
                                $paperSizeValueId = $valueId; // This is the selected paper size value
                                if (is_array($paperSizeValueId)) {
                                    $paperSizeValueId = $paperSizeValueId[0];
                                }

                                $sheetInfo = \App\Models\Sra3SheetCount::where('attribute_value_id', $paperSizeValueId)->first();
                                if ($sheetInfo && $sheetInfo->sheet_count > 0) {
                                    $sheetCount = $sheetInfo->sheet_count;
                                }

                                // Total number of SRA3 sheets needed
                                $sheetsNeeded = ($pages * $quantity) / $sheetCount;

                                // Final pricing
                                $total += $price * $sheetsNeeded;
                                // dd($total);
                            }
                        }

                    } else {
                        // dd($total);
                        // Use Regular Pricing
                        $attrs = PricingRuleAttribute::with(['quantityRanges', 'attribute', 'dependencies'])
                        ->where('attribute_id', $attributeId)
                        ->where('value_id', $valueId)
                        ->where('pricing_rule_id', $pricingRule->id)
                        ->get();
                        
                        
                        $validAttrs = $attrs->filter(function ($item) use ($selectedAttributes, $expandedAttributes) {
                            foreach ($item->dependencies as $dep) {
                                $selected = $selectedAttributes[$dep->parent_attribute_id] ?? null;
                                $matches = $expandedAttributes[$dep->parent_attribute_id] ?? ($selected ? [$selected] : []);
                                if (!in_array($dep->parent_value_id, $matches)) {
                                    return false;
                                }
                            }
                            return true;
                        });
                        // dd('here', $validAttrs->toArray());

                        foreach ($validAttrs as $attr) {
                            $basis = $attr->attribute->pricing_basis ?? null;
                            $pages = $defaultPages;
                            foreach ($attr->dependencies as $dep) {
                                if (isset($componentPages[$dep->parent_value_id])) {
                                    $pages = $componentPages[$dep->parent_value_id];
                                    break; // Stop at the first match
                                }
                            }
                            $rangeInput = ($basis === 'per_page') ? $pages * $quantity : $quantity;

                            $range = $attr->quantityRanges->first(function ($r) use ($rangeInput) {
                                return $rangeInput >= $r->quantity_from && $rangeInput <= $r->quantity_to;
                            });

                            if (!$range && $attr->quantityRanges->isNotEmpty()) {
                                $range = $attr->quantityRanges->sortBy(function ($r) use ($rangeInput) {
                                    return min(abs($rangeInput - $r->quantity_from), abs($rangeInput - $r->quantity_to));
                                })->first();
                            }

                            if ($range) {
                                $price = $range->price;
                                match ($basis) {
                                    'per_page' => $total += $price * $pages * $quantity,
                                    'per_product' => $total += $price * $quantity,
                                    default => null,
                                };
                            }

                            if ($basis === 'per_extra_copy') {
                                $total += ($attr->extra_copy_charge ?? 0) * $quantity;
                            }

                            if ($basis === 'fixed_per_page') {
                                $total += ($attr->flat_rate_per_page ?? 0) * $pages * $quantity;
                            }

                            if ($attr->attribute->has_setup_charge ?? false) {
                                $total += $attr->price_modifier_value ?? 0;
                            }
                        }

                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'total_price' => round($total, 2),
            'formatted_price' => '£' . number_format($total, 2),
        ]);
    }


    // public function calculate(Request $request)
    // {
    //     $componentPages = [];

    //     // Step 1: Extract page count for component values inside composite values
    //     if ($request->has('composite_pages')) {
    //         foreach ($request->input('composite_pages') as $compositeValueId => $labelPages) {
    //             $composite = AttributeValue::with('components')->find($compositeValueId);
    //             if ($composite && $composite->is_composite_value) {
    //                 foreach ($composite->components as $component) {
    //                     $label = $component->value;
    //                     if (isset($labelPages[$label])) {
    //                         $componentPages[$component->id] = (int) $labelPages[$label];
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     $quantity = (int) $request->input('quantity', 1);
    //     $defaultPages = (int) $request->input('pages', 0);
    //     $selectedAttributes = $request->input('attributes', []); // [attribute_id => value_id]

    //     // Step 2: Expand composite values into individual components
    //     $expandedAttributes = [];
    //     foreach ($selectedAttributes as $attributeId => $valueData) {
    //         if (is_array($valueData) && isset($valueData['length'], $valueData['width'])) {
    //             // This is a select_area field
    //             $expandedAttributes[$attributeId] = $valueData;
    //         } else {
    //             $value = AttributeValue::with('components')->find($valueData);
    //             if ($value && $value->is_composite_value) {
    //                 foreach ($value->components as $component) {
    //                     $expandedAttributes[$attributeId][] = $component->id;
    //                 }
    //             } else {
    //                 $expandedAttributes[$attributeId][] = $valueData;
    //             }
    //         }
    //     }

    //     $total = 0;

    //     // Step 3: Process each expanded value for pricing
    //     foreach ($expandedAttributes as $attributeId => $valueData) {
    //         $attribute = Attribute::find($attributeId);

    //         // Handle select_area
    //         if (is_array($valueData) && ($valueData['type'] ?? null) === 'select_area' && $attribute && $attribute->input_type === 'select_area') {
    //             $area = isset($valueData['area']) ? floatval($valueData['area']) : (
    //                 (isset($valueData['length'], $valueData['width'])) ? floatval($valueData['length']) * floatval($valueData['width']) : 0
    //             );

    //             // dd($area);
    //             $attrs = PricingRuleAttribute::with(['quantityRanges', 'attribute', 'dependencies'])
    //                 ->where('attribute_id', $attributeId)
    //                 ->get();

    //             $validAttrs = $attrs->filter(function ($item) use ($selectedAttributes, $expandedAttributes) {
    //                 foreach ($item->dependencies as $dep) {
    //                     $selected = $selectedAttributes[$dep->parent_attribute_id] ?? null;
    //                     $matches = $expandedAttributes[$dep->parent_attribute_id] ?? ($selected ? [$selected] : []);
    //                     if (!in_array($dep->parent_value_id, $matches)) {
    //                         return false;
    //                     }
    //                 }
    //                 return true;
    //             });

    //             foreach ($validAttrs as $attr) {
    //                 $basis = $attr->attribute->pricing_basis ?? null;
    //                 $rangeInput = $quantity;

    //                 $range = $attr->quantityRanges->first(function ($r) use ($rangeInput) {
    //                     return $rangeInput >= $r->quantity_from && $rangeInput <= $r->quantity_to;
    //                 });

    //                 if (!$range && $attr->quantityRanges->isNotEmpty()) {
    //                     $range = $attr->quantityRanges->sortBy(function ($r) use ($rangeInput) {
    //                         return min(abs($rangeInput - $r->quantity_from), abs($rangeInput - $r->quantity_to));
    //                     })->first();
    //                 }

    //                 if ($range) {
    //                     $price = $range->price;
    //                     $total += $price * $area * $quantity;

    //                 }
    //                 // dd($price);

    //                 if ($basis === 'per_extra_copy') {
    //                     $total += ($attr->extra_copy_charge ?? 0) * $area * $quantity;
    //                 }

    //                 if ($basis === 'fixed_per_page' || $basis === 'per_extra_copy') {
    //                     $total += ($attr->flat_rate_per_page ?? 0) * $area * $quantity;
    //                 }

    //                 if ($attr->attribute->has_setup_charge ?? false) {
    //                     $total += $attr->price_modifier_value ?? 0;
    //                 }
    //             }
    //         }

    //         // Else: regular attribute processing
    //         elseif (is_array($valueData)) {
    //             foreach ($valueData as $valueId) {
    //                 $attrs = PricingRuleAttribute::with(['quantityRanges', 'attribute', 'dependencies'])
    //                     ->where('attribute_id', $attributeId)
    //                     ->where('value_id', $valueId)
    //                     ->get();

    //                 $validAttrs = $attrs->filter(function ($item) use ($selectedAttributes, $expandedAttributes) {
    //                     foreach ($item->dependencies as $dep) {
    //                         $selected = $selectedAttributes[$dep->parent_attribute_id] ?? null;
    //                         $matches = $expandedAttributes[$dep->parent_attribute_id] ?? ($selected ? [$selected] : []);
    //                         if (!in_array($dep->parent_value_id, $matches)) {
    //                             return false;
    //                         }
    //                     }
    //                     return true;
    //                 });

    //                 foreach ($validAttrs as $attr) {
    //                     $basis = $attr->attribute->pricing_basis ?? null;
    //                     $pages = $componentPages[$attr->dependency_value_id] ?? $defaultPages;
    //                     $rangeInput = ($basis === 'per_page') ? $pages * $quantity : $quantity;

    //                     $range = $attr->quantityRanges->first(function ($r) use ($rangeInput) {
    //                         return $rangeInput >= $r->quantity_from && $rangeInput <= $r->quantity_to;
    //                     });

    //                     if (!$range && $attr->quantityRanges->isNotEmpty()) {
    //                         $range = $attr->quantityRanges->sortBy(function ($r) use ($rangeInput) {
    //                             return min(abs($rangeInput - $r->quantity_from), abs($rangeInput - $r->quantity_to));
    //                         })->first();
    //                     }

    //                     if ($range) {
    //                         $price = $range->price;
    //                         match ($basis) {
    //                             'per_page' => $total += $price * $pages * $quantity,
    //                             'per_product' => $total += $price * $quantity,
    //                             default => null,
    //                         };
    //                     }

    //                     // Apply any additional pricing logic
    //                     if ($basis === 'per_extra_copy') {
    //                         $total += ($attr->extra_copy_charge ?? 0) * $quantity;
    //                     }

    //                     if ($basis === 'fixed_per_page') {
    //                         $total += ($attr->flat_rate_per_page ?? 0) * $pages * $quantity;
    //                     }

    //                     if ($attr->attribute->has_setup_charge ?? false) {
    //                         $total += $attr->price_modifier_value ?? 0;
    //                     }
    //                 }
    //             }
    //             // original code for valueId processing (same as your existing loop)
    //         }
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'total_price' => round($total, 2),
    //         'formatted_price' => '£' . number_format($total, 2),
    //     ]);
    // }

}