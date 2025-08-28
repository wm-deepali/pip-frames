<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Customer;
use App\Models\DeliveryCharge;
use App\Models\Invoice;
use App\Models\Quote;
use App\Models\QuoteBillingAddress;
use App\Models\QuoteDeliveryAddress;
use App\Models\Vat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutControlller extends Controller
{

    public function checkout()
    {
        $cart = session()->get('cart', []);

        $attributes = Attribute::with('values')->get()->keyBy('id');
        $subtotal = 0;

        // Preload subcategories (to avoid multiple queries)
        $subcategories = \App\Models\Subcategory::pluck('name', 'id');

        $enrichedCart = collect($cart)->map(function ($item) use ($attributes, &$subtotal, $subcategories) {
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
            // Attach subcategory name
            $subcategoryName = $subcategories[$item['subcategory_id']] ?? 'Unknown';
            return [
                'item' => $item,
                'attributes' => $attrArr,
                'extra_options' => $extraOptions,
                'item_total' => $itemTotal,
                'subcategory_name' => $subcategoryName,
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
                    // 'pet_birthdate' => $item['pet_birthdate'] ?? null,
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

            // ✅ If Pay Now → send customer to Stripe Checkout
            if ($validated['payment_type'] === 'now') {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'mode' => 'payment',
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'gbp',
                                'product_data' => [
                                    'name' => 'Order #' . $quote->quote_number,
                                ],
                                'unit_amount' => intval($quote->grand_total * 100), // pennies
                            ],
                            'quantity' => 1,
                        ]
                    ],
                    'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}&quote_id=' . $quote->id,
                    'cancel_url' => route('payment.cancel', ['quote' => $quote->id]),
                ]);

                return redirect($session->url);
            }

            // ✅ If Pay Later → thank you page
            return redirect()->route('order.thankyou')
                ->with('success', 'Order placed successfully! You can pay later.');

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return back()->withErrors('Failed to place order: ' . $e->getMessage())->withInput();
        }
    }

    protected function getCountryIdByName($name)
    {
        $country = \DB::table('countries')->where('name', $name)->first();
        return $country ? $country->id : null;
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $quote = Quote::findOrFail($request->get('quote_id'));

        if ($session->payment_status === 'paid') {
            // Make sure invoice exists
            $invoice = $quote->invoice ?? $this->generateInvoiceForQuote($quote);

            // Record payment
            $quote->payments()->create([
                'invoice_id' => $invoice->id,
                'amount_received' => $session->amount_total / 100,
                'payment_method' => 'stripe',
                'payment_date' => now(),
                'reference_number' => $session->id,
                'remarks' => 'Stripe Checkout Payment',
                'payment_type' => 'online',
            ]);

            // Mark invoice as paid if fully paid
            $totalPaid = $quote->payments()->sum('amount_received');
            if ($totalPaid >= $invoice->total_amount) {
                $invoice->is_paid = true;
                $invoice->save();
            }
        }

        return redirect()->route('order.thankyou')->with('success', 'Payment successful!');
    }

    public function cancel(Quote $quote)
    {
        $quote->status = 'cancelled';
        $quote->save();

        return redirect()->route('checkout')->withErrors('Payment was cancelled.');
    }

    /**
     * Generate invoice for given quote
     */
    protected function generateInvoiceForQuote(Quote $quote)
    {
        $invoice = new Invoice();
        $invoice->quote_id = $quote->id;
        $invoice->total_amount = $quote->grand_total;
        $invoice->invoice_date = now();
        $invoice->invoice_number = $this->generateUniqueInvoiceNumber();
        $invoice->is_paid = false;

        $invoice->save();

        return $invoice;
    }


    protected function generateUniqueInvoiceNumber()
    {
        do {
            $number = 'INV-' . mt_rand(100000, 999999); // e.g. INV-123456
        } while (Invoice::where('invoice_number', $number)->exists());

        return $number;
    }
}
