<div class="tabone-section">
<div>
        <div class="custom-art-tab-section-left">
         <div class="custom-art-tab-cont">
            <h6>{{ $subcategory_name ?? ''}}</h6>
            <button class="custom-art-edit-btn">✎ Edit</button>
         </div>
         <div class="custom-art-card">
           <div class="custom-art-item-label">{{ $category_name }}</div>
            <div class="custom-art-field">
               <label>Copies</label>
               <input
                  type="number"
                  value="{{ $items['quantity'] ?? ''}}"
                  class="custom-art-input-box"
               />
            </div>
            @php $paperSizeValue = collect($attributes_resolved)->firstWhere('attribute_name', 'Paper Size')['value_name'] ?? '';
            @endphp
            <div class="custom-art-field">
               <label>Size</label>
               <input
                  type="text"
                  value="{{ $paperSizeValue }}"
                  class="custom-art-input-box"
                  readonly
               />
            </div>
              @php
                // Randomly pick 3 or 4 attributes from the resolved collection
               $randomAttributes = collect($attributes_resolved)->shuffle()->take(4);
            @endphp
            <div class="custom-art-field custom-art-gsm-options">
               @foreach ($randomAttributes as $attribute)
               <span class="custom-art-subtext"> {{ $attribute['attribute_name'] }} - {{ $attribute['value_name'] }}</span>
               <br>
               @endforeach
            </div>

            <button class="custom-art-change-options">🔧 Change Options</button>
            <div class="custom-art-vat-row">
               <input type="checkbox" checked />
               <label>Add VAT (if applicable)</label>
                @php
  $country = $delivery['title'] ?? '';
  $vat = $vat_percentage ?? '';
@endphp

<button 
   type="button" 
   class="custom-art-info-btn"
   data-bs-toggle="popover" 
   data-bs-trigger="focus" 
   data-bs-html="true"
   title="VAT Payable?"
   data-bs-content="
      Country: <strong>{{ $country }}</strong><br>
      VAT Percentage: <strong>{{ $vat}}%</strong>"
>
   Info
</button>
            </div>
            <a href="#" class="custom-art-view-quote">📄 View this quote</a>
         </div>
      </div>
    </div>
   <div id="loginPrompt" style="display: none; max-width: 300px; margin: 40px auto; padding: 24px 32px; 
    background: #ffffff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; text-align: center;">

    <p style="font-size: 16px; margin-bottom: 24px; line-height: 1.4;">
        Please 
        <a href="{{ route('authentication-signin') }}" 
           style="color: #007bff; font-weight: 600; text-decoration: none;">
           sign in
        </a>
        or 
        <a href="{{ route('authentication-signup') }}" 
           style="color: #007bff; font-weight: 600; text-decoration: none;">
           create an account
        </a> 
        to continue.
    </p>

    <!-- Optional: Add some icons for user/fingerprint -->
    <div style="font-size: 48px; color: #007bff; margin-bottom: 16px;">
        🔒
    </div>

    <!-- Optional: Add a subtle separator line -->
    <hr style="border: none; border-top: 1px solid #eee; margin: 16px 0;">

    <!-- Optional: Add a short description or benefits -->
    <div style="font-size: 14px; color: #666;">
        Signing in lets you pre fil your address and speed up checkout.
    </div>
