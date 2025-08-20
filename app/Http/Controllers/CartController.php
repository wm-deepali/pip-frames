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

    public function showCart()
    {
        $cart = session('cart', null);
        if (!$cart || !$cart['items']) {
            return view('front.shop-cart', ['cartData' => null]);
        }

        $item = $cart['items'];
        $subcategory = Subcategory::find($item['subcategory_id']);
        $attributes = [];
        $paperWeight = null;
        $paperSize = null;


        foreach ($item['attributes'] as $attrId => $val) {
            $attribute = Attribute::find($attrId);

            if (!$attribute)
                continue;

            $attrName = strtolower(trim($attribute->name));

            // Case 1: Custom area attribute
            if (is_array($val) && isset($val['type']) && $val['type'] === 'select_area') {
                $area = $val['area'] ?? null;
                $length = $val['length'] ?? null;
                $width = $val['width'] ?? null;
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

                    // Optional use for weight/size detection
                    if ($attrName === 'paper weight') {
                        $paperWeight = $value->value;
                    } elseif ($attrName === 'paper size') {
                        $paperSize = $value->value;
                    }
                }
            }
        }

        // Total weight calculation (optional)
        $totalWeight = null;
        if ($paperWeight && $paperSize && isset($item['pages']) && isset($item['quantity'])) {
            $gsm = (int) filter_var($paperWeight, FILTER_SANITIZE_NUMBER_INT);
            $pages = (int) $item['pages'];
            $quantity = (int) $item['quantity'];

            $sizeMap = [
                'A5' => [148, 210],
                'A4' => [210, 297],
                'A3' => [297, 420],
            ];

            if (isset($sizeMap[$paperSize])) {
                [$widthMm, $heightMm] = $sizeMap[$paperSize];
                $widthM = $widthMm * 0.001;
                $heightM = $heightMm * 0.001;
                $sheetArea = $widthM * $heightM;

                $sheetsPerCopy = ceil($pages / 2);
                $totalSheets = $sheetsPerCopy * $quantity;

                $totalWeightGrams = round($gsm * $sheetArea * $totalSheets, 2);
                $totalWeight = round($totalWeightGrams / 1000, 2); // in kg
            }
        }

        // Just append additional computed info to existing cart
        $cart['subcategory_name'] = $subcategory->name ?? 'Unknown';
        $cart['subcategory_thumbnail'] = $subcategory->thumbnail ?? null;
        $cart['attributes_resolved'] = $attributes;
        $cart['paper_total_weight'] = $totalWeight;

        $allDeliveryCharges = DeliveryCharge::all();
        // dd($cart);
        return view('front.shop-cart', [
            'cartData' => $cart,
            'allDeliveryCharges' => $allDeliveryCharges,
        ]);
    }


    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'subcategory_id' => 'required|integer',
            'attributes' => 'required|array',
            'pages' => 'nullable|integer',
            'composite_pages' => 'nullable|array',
            'delivery.id' => 'nullable|integer',
            'delivery.date' => 'nullable|string',
            'delivery.price' => 'nullable|numeric',
            'proof.id' => 'nullable|integer',
            'proof.proof_type' => 'nullable|string',
            'proof.price' => 'nullable|numeric',
            'totalPrice' => 'required|numeric',
        ]);

        $deliveryPrice = isset($validated['delivery']['price']) ? (float) $validated['delivery']['price'] : 0;
        $proofPrice = (isset($validated['proof']['id']) && !empty($validated['proof']['id']))
            ? ((float) $validated['proof']['price'] ?? 0)
            : 0;

        $subTotal = $validated['totalPrice'] - $deliveryPrice - $proofPrice;

        $deliveryTitle = '';

        if (!empty($validated['delivery']['id'])) {
            $deliveryCharge = DeliveryCharge::find($validated['delivery']['id']);
            $deliveryTitle = $deliveryCharge->title ?? 'Delivery';
            $validated['delivery']['title'] = $deliveryTitle;
        }

        $vatPercentage = (float) Vat::where('country', $deliveryTitle)->value('vat_percentage') ?? 0;
        $vatAmount = round(($validated['totalPrice'] * $vatPercentage) / 100, 2);
        $validated['totalPrice'] += $vatAmount;

        do {
            $quoteId = random_int(1000000, 9999999);
        } while (Quote::where('quote_number', $quoteId)->exists());


        $cart = [
            'quote_id' => $quoteId,
            'items' => [
                'subcategory_id' => $validated['subcategory_id'],
                'quantity' => $validated['quantity'],
                'attributes' => $validated['attributes'],
                'pages' => $validated['pages'] ?? null,
                'composite_pages' => $validated['composite_pages'] ?? [],
                'sub_total' => $subTotal,
            ],
            'delivery' => $validated['delivery'] ?? [],
            'proof' => $validated['proof'] ?? [],
            'vat_amount' => $vatAmount,
            'vat_percentage' => $vatPercentage,
            'grand_total' => $validated['totalPrice'],
        ];

        session()->put('cart', $cart);

        // Detect AJAX or normal form
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart.',
                'redirect_url' => route('cart.show'),
                'cart' => $cart
            ]);
        }

        // Normal browser POST form, redirect
        return redirect()->route('cart.show')->with([
            'success' => 'Product added to cart.',
            'cart' => $cart
        ]);
    }

    public function updateDelivery(Request $request)
    {
        $deliveryTitle = $request->input('title');
        $deliveryPrice = (float) $request->input('price');
        $deliveryId = $request->input('id');

        $cart = session('cart');

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart is empty.']);
        }

        $delivery = DeliveryCharge::find($deliveryId);

        //Calculate future delivery date using Carbon
        $deliveryDate = Carbon::now()->addDays($delivery->delivery_days)->translatedFormat('jS F Y');

        $cart['delivery'] = [
            'id' => $deliveryId,
            'price' => $deliveryPrice,
            'title' => $deliveryTitle,
            'date' => $deliveryDate,

        ];

        $vatPercentage = (float) Vat::where('country', $deliveryTitle)->value('vat_percentage') ?? 0;
        $proofPrice = (float) ($cart['proof']['price'] ?? 0);
        $sub_total = $cart['items']['sub_total'];

        $vatAmount = round(($sub_total + $deliveryPrice + $proofPrice) * $vatPercentage / 100, 2);
        $grandTotal = round($sub_total + $deliveryPrice + $proofPrice + $vatAmount, 2);

        $cart['vat_percentage'] = $vatPercentage;
        $cart['vat_amount'] = $vatAmount;
        $cart['grand_total'] = $grandTotal;

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'vat_amount' => $vatAmount,
            'vat_percentage' => $vatPercentage,
            'grand_total' => $grandTotal
        ]);
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
