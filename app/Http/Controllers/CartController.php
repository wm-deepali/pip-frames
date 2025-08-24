<?php

namespace App\Http\Controllers;


use App\Models\Attribute;
use App\Models\Customer;
use App\Models\DeliveryCharge;
use App\Models\PostalCode;
use App\Models\Quote;
use App\Models\QuoteBillingAddress;
use App\Models\QuoteDeliveryAddress;
use App\Models\QuoteDocument;
use App\Models\QuoteItem;
use App\Models\QuoteItemAttribute;
use App\Models\Subcategory;
use App\Models\Vat;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        // Prepare item data
        $item = [
            'photos' => [],
            'extra_option' => $request->input('extra_option', 'digital'),
            'pet_name' => $request->input('pet_name', ''),
            'pet_birthdate' => $request->input('pet_birthdate', ''),
            'personal_text' => $request->input('personal_text', ''),
            'note' => $request->input('note', ''),
            'attributes' => $request->input('attributes', []), // attributes array with selections
            'added_at' => now(),
            'subcategory_id' => $request->input('subcategory_id'),

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

            $enrichedCart[] = [
                'item' => $item,
                'attributes' => $itemAttributes,
            ];
        }
        // dd($enrichedCart);
        // Pass enriched cart to view
        return view('front.cart', compact('enrichedCart'));
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


    public function saveBeforeCheckout(Request $request)
    {
        $cart = session('cart.items');

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty.',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart data saved before checkout.',
        ]);
    }

    public function checkout()
    {
        $cart = session('cart', null);
        if (!isset($cart['items'])) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        $item = $cart['items'];
        $subcategory = Subcategory::find($item['subcategory_id']);
        $attributes = [];

        foreach ($item['attributes'] as $attrId => $val) {
            $attribute = Attribute::find($attrId);

            if (!$attribute)
                continue;

            if (is_array($val) && isset($val['type']) && $val['type'] === 'select_area') {
                $length = $val['length'] ?? null;
                $width = $val['width'] ?? null;
                $area = $val['area'] ?? null;
                $unit = $val['unit'] ?? '';

                $attributes[] = [
                    'attribute_name' => $attribute->name,
                    'value_name' => "{$area} {$unit} (L: {$length} × W: {$width})",
                ];
            } else {
                $value = AttributeValue::find($val);
                if ($value) {
                    $attributes[] = [
                        'attribute_name' => $attribute->name,
                        'value_name' => $value->value,
                    ];
                }
            }
        }

        $cart['attributes_resolved'] = $attributes;
        $cart['subcategory_name'] = $subcategory->name ?? 'Unknown';
        $cart['category_name'] = $subcategory->categories->first()->name ?? '';
        // dd($cart);
        return view('front.checkout', $cart);
    }


    public function clear(Request $request)
    {
        session()->forget('cart.items');
        session()->forget('cart.grand_total');

        return response()->json(['success' => true]);
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            // Billing fields
            'billing_email' => 'required|email',
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_mobile' => 'required|string|max:20',
            'billing_country' => 'required|integer',
            'billing_address' => 'nullable|string|max:500',

            // Delivery fields
            'delivery_first_name' => 'required|string|max:255',
            'delivery_last_name' => 'required|string|max:255',
            'delivery_mobile' => 'required|string|max:20',
            'delivery_country' => 'required|integer',
            'delivery_address' => 'nullable|string|max:500',

            // Optional
            'delivery_instructions' => 'nullable|string|max:500',
            'plain_packaging' => 'nullable|in:1',
            'same_as_billing' => 'nullable|in:1',
        ]);

        // Get existing cart from session
        $cart = session('cart', []);

        // Merge/overwrite billing info
        $cart['billing'] = array_merge($cart['billing'] ?? [], [
            'email' => $validated['billing_email'],
            'first_name' => $validated['billing_first_name'],
            'last_name' => $validated['billing_last_name'],
            'mobile' => $validated['billing_mobile'],
            'country' => $validated['billing_country'],
            'address' => $validated['billing_address'] ?? null,
        ]);

        // Handle delivery
        if (isset($validated['same_as_billing']) && $validated['same_as_billing'] == '1') {
            // Use billing as delivery if checkbox is ticked
            $cart['delivery_address'] = array_merge($cart['billing'], [
                'delivery_instructions' => $validated['delivery_instructions'] ?? null,
                'plain_packaging' => $validated['plain_packaging'] ?? null,
                'same_as_billing' => '1',
            ]);
        } else {
            // Normal delivery
            $cart['delivery_address'] = [
                'first_name' => $validated['delivery_first_name'],
                'last_name' => $validated['delivery_last_name'],
                'mobile' => $validated['delivery_mobile'],
                'country' => $validated['delivery_country'],
                'address' => $validated['delivery_address'] ?? null,
                'delivery_instructions' => $validated['delivery_instructions'] ?? null,
                'plain_packaging' => $validated['plain_packaging'] ?? null,
                'same_as_billing' => $validated['same_as_billing'] ?? null,
            ];
        }

        // Save back to session
        session()->put('cart', $cart);
        // dd($cart);
        return response()->json(['message' => 'Address updated successfully']);
    }

    public function getCartSession()
    {
        return response()->json(session('cart', []));
    }


    public function saveUploadedFile(Request $request)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart['quote_id'])) {
            return response()->json(['error' => 'Quote ID not found'], 422);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $type = $request->input('type'); // e.g. 'main', 'reference', etc.

            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/session', $filename, 'public');

            $fileInfo = [
                'path' => $path,
                'name' => $file->getClientOriginalName(),
                'type' => $type,
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ];

            if (!isset($cart['images'])) {
                $cart['images'] = [];
            }

            // ✅ If it's the main file, replace the old one
            if ($type === 'main') {
                // Remove any existing 'main' file
                $cart['images'] = array_filter($cart['images'], function ($img) {
                    return $img['type'] !== 'main';
                });
            }

            // Add new file
            $cart['images'][] = $fileInfo;

            // Save back to session
            session()->put('cart', $cart);
            return response()->json([
                'success' => true,
                'path' => $path,
                'name' => $file->getClientOriginalName(),
                'mime' => $file->getClientMimeType(),
                'type' => $type,
                'size' => $file->getSize()
            ]);
        }


        return response()->json(['success' => false, 'message' => 'No file uploaded.'], 400);
    }


    public function removeUploadedFile(Request $request)
    {
        $path = $request->input('path');
        $type = $request->input('type'); // 'main' or 'extra'

        $cart = session()->get('cart', []);

        if (!isset($cart['images'])) {
            return response()->json(['success' => false, 'message' => 'No images in session.']);
        }

        // Remove file from disk
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        // Filter out the removed image from session
        $cart['images'] = array_filter($cart['images'], function ($file) use ($path, $type) {
            return $file['path'] !== $path || $file['type'] !== $type;
        });

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }


    public function PayLater(Request $request)
    {
        $data = session()->get('cart', []);
        // dd($data);
        $customer = Customer::where('email', $data['billing']['email'])->first();
        // dd($customer);

        DB::beginTransaction();
        try {


            $dateString = $data['delivery']['date'];
            if ($dateString) {
                // Step 1: Remove weekday and ordinal suffix
                $cleaned = preg_replace('/\w{3},\s*(\d+)(st|nd|rd|th)\s+(\w+)/', '$1 $3', $dateString); // "1 Aug"

                // Step 2: Append current year
                $cleaned .= ' ' . now()->year; // "1 Aug 2025"

                // Step 3: Convert to Carbon date
                $date = Carbon::createFromFormat('j M Y', $cleaned);

                // Store in DB format
                $formattedDate = $date->format('Y-m-d'); // e.g. "2025-08-01"
            }

            // Create Quote
            $quote = Quote::create([
                'quote_number' => $data['quote_id'],
                'customer_id' => $customer->id, // Or use given customer
                'vat_amount' => $data['vat_amount'],
                'vat_percentage' => $data['vat_percentage'],
                'grand_total' => $data['grand_total'],
                'proof_type' => $data['proof']['proof_type'] ?? null,
                'proof_price' => $data['proof']['price'] ?? 0,
                'delivery_price' => $data['delivery']['price'] ?? 0,
                'delivery_date' => $formattedDate ?? null,
                'notes' => $data['details'] ?? null,
            ]);

            // Create QuoteItem
            $itemData = $data['items'];
            $quoteItem = QuoteItem::create([
                'quote_id' => $quote->id,
                'subcategory_id' => $itemData['subcategory_id'], // or get name from DB
                'quantity' => $itemData['quantity'],
                'pages' => $itemData['pages'],
                'sub_total' => $itemData['sub_total'],
            ]);

            // Save Attributes
            foreach ($itemData['attributes'] as $attrId => $valData) {
                if (is_array($valData) && isset($valData['type']) && $valData['type'] === 'select_area') {
                    QuoteItemAttribute::create([
                        'quote_item_id' => $quoteItem->id,
                        'attribute_id' => $attrId,
                        'value_id' => null,
                        'unit' => $valData['unit'] ?? null,
                        'length' => $valData['length'] ?? null,
                        'width' => $valData['width'] ?? null,
                    ]);
                } else {
                    QuoteItemAttribute::create([
                        'quote_item_id' => $quoteItem->id,
                        'attribute_id' => $attrId,
                        'value_id' => $valData,
                    ]);
                }
            }


            // Save Billing Address
            $billing = $data['billing'];
            QuoteBillingAddress::create([
                'quote_id' => $quote->id,
                'first_name' => $billing['first_name'],
                'last_name' => $billing['last_name'],
                'email' => $billing['email'],
                'mobile' => $billing['mobile'],
                'country' => $billing['country'],
                'address' => $billing['address'],
            ]);

            // Save Delivery Address
            $delivery = $data['delivery_address'];
            QuoteDeliveryAddress::create([
                'quote_id' => $quote->id,
                'first_name' => $delivery['first_name'],
                'last_name' => $delivery['last_name'],
                'mobile' => $delivery['mobile'],
                'country' => $delivery['country'],
                'address' => $delivery['address'],
                'delivery_instructions' => $delivery['delivery_instructions'],
                'plain_packaging' => $delivery['plain_packaging'],
                'same_as_billing' => $delivery['same_as_billing'],
            ]);

            if (isset($data['image'])) {
                // Save Images
                foreach ($data['images'] as $img) {
                    QuoteDocument::create([
                        'quote_id' => $quote->id,
                        'path' => $img['path'],
                        'name' => $img['name'],
                        'type' => $img['type'],
                    ]);
                }
            }

            DB::commit();
            session()->forget('cart');
            return response()->json(['message' => 'Quote saved successfully', 'quote_id' => $quote->quote_number]);


        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to save quote', 'message' => $e->getMessage()], 500);
        }

    }

}
