@extends('layouts.new-master')

@section('title')
    Checkout
@endsection

@section('content')
<section class="featured-area">
    <div class="container py-5">
        <h1 class="mb-4 font-weight-bold text-center">Checkout</h1>
        <div class="row justify-content-center">
            {{-- Left Side: Customer/Delivery Form --}}
            <div class="col-lg-6 col-md-7 mb-4">
                <form method="POST" action="{{ route('checkout.submit') }}">
                    @csrf

                    <h3>Contact</h3>

                    <div class="form-group mb-2">
                        <label for="email">Email or mobile phone number</label>
                        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-check mb-3">
                        <input type="checkbox" id="subscribe" name="subscribe" class="form-check-input"
                               {{ old('subscribe') ? 'checked' : '' }}>
                        <label for="subscribe" class="form-check-label">Email me with news and offers</label>
                    </div>

                    <h3>Delivery</h3>

                    <div class="form-group mb-2">
                        <label for="countrySelect">Country/Region</label>
                        <select id="countrySelect" name="country" class="form-control @error('country') is-invalid @enderror"
                                required>
                            <option value="">Select country</option>
                            <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>
                                United Kingdom
                            </option>
                            <option value="Ireland" {{ old('country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                            <option value="Europe" {{ old('country') == 'Europe' ? 'selected' : '' }}>Europe</option>
                        </select>
                        <small id="vatInfo" class="form-text text-muted mt-1">VAT will be applied according to your country.</small>
                        @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row mb-2">
                        <div class="form-group col">
                            <label for="firstName">First name (optional)</label>
                            <input type="text" name="first_name" id="firstName"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name') }}">
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="lastName">Last name</label>
                            <input type="text" name="last_name" id="lastName" required
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name') }}">
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="street">Street + House number</label>
                        <input type="text" name="street" id="street" required
                               class="form-control @error('street') is-invalid @enderror"
                               value="{{ old('street') }}">
                        <small class="form-text text-muted">PLEASE NOTE: Don't forget to add your house number!</small>
                        @error('street')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="apartment">Apartment, suite, etc. (optional)</label>
                        <input type="text" name="apartment" id="apartment"
                               class="form-control @error('apartment') is-invalid @enderror"
                               value="{{ old('apartment') }}">
                        @error('apartment')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row mb-2">
                        <div class="form-group col">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" required
                                   class="form-control @error('city') is-invalid @enderror"
                                   value="{{ old('city') }}">
                            @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col">
                            <label for="postcode">Postcode</label>
                            <input type="text" name="postcode" id="postcode" required
                                   class="form-control @error('postcode') is-invalid @enderror"
                                   value="{{ old('postcode') }}">
                            @error('postcode')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="phone">Phone</label>
                        <div class="input-group @error('phone') is-invalid @enderror">
                            <!-- <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img src="https://flagcdn.com/gb.svg" alt="UK" style="width:16px; margin-right:2px;">
                                    +44
                                </span>
                            </div> -->
                            <input type="text" name="phone" id="phone" required
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <h4>Delivery charges</h4>
                    <div class="form-group">
                        @foreach($deliveryCharges as $charge)
                            <div class="custom-control custom-radio">
                                <input type="radio" id="delivery-{{ $charge->id }}" name="delivery_charge_id"
                                       class="custom-control-input"
                                       value="{{ $charge->id }}"
                                    {{ old('delivery_charge_id', $deliveryCharges->firstWhere('is_default', true)?->id) == $charge->id ? 'checked' : '' }}>
                                <label for="delivery-{{ $charge->id }}" class="custom-control-label">
                                    {{ $charge->title }}
                                    <small class="d-block text-muted">{{ $charge->details }}</small>
                                    <span class="badge badge-{{ $charge->price > 0 ? 'secondary' : 'success' }} ml-2">
                                        {{ $charge->price > 0 ? '£'.number_format($charge->price, 2) : 'FREE' }}
                                    </span>
                                    <small class="d-block text-muted">Delivery in {{ $charge->no_of_days }} days</small>
                                </label>
                            </div>
                        @endforeach
                        @error('delivery_charge_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <h4>Payment</h4>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="pay-now" name="payment_type" value="now"
                                   class="custom-control-input" {{ old('payment_type', 'now') == 'now' ? 'checked' : '' }}>
                            <label for="pay-now" class="custom-control-label">Pay Now</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="pay-later" name="payment_type" value="later"
                                   class="custom-control-input" {{ old('payment_type') == 'later' ? 'checked' : '' }}>
                            <label for="pay-later" class="custom-control-label">Pay Later</label>
                        </div>
                        @error('payment_type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-3">Place order</button>
                </form>
            </div>

            {{-- Right side: Order summary --}}
            <div class="col-lg-5 col-md-5">
                @if($cart->isEmpty())
                    <p>Your cart is empty.</p>
                @else
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h4 class="mb-3 font-weight-bold">Order Summary</h4>

                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Extras</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $entry)
                                    @php $item = $entry['item']; @endphp
                                    <tr>
                                        <td>
                                            @if(!empty($item['photos'][0]))
                                                <img src="{{ asset('storage/' . $item['photos'][0]) }}" alt="Product" style="width:60px;"><br>
                                            @endif
                                            @foreach($entry['attributes'] as $attribute)
                                                <div style="font-size:0.9rem;">
                                                    <strong>{{ $attribute['name'] }}:</strong> {{ $attribute['value'] }}
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if(!empty($entry['extra_options']))
                                                <ul class="mb-0 pl-3">
                                                    @foreach($entry['extra_options'] as $opt)
                                                        <li style="font-size:0.9rem;">{{ $opt['title'] }} (+£{{ number_format($opt['price'], 2) }})</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            £{{ number_format($entry['item_total'], 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between">
                                <strong>Subtotal</strong>
                                <span>£<span id="subtotal">{{ number_format($subtotal, 2) }}</span></span>
                            </div>
                            <div class="d-flex justify-content-between" id="vat-row" style="display:none;">
                                <strong>VAT (<span id="vat-percent"></span>)</strong>
                                <span>£<span id="vat-amount">0.00</span></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <strong>Delivery charge</strong>
                                <span>£<span id="delivery-charge">0.00</span></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between font-weight-bold">
                                <strong>Total</strong>
                                <span>£<span id="total-price">{{ number_format($subtotal, 2) }}</span></span>
                            </div>
                            <div class="small text-muted">Prices include VAT where applicable.</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vats = @json($vats->keyBy('country'));
        const charges = @json($deliveryCharges->keyBy('id'));
        const countrySelect = document.getElementById('countrySelect');
        const deliveryInputs = document.querySelectorAll('input[name="delivery_charge_id"]');

        const vatRow = document.getElementById('vat-row');
        const vatPercentElem = document.getElementById('vat-percent');
        const vatAmountElem = document.getElementById('vat-amount');
        const deliveryChargeElem = document.getElementById('delivery-charge');
        const subtotalElem = document.getElementById('subtotal');
        const totalPriceElem = document.getElementById('total-price');

        // Assume these are from server, or calculate in backend
        const baseSubtotal = parseFloat(subtotalElem.textContent) || 0;

        function updateTotals() {
            const selectedCountry = countrySelect.value;
            let vatPercent = 0;
            if (selectedCountry && vats[selectedCountry]) {
                vatPercent = parseFloat(vats[selectedCountry].vat_percentage);
            }

            let selectedChargeId = null;
            deliveryInputs.forEach(input => {
                if (input.checked) selectedChargeId = input.value;
            });

            let deliveryCharge = 0;
            if (selectedChargeId && charges[selectedChargeId]) {
                deliveryCharge = parseFloat(charges[selectedChargeId].price);
            }

            const vatAmount = (baseSubtotal * vatPercent) / 100;
            const total = baseSubtotal + vatAmount + deliveryCharge;

            if (vatPercent > 0) {
                vatRow.style.display = 'flex';
                vatPercentElem.textContent = vatPercent.toFixed(2) + '%';
                vatAmountElem.textContent = vatAmount.toFixed(2);
            } else {
                vatRow.style.display = 'none';
            }

            deliveryChargeElem.textContent = deliveryCharge.toFixed(2);
            totalPriceElem.textContent = total.toFixed(2);
        }

        countrySelect.addEventListener('change', updateTotals);
        deliveryInputs.forEach(input => input.addEventListener('change', updateTotals));

        updateTotals();
    });
</script>
@endsection
