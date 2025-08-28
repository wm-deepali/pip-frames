<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        // dd($request->all());
        // Validate inputs - adjust rules as needed
        $request->validate([
            'photos.*' => 'nullable|image|max:5120', // max 5MB per photo
            'extra_option' => 'nullable|string|in:digital,skip',
            'pet_name' => 'nullable|string|max:255',
            'pet_birthdate' => 'nullable|string|max:255',
            'personal_text' => 'nullable|string|max:1000',
            'note' => 'nullable|string|max:2000',
            'attributes' => 'nullable|array',
        ]);

        // Retrieve cart from session or initialize empty array
        $cart = session()->get('cart', []);

        $extraOptionIds = $request->input('extra_options', []);
        $extraOptions = \App\Models\ExtraOption::whereIn('id', $extraOptionIds)->get();
        $extraOptionsData = $extraOptions->map(fn($opt) => [
            'id' => $opt->id,
            'title' => $opt->title,
            'type' => $opt->type,
            'price' => $opt->price,
        ])->toArray();


        // Prepare item data
        $item = [
            'photos' => [],
            'extra_options' => $extraOptionsData,
            'extra_option' => $request->input('extra_option', 'digital'),
            'pet_name' => $request->input('pet_name', ''),
            'pet_birthdate' => $request->input('pet_birthdate', ''),
            'personal_text' => $request->input('personal_text', ''),
            'note' => $request->input('note', ''),
            'attributes' => $request->input('attributes', []), // attributes array with selections
            'added_at' => now(),
            'subcategory_id' => $request->input('subcategory_id'),
            'total_price' => $request->input('total_price', 0),
        ];

        // Handle uploaded photos - store on disk or keep temporary path as needed
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo && $photo->isValid()) {
                    $path = $photo->store('cart_photos', 'public');
                    $item['photos'][] = $path;
                }
            }
        }

        // Add item to cart array
        $cart[] = $item;

        // Save updated cart in session
        session(['cart' => $cart]);

        // Respond with success JSON
        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully',
            'cart_count' => count($cart),
        ]);
    }

    public function cart()
    {

        // Retrieve cart items from session
        $cart = session()->get('cart', []);

        // Fetch attribute metadata from database or cache (adjust model/table names accordingly)
        $attributesData = \App\Models\Attribute::with('values')->get()->keyBy('id');

        // Preload subcategories (to avoid multiple queries)
        $subcategories = \App\Models\Subcategory::pluck('name', 'id');


        // Prepare enriched cart items with attribute names and values
        $enrichedCart = [];

        foreach ($cart as $item) {
            $itemAttributes = [];

            if (!empty($item['attributes'])) {
                foreach ($item['attributes'] as $attrId => $attrValue) {
                    if (!isset($attributesData[$attrId])) {
                        continue;
                    }

                    $attribute = $attributesData[$attrId];
                    $attrName = $attribute->name;

                    // Handle attribute value
                    // For simple value (single id)
                    if (is_string($attrValue) || is_int($attrValue)) {
                        $valueData = $attribute->values->where('id', $attrValue)->first();
                        $valueName = $valueData ? $valueData->value : $attrValue;
                    }
                    // For area type attributes with 'height' and 'width'
                    elseif (is_array($attrValue) && isset($attrValue['height'], $attrValue['width'])) {
                        $valueName = "Height: {$attrValue['height']}, Width: {$attrValue['width']}";
                    } else {
                        $valueName = json_encode($attrValue);
                    }

                    $itemAttributes[] = [
                        'name' => $attrName,
                        'value' => $valueName,
                    ];
                }
            }

            // Attach subcategory name
            $subcategoryName = $subcategories[$item['subcategory_id']] ?? 'Unknown';

            $enrichedCart[] = [
                'item' => $item,
                'attributes' => $itemAttributes,
                'subcategory_name' => $subcategoryName, 
            ];
        }
        // dd($enrichedCart);
        // Pass enriched cart to view
        $categories = Category::latest()->get();
        $firstCategory = $categories->first();
        return view('front.cart', compact('enrichedCart', 'firstCategory'));
    }

    public function update(Request $request, $index)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$index])) {
            return redirect()->route('cart')->withErrors('Item not found in cart.');
        }

        $action = $request->input('action');

        $quantity = $cart[$index]['quantity'] ?? 1;

        if ($action === 'increase') {
            $quantity++;
        } elseif ($action === 'decrease') {
            $quantity = max(1, $quantity - 1);
        }

        $cart[$index]['quantity'] = $quantity;

        // Optionally update item total price here based on quantity

        session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    public function remove(Request $request, $index)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$index])) {
            return redirect()->route('cart')->withErrors('Item not found in cart.');
        }

        array_splice($cart, $index, 1);

        session()->put('cart', $cart);

        return redirect()->route('cart');
    }


    public function check(Request $request)
    {
        $postcode = trim($request->input('postcode'));

        if (!$postcode) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter a postcode.'
            ], 422);
        }

        $postcodeEntry = PostalCode::where('pincode', $postcode)->first();

        if (!$postcodeEntry) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Sorry, we do not recognize this postcode.'
            ]);
        }

        if (!$postcodeEntry->is_serviceable) {
            return response()->json([
                'status' => 'not_serviceable',
                'message' => 'We found your postcode, but unfortunately we do not deliver to this area yet.',
                'postcode' => $postcodeEntry->pincode,
                'city' => $postcodeEntry->city,
                'state' => $postcodeEntry->state,
                'country' => $postcodeEntry->country,
            ]);
        }

        session()->put('cart.postcode', $postcode);
        return response()->json([
            'status' => 'serviceable',
            'message' => 'Great news! We deliver to your area.',
            'postcode' => $postcodeEntry->pincode,
            'city' => $postcodeEntry->city,
            'state' => $postcodeEntry->state,
            'country' => $postcodeEntry->country,
            'delivery_charge' => $postcodeEntry->delivery_charge,
        ]);
    }


}