</div>

    <div class="tab-section-right" id="addressFormWrapper">
        <div class="custom-address-container">
            <div class="custom-address-title">Billing Address</div>
            <form id="detailsForm" enctype="multipart/form-data">

                <div class="custom-address-field">
                    <label>Email *</label>
                    <input name="billing_email" type="text" placeholder="Email" id="email">
                </div>
                <div class="custom-address-field">
                    <label>Name *</label>
                    <div class="d-flex justify-content-between">
                        <input type="text" name="billing_first_name" placeholder="Firstname" class="first_name"
                            style="width: 48%; display: inline-block; margin-right: 4%;">
                        <input type="text" name="billing_last_name" placeholder="Surname" class="last_name"
                            style="width: 48%; display: inline-block;">
                    </div>
                </div>
                <div class="custom-address-field">
                    <label>Phone *</label>
                    <input name="billing_mobile" type="text" placeholder="Phone" class="mobile">
                </div>

                <div class="custom-address-field">
                    <label>Country</label>
                    <select class="form-select" name="billing_country" id="inputSelectCountry"
                        aria-label="Default select example" required>
                        <option value="">Select Country</option>
                        @php $countries = countrylist(); @endphp
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>


                </div>
                <div class="custom-address-field">
                    <label>Address</label>
                    <input type="text" name="billing_address" placeholder="Start typing address">
                </div>
                <div class="custom-address-title">Delivery Address</div>
                <!-- Delivery Instructions -->
                <div class="custom-address-field">
                    <label>Delivery Instructions</label>
                    <input type="text" name="delivery_instructions" placeholder="Enter instructions">
                </div>

                <!-- Plain Packaging Checkbox -->
                <div class="custom-address-field custom-checkbox d-flex">
                    <input type="checkbox" name="plain_packaging" id="plainPackaging" value="1" style="width: 18px;">
                    <label for="plainPackaging" style="margin-top: 6px;">Use plain
                        packaging</label>
                </div>

                <!-- Same as Billing Address Checkbox -->
                <div class="custom-address-field custom-checkbox d-flex">
                    <input type="checkbox" name="same_as_billing" id="sameBilling" value="1" style="width: 18px;">
                    <label for="sameBilling" style="margin-top: 6px;">Same as billing
                        address</label>
                </div>

                <div class="custom-address-field">
                    <label>Name *</label>
                    <div class="d-flex justify-content-between">
                        <input name="delivery_first_name" type="text" placeholder="Firstname" class="first_name"
                            style="width: 48%; display: inline-block; margin-right: 4%;">
                        <input type="text" name="delivery_last_name" placeholder="Surname" class="last_name"
                            style="width: 48%; display: inline-block;">
                    </div>
                </div>
                <div class="custom-address-field">
                    <label>Phone *</label>
                    <input type="text" name="delivery_mobile" placeholder="Phone" class="mobile">
                </div>
                <div class="custom-address-field">
                    <label>Country</label>
                    <select class="form-select" name="delivery_country" id="inputSelectCountry"
                        aria-label="Default select example" required>
                        <option value="">Select Country</option>
                        @php $countries = countrylist(); @endphp
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ (isset($delivery['title']) && $delivery['title'] == $country->name) ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>

                        @endforeach
                    </select>
                </div>
                <div class="custom-address-field">
                    <label>Address</label>
                    <input type="text" name="delivery_address" placeholder="Start typing address">
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-primary" id="nextToPaymentBtn">
                        Next <i class="fa fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        $('#loginPrompt').hide();
        $('#addressFormWrapper').hide();

        fetch('/cart/get-session')
            .then(res => res.json())
            .then(cart => {
                const billing = cart.billing || {};
                const delivery = cart.delivery_address || {};
                let sessionDataFound = false;

                if (billing.first_name) {
                    $('#email').val(billing.email);
                    $('input[name="billing_first_name"]').val(billing.first_name);
                    $('input[name="billing_last_name"]').val(billing.last_name);
                    $('input[name="billing_mobile"]').val(billing.mobile);
                    $('select[name="billing_country"]').val(billing.country);
                    $('input[name="billing_address"]').val(billing.address);
                    sessionDataFound = true;
                     const paymentTab = document.querySelector('.custom-tab[data-tab="payment"]');
                    paymentTab.classList.remove('disabled');
                }

                if (delivery.first_name) {
                    $('input[name="delivery_first_name"]').val(delivery.first_name);
                    $('input[name="delivery_last_name"]').val(delivery.last_name);
                    $('input[name="delivery_mobile"]').val(delivery.mobile);
                    $('select[name="delivery_country"]').val(delivery.country);
                    $('input[name="delivery_address"]').val(delivery.address);
                    $('input[name="delivery_instructions"]').val(delivery.delivery_instructions);

                    if (delivery.plain_packaging === '1') {
                        $('#plainPackaging').prop('checked', true);
                    }

                    if (delivery.same_as_billing === '1') {
                        $('#sameBilling').prop('checked', true).trigger('change');
                    }

                    sessionDataFound = true;
                }

                if (!sessionDataFound) {
                    fetch('/customer-data')
                        .then(res => res.json())
                        .then(data => {
                            const user = data.user || {};
                            if (user && user.first_name) {
                                $('#email').val(user.email);
                                $('input[name="billing_first_name"]').val(user.first_name);
                                $('input[name="billing_last_name"]').val(user.last_name);
                                $('input[name="billing_mobile"]').val(user.mobile);
                                $('select[name="billing_country"]').val(user.country);
                                $('select[name="billing_address"]').val(user.address);

                                $('input[name="delivery_first_name"]').val(user.first_name);
                                $('input[name="delivery_last_name"]').val(user.last_name);
                                $('input[name="delivery_mobile"]').val(user.mobile);
                                $('select[name="delivery_country"]').val(user.country);
                                $('select[name="delivery_address"]').val(user.address);

                                $('#loginPrompt').hide();
                                $('#addressFormWrapper').show();
                            } else {
                                $('#loginPrompt').show();
                                $('#addressFormWrapper').hide();
                            }
                        })
                        .catch(() => {
                            $('#loginPrompt').show();
                            $('#addressFormWrapper').hide();
                        });
                } else {
                    $('#loginPrompt').hide();
                    $('#addressFormWrapper').show();
                }
            })
            .catch(() => {
                $('#loginPrompt').show();
                $('#addressFormWrapper').hide();
            });
    });

    // Autofill delivery when "Same as Billing" is checked
    $(document).on('change', '#sameBilling', function () {
        if ($(this).is(':checked')) {
            $('input[name="delivery_first_name"]').val($('input[name="billing_first_name"]').val());
            $('input[name="delivery_last_name"]').val($('input[name="billing_last_name"]').val());
            $('input[name="delivery_mobile"]').val($('input[name="billing_mobile"]').val());
            $('select[name="delivery_country"]').val($('select[name="billing_country"]').val());
            $('input[name="delivery_address"]').val($('input[name="billing_address"]').val());
        } else {
            // Optional: clear delivery fields if unchecked
            $('input[name="delivery_first_name"]').val('');
            $('input[name="delivery_last_name"]').val('');
            $('input[name="delivery_mobile"]').val('');
            $('select[name="delivery_country"]').val('');
            $('input[name="delivery_address"]').val('');
        }
    });

    $(document).ready(function () {
        $('#nextToPaymentBtn').on('click', function () {
            const formData = new FormData($('#detailsForm')[0]);

            $.ajax({
                url: "{{ route('cart.address-details') }}", // Replace with your actual route
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Move to Payment tab
                    // Switch to Payment tab programmatically

                    const paymentTab = document.querySelector('.custom-tab[data-tab="payment"]');
                    paymentTab.classList.remove('disabled');
                    paymentTab.style.pointerEvents = 'auto';
                    paymentTab.style.opacity = '1';
                    document.querySelectorAll('.custom-tab').forEach(tab => tab.classList.remove('active'));
                    document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

                    // Activate the "Payment" tab
                    document.querySelector('.custom-tab[data-tab="payment"]').classList.add('active');
                    document.getElementById('payment').classList.add('active');

                },
                error: function (xhr) {
                    alert('Error saving details. Please try again.');
                }
            });
        });
    });


</script>