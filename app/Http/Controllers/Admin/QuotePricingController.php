<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binding;
use App\Models\BookmarkRibbon;
use App\Models\BookType;
use App\Models\CoverFinish;
use App\Models\CoverFoiling;
use App\Models\CoverPrintingColour;
use App\Models\CoverType;
use App\Models\CoverWeight;
use App\Models\DustJacketColour;
use App\Models\DustJacketFinish;
use App\Models\EndpaperColour;
use App\Models\HeadAndTailBand;
use App\Models\Orientation;
use App\Models\PaperSize;
use App\Models\PaperType;
use App\Models\PaperWeight;
use App\Models\PrintingColour;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Quote;

class QuotePricingController extends Controller
{
    public function index()
    {
        // $quotes = Quote::with(['category', 'subCategory'])->latest()->get();
        $quotes = [];
        return view('admin.quote_pricing.index', compact('quotes'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('admin.quote_pricing.create', compact('categories', 'subcategories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'enable_options' => 'nullable|array',
        ]);
        // dd($validated['subcategory_id']);
        // Save quote
        $quote = Quote::create([
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'enabled_options' => json_encode($validated['enable_options'] ?? []), // Save enabled masters
            'status' => 'draft',
        ]);
        return response()->json([
            'success' => true,
            'redirect' => route('admin.quote-pricing.step2', $quote->id),
        ]);

    }


    public function step2(Quote $quote)
    {
        $enabledOptions = $quote->enabled_options ?? '[]';
        $enabledOptionsArray = json_decode($enabledOptions, true) ?? [];

        // Define categories mapping
        $optionGroups = [
            'paper' => [
                'book_type' => ['Book Type', BookType::class],
                'printing_colour' => ['Printing Colour', PrintingColour::class],
                'orientation' => ['Orientation', Orientation::class],
                'paper_size' => ['Paper Size', PaperSize::class],
                'paper_type' => ['Paper Type', PaperType::class],
                'paper_weight' => ['Paper Weight', PaperWeight::class],
                'binding' => ['Binding', Binding::class],
            ],
            'cover' => [
                'cover_type' => ['Cover Type', CoverType::class],
                'cover_weight' => ['Cover Weight', CoverWeight::class],
                'cover_printing_colour' => ['Cover Printing Colour', CoverPrintingColour::class],
                'cover_finish' => ['Cover Finish', CoverFinish::class],
                'endpaper_colour' => ['Endpaper Colour', EndpaperColour::class],
                'cover_foiling' => ['Cover Foiling', CoverFoiling::class],
            ],
            'dust' => [
                'dust_jacket_colour' => ['Dust Jacket Colour', DustJacketColour::class],
                'dust_jacket_finish' => ['Dust Jacket Finish', DustJacketFinish::class],
            ],
            'other' => [
                'bookmark_ribbon' => ['Bookmark Ribbon', BookmarkRibbon::class],
                'head_and_tail_band' => ['Head and Tail Band', HeadAndTailBand::class],
            ],
        ];

        $masters = [];

        foreach ($optionGroups as $group => $options) {
            foreach ($options as $key => [$label, $model]) {
                if (in_array($key, $enabledOptionsArray)) {
                    $masters[$group][$label] = $model::all();
                }
            }
        }

        // Load dynamic field rules from config
        $fieldRules = config('quote_option_fields');

        // Build structured selected options per group
        $selectedOptions = [];
        foreach ($masters as $group => $groupOptions) {
            foreach ($groupOptions as $label => $options) {
                $selectedOptions[$group][$label] = [
                    'fields' => $fieldRules[$label] ?? ['price'],
                    'options' => $options,
                ];
            }
        }

        return view('admin.quote_pricing.step2', compact('quote', 'selectedOptions'));
    }



    public function step2Save(Request $request, Quote $quote)
    {
        $data = [];

        foreach ($request->input('option_values', []) as $label => $optionIds) {
            foreach ($optionIds as $index => $optionId) {
                if (!$optionId)
                    continue; // skip empty selections

                $entry = [
                    'label' => $label,
                    'option_id' => $optionId,
                    'min_pages' => $request->input("min_pages.$label")[$index] ?? null,
                    'max_pages' => $request->input("max_pages.$label")[$index] ?? null,
                    'min_qty' => $request->input("min_qty.$label")[$index] ?? null,
                    'price' => $request->input("price.$label")[$index] ?? null,
                ];

                $data[] = $entry;
            }
        }

        // 💾 Store in DB – either update a quote_pricings table or save as JSON in quote
        // Example: Store as JSON in the quote model (you can customize this)
        $quote->pricing_details = json_encode($data);
        $quote->save();

        return redirect()->route('admin.quote-pricing.index')->with('success', 'Pricing saved successfully.');
    }



}

