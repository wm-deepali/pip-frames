<?php
namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Blog;
use App\Models\CentralizedAttributePricing;
use App\Models\DeliveryCharge;
use App\Models\ExtraOption;
use App\Models\ImageCondition;
use App\Models\PricingRule;
use App\Models\ProofReading;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Vat;
use Illuminate\Http\Request;
use App\Models\PricingRuleAttribute;
use App\Models\AttributeValue;

class SiteController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        $testimonials = Testimonial::where('status', 'active')->latest()->get();
        $sliders = Slider::where('status', 'active')->latest()->get();

        return view('front.index', compact('blogs', 'testimonials', 'sliders'));
    }


    public function show($slug)
    {
        // Find the category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Get subcategories related to the found category's id and with status active
        $subcategories = Subcategory::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })
            ->where('status', 'active')
            ->latest()
            ->get();

        $extraOptions = ExtraOption::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        // For debugging
        // dd($subcategories->toArray(), $category->id, $slug);

        return view('front.category-detail', compact('subcategories', 'extraOptions', 'category'));
    }

    public function attributes(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|integer|exists:subcategories,id',
        ]);

        $subcategoryId = $request->input('subcategory_id');

        // 1. Load subcategory attributes grouped by step
        $subcategoryAttributes = \App\Models\SubcategoryAttribute::with('attribute')
            ->where('subcategory_id', $subcategoryId)
            ->orderBy('step_number')
            ->orderBy('sort_order')
            ->get();

        $stepsGrouped = $subcategoryAttributes->groupBy('step_number');

        // 2. Load attribute values mapped by attribute_id
        $attributeValuesMap = \App\Models\SubcategoryAttributeValue::with('value')
            ->where('subcategory_id', $subcategoryId)
            ->get()
            ->groupBy('attribute_id');

        // Build steps array with attributes and their values
        $steps = [];
        foreach ($stepsGrouped as $stepNumber => $attributes) {
            $sortedAttributes = $attributes->sortBy('sort_order');
            $steps[$stepNumber] = $sortedAttributes->map(function ($sa) use ($attributeValuesMap) {
                $attr = $sa->attribute;
                $values = $attributeValuesMap[$attr->id] ?? collect();

                return [
                    'id' => $attr->id,
                    'name' => $attr->name,
                    'input_type' => $attr->input_type,
                    'is_required' => $sa->is_required,
                    'area_unit' => $attr->area_unit ?? 'inch',
                    'require_both_images' => $attr->require_both_images,
                    'required_file_uploads' => $attr->required_file_uploads,
                    'has_image_dependency' => $attr->has_image_dependency,
                    'main_frame_changes' => $attr->main_frame_changes,
                    'values' => $values->map(function ($sav) use ($attr) {
                        $valueData = [
                            'id' => $sav->value->id,
                            'value' => $sav->value->value,
                            'colour_code' => $sav->value->colour_code,
                            'image_path' => $sav->value->image_path ?? null,
                            'image_portrait_path' => $sav->value->image_portrait_path ?? null,
                            'image_landscape_path' => $sav->value->image_landscape_path ?? null,
                            'required_file_uploads' => $sav->value->required_file_uploads ?? 1,
                        ];

                        // Only if dependency is enabled
                        if ($attr->has_image_dependency) {
                            $valueData['parent_images'] = \App\Models\AttributeValueParentImage::where('attribute_value_id', $sav->value->id)
                                ->with(['parentAttribute', 'parentAttributeValue'])
                                ->get()
                                ->map(function ($img) {
                                    return [
                                        'id' => $img->id,
                                        'parent_attribute_id' => $img->parent_attribute_id,
                                        'parent_attribute_value_id' => $img->parent_attribute_value_id,
                                        'image_path' => $img->image_path,
                                        'orientation' => $img->orientation,
                                        'parent_attribute' => $img->parentAttribute?->name,
                                        'parent_value' => $img->parentAttributeValue?->value,
                                    ];
                                });
                        }

                        return $valueData;
                    })->values(),
                ];
            })->values();
        }

        // 3. Load all attribute conditions for this subcategory
        $attributeConditions = \App\Models\AttributeCondition::with('affectedValues')
            ->where('subcategory_id', $subcategoryId)
            ->get()
            ->map(function ($cond) {
                return [
                    'parent_attribute_id' => $cond->parent_attribute_id,
                    'parent_value_id' => $cond->parent_value_id,
                    'affected_attribute_id' => $cond->affected_attribute_id,
                    'action' => $cond->action,
                    'affected_value_ids' => $cond->affectedValues->pluck('id')->toArray(),
                ];
            });

        // dd($steps);
        // Return attributes grouped by steps and all conditions to apply on frontend
        return response()->json([
            'success' => true,
            'steps' => $steps,
            'attribute_conditions' => $attributeConditions,
        ]);
    }

    // public function AttributeImages(Request $request)
    // {
    //     $request->validate([
    //         'category_id' => 'required|exists:subcategories,id',
    //     ]);

    //     $subcategoryId = $request->category_id;

    //     $conditions = ImageCondition::with(['dependencies', 'affectedValues'])->where('subcategory_id', $subcategoryId)->get();

    //     $response = [];

    //     foreach ($conditions as $condition) {
    //         foreach ($condition->affectedValues as $affectedValue) {
    //             // Build combination mapping: dependency_attribute_id => value_id
    //             $combination = [];

    //             foreach ($condition->dependencies as $dep) {
    //                 $combination[$dep->attribute_id] = $dep->value_id;
    //             }

    //             // Add the current affected value
    //             $combination[$condition->affected_attribute_id] = $affectedValue->value_id;

    //             $response[] = [
    //                 'condition_id' => $condition->id, // renamed for clarity
    //                 'combination' => $combination,
    //                 'image' => $affectedValue->image ? asset('storage/' . $affectedValue->image) : null,
    //                 'orientation' => $affectedValue->orientation,
    //                 'affected_attribute_id' => $condition->affected_attribute_id,
    //                 'affected_value_id' => $affectedValue->value_id,
    //             ];
    //         }
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'conditions' => $response,
    //     ]);
    // }

    // public function getAllImageConditions(Request $request)
    // {
    //     $request->validate([
    //         'category_id' => 'required|integer|exists:subcategories,id', // or 'subcategories' if applicable
    //     ]);

    //     $categoryId = $request->category_id;

    //     $conditions = ImageCondition::with(['dependencies', 'affectedValues'])
    //         ->where('subcategory_id', $categoryId) // filter by category ID
    //         ->get();

    //     $response = [];

    //     foreach ($conditions as $condition) {
    //         $deps = $condition->dependencies->map(function ($dep) {
    //             return [
    //                 'attribute_id' => $dep->attribute_id,
    //                 'value_id' => $dep->value_id,
    //             ];
    //         });

    //         $affectedVals = $condition->affectedValues->map(function ($val) use ($condition) {
    //             return [
    //                 'affected_attribute_id' => $condition->affected_attribute_id,
    //                 'affected_value_id' => $val->value_id,
    //                 'image' => $val->image ? asset('storage/' . $val->image) : null,
    //                 'orientation' => $val->orientation,
    //             ];
    //         });

    //         $response[] = [
    //             'id' => $condition->id,
    //             'dependencies' => $deps,
    //             'affected_values' => $affectedVals,
    //         ];
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'conditions' => $response,
    //     ]);
    // }

    public function calculatePrice(Request $request)
    {
        $selections = json_decode($request->input('selections'), true);
        $categoryId = $request->input('category_id');

        if (!$selections || !$categoryId) {
            return response()->json([
                'success' => false,
            ]);
        }

        // Fetch the first pricing rule for the category including dependencies
        $pricingRule = \App\Models\PricingRule::where('subcategory_id', $categoryId)
            ->with(['attributes.dependencies'])
            ->first();

        if (!$pricingRule) {
            return response()->json([
                'success' => true,
                'price' => "0.00"
            ]);
        }

        $totalPrice = 0;

        foreach ($pricingRule->attributes as $ruleAttr) {
            $attrId = $ruleAttr->attribute_id;

            // Skip if attribute not selected
            if (!isset($selections[$attrId])) {
                continue;
            }

            // Check dependencies (if any)
            $dependencies = $ruleAttr->dependencies;
            $dependencySatisfied = true;

            foreach ($dependencies as $dependency) {
                $parentAttrId = $dependency->parent_attribute_id;
                $parentValueId = $dependency->parent_value_id;
                if (!isset($selections[$parentAttrId]) || $selections[$parentAttrId] != $parentValueId) {
                    $dependencySatisfied = false;
                    break;
                }
            }

            if (!$dependencySatisfied) {
                // Skip pricing this attribute because dependency not met
                continue;
            }

            $selectedValue = $selections[$attrId];
            if (is_array($selectedValue) && isset($selectedValue['height']) && isset($selectedValue['width'])) {
                $width = floatval($selectedValue['width']);
                $height = floatval($selectedValue['height']);


                // Round up height and width to nearest even number
                $height = roundUpToEven($height);
                $width = roundUpToEven($width);

                // Check max height and width limits if applicable
                $errors = [];

                if ($ruleAttr->max_height !== null && $height > $ruleAttr->max_height) {
                    $errors[$ruleAttr->attribute_id]['height'] = "max height: " . number_format($ruleAttr->max_height, 0) . " sq_inch";
                }
                if ($ruleAttr->max_width !== null && $width > $ruleAttr->max_width) {
                    $errors[$ruleAttr->attribute_id]['width'] = "max width " . number_format($ruleAttr->max_width, 0) . " sq_inch";
                }

                if ($ruleAttr->min_height !== null && $height < $ruleAttr->min_height) {
                    $errors[$ruleAttr->attribute_id]['height'] = "min height " . number_format($ruleAttr->min_height, 0) . " sq_inch";
                }
                if ($ruleAttr->min_width !== null && $width < $ruleAttr->min_width) {
                    $errors[$ruleAttr->attribute_id]['width'] = "min width " . number_format($ruleAttr->min_width, 0) . " sq_inch";
                }
                if ($errors) {
                    return response()->json(['success' => false, 'errors' => $errors]);
                }


                $area = $height * $width;

                // Calculate area-based price: price per sq inch * area
                $pricePerSqInch = $ruleAttr->price_modifier_value;
                $totalPrice += $area * $pricePerSqInch;

            } else {
                // Simple value price
                $valueId = $ruleAttr->value_id;
                if ($selectedValue == $valueId) {
                    $modifier = $ruleAttr->price_modifier_value;

                    if ($ruleAttr->price_modifier_type === 'add') {
                        $totalPrice += $modifier;
                    } elseif ($ruleAttr->price_modifier_type === 'percent') {
                        $totalPrice += $totalPrice * $modifier / 100;
                    }
                    // Add more modifier types as needed
                }
            }
        }

        return response()->json([
            'success' => true,
            'price' => number_format($totalPrice, 2)
        ]);
    }


    public function shopCategories()
    {
        $shpcategories = Category::with('subcategories')->where('status', 'active')->get();
        return view('front.shop-categories', compact('shpcategories'));

    }



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