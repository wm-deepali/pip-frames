<?php

namespace App\Http\Controllers;


use App\Models\Attribute;
use App\Models\Country;
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
use Illuminate\Support\Str;

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

    public function checkout()
    {
        $cart = session()->get('cart', []);

        $attributes = Attribute::with('values')->get()->keyBy('id');
        $subtotal = 0;

        $enrichedCart = collect($cart)->map(function ($item) use ($attributes, &$subtotal) {
            $quantity = $item['quantity'] ?? 1;
            $basePrice = $item['total_price'] ?? 0;

            // Calculate extra options total
            $extraOptions = $item['extra_options'] ?? [];
            $extraTotal = collect($extraOptions)->sum('price');

            // Calculate total price for this item
            $itemTotal = ($basePrice + $extraTotal) * $quantity;
            $subtotal += $itemTotal;

            // Prepare attributes
            $attrArr = [];
            if (!empty($item['attributes'])) {
                foreach ($item['attributes'] as $attrId => $attrValue) {
                    if (!isset($attributes[$attrId]))
                        continue;
                    $attribute = $attributes[$attrId];
                    $name = $attribute->name;
                    if (is_array($attrValue) && isset($attrValue['height'], $attrValue['width'])) {
                        $value = "Height: {$attrValue['height']}, Width: {$attrValue['width']}";
                    } else {
                        $valObj = $attribute->values->firstWhere('id', $attrValue);
                        $value = $valObj ? $valObj->value : $attrValue;
                    }
                    $attrArr[] = ['name' => $name, 'value' => $value];
                }
            }

            return [
                'item' => $item,
                'attributes' => $attrArr,
                'extra_options' => $extraOptions,
                'item_total' => $itemTotal,
            ];
        });

        $deliveryCharges = DeliveryCharge::orderBy('is_default', 'desc')->get();
        $vats = Vat::all();

        return view('front.checkout', [
            'cart' => $enrichedCart,
            'subtotal' => $subtotal,
            'deliveryCharges' => $deliveryCharges,
            'vats' => $vats,
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

    public function checkoutSubmit(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'subscribe' => ['nullable', 'boolean'],
            'country' => ['required', 'in:United Kingdom,Ireland,Europe'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'apartment' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
            'delivery_charge_id' => ['required', 'exists:delivery_charges,id'],
            'payment_type' => ['required', 'in:now,later'],
            'delivery_instructions' => ['nullable', 'string'],
            'plain_packaging' => ['nullable', 'boolean'],
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('checkout')->withErrors('Your cart is empty.');
        }
// dd($cart);
        // Fetch or create customer
        $customer = Customer::firstOrCreate(
            ['email' => $validated['email']],
            [
                'first_name' => $validated['first_name'] ?? '',
                'last_name' => $validated['last_name'],
                'mobile' => $validated['phone'],
                'country' => $this->getCountryIdByName($validated['country']),
                'password' => bcrypt(Str::random(12)),
                'status' => 'active',
            ]
        );

        // Calculate subtotal as before
        $subtotal = 0;
        foreach ($cart as $item) {
            $basePrice = $item['total_price'] ?? 0;
            $quantity = $item['quantity'] ?? 1;
            $extraTotal = collect($item['extra_options'] ?? [])->sum('price');
            $subtotal += ($basePrice + $extraTotal) * $quantity;
        }

        // Retrieve VAT and delivery price as before
        $vatRecord = Vat::where('country', $validated['country'])->first();
        $vatPercent = $vatRecord ? $vatRecord->vat_percentage : 0;
        $vatAmount = $subtotal * ($vatPercent / 100);
        $deliveryCharge = DeliveryCharge::findOrFail($validated['delivery_charge_id']);
        $deliveryPrice = $deliveryCharge->price;
        $totalPrice = $subtotal + $vatAmount + $deliveryPrice;

        DB::beginTransaction();
        try {
            // Create the quote record
            $quote = Quote::create([
                'quote_number' => 'Q-' . strtoupper(Str::random(8)),
                'status' => 'pending',
                'customer_id' => $customer->id,
                'vat_amount' => $vatAmount,
                'vat_percentage' => $vatPercent,
                'delivery_price' => $deliveryPrice,
                'grand_total' => $totalPrice,
                'delivery_date' => now()->addDays($deliveryCharge->no_of_days),
            ]);

            // Billing address with city and postcode added
            $billingAddress = new QuoteBillingAddress([
                'first_name' => $validated['first_name'] ?? '',
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'mobile' => $validated['phone'],
                'address' => trim($validated['street'] . ' ' . ($validated['apartment'] ?? '')),
                'city' => $validated['city'],
                'postcode' => $validated['postcode'],
                'country' => $this->getCountryIdByName($validated['country']),
            ]);
            $quote->billingAddress()->save($billingAddress);

            // Delivery address with city and postcode added
            $deliveryAddress = new QuoteDeliveryAddress([
                'first_name' => $validated['first_name'] ?? '',
                'last_name' => $validated['last_name'],
                'mobile' => $validated['phone'],
                'address' => trim($validated['street'] . ' ' . ($validated['apartment'] ?? '')),
                'city' => $validated['city'],
                'postcode' => $validated['postcode'],
                'country' => $this->getCountryIdByName($validated['country']),
                'delivery_instructions' => $validated['delivery_instructions'] ?? null,
                'plain_packaging' => $validated['plain_packaging'] ?? false,
                'same_as_billing' => true,
            ]);
            $quote->deliveryAddress()->save($deliveryAddress);

            // Save quote items with photos, extra options, pet info etc.
            foreach ($cart as $item) {
                $quoteItem = $quote->items()->create([
                    'subcategory_id' => $item['subcategory_id'] ?? null,
                    'quantity' => $item['quantity'] ?? 1,
                    'sub_total' => $item['total_price'] ?? 0,
                    'pet_name' => $item['pet_name'] ?? null,
                    'pet_birthdate' => $item['pet_birthdate'] ?? null,
                    'personal_text' => $item['personal_text'] ?? '',
                    'note' => $item['note'] ?? null,
                    'photos' => json_encode($item['photos'] ?? []),
                    'extra_options' => json_encode($item['extra_options'] ?? []),
                ]);

                if (!empty($item['attributes']) && is_array($item['attributes'])) {
                    foreach ($item['attributes'] as $attrId => $attrValue) {
                        $attributeData = [
                            'attribute_id' => $attrId,
                        ];

                        if (is_array($attrValue)) {
                            // dd($attrValue);
                            $attributeData['length'] = $attrValue['height'] ?? null;
                            $attributeData['width'] = $attrValue['width'] ?? null;
                            $attributeData['unit'] = $attrValue['unit'] ?? null;
                            $attributeData['value_id'] = null;
                        } else {
                            $attributeData['value_id'] = $attrValue;
                            $attributeData['length'] = null;
                            $attributeData['width'] = null;
                            $attributeData['unit'] = null;
                        }

                        $quoteItem->attributes()->create($attributeData);
                    }
                }
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('order.thankyou')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            // dd( $e->getMessage());
            return back()->withErrors('Failed to place order: ' . $e->getMessage())->withInput();
        }
    }

    protected function getCountryIdByName($name)
    {
        $country = \DB::table('countries')->where('name', $name)->first();
        return $country ? $country->id : null;
    }


}
