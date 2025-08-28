

<?php $__env->startSection('title'); ?>
    Checkout
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="featured-area">
        <div class="container py-5">
            <h1 class="mb-4 font-weight-bold text-center">Checkout</h1>
            <div class="row justify-content-center">
                
                <div class="col-lg-6 col-md-7 mb-4">
                    <form method="POST" action="<?php echo e(route('checkout.submit')); ?>">
                        <?php echo csrf_field(); ?>

                        <h3>Contact</h3>

                        <div class="form-group mb-2">
                            <label for="email">Email or mobile phone number</label>
                            <input type="text" id="email" name="email"
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>"
                                required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group form-check mb-3">
                            <input type="checkbox" id="subscribe" name="subscribe" class="form-check-input" <?php echo e(old('subscribe') ? 'checked' : ''); ?>>
                            <label for="subscribe" class="form-check-label">Email me with news and offers</label>
                        </div>

                        <h3>Delivery</h3>

                        <div class="form-group mb-2">
                            <label for="countrySelect">Country/Region</label>
                            <select id="countrySelect" name="country"
                                class="form-control <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Select country</option>
                                <option value="United Kingdom" <?php echo e(old('country') == 'United Kingdom' ? 'selected' : ''); ?>>
                                    United Kingdom
                                </option>
                                <option value="Ireland" <?php echo e(old('country') == 'Ireland' ? 'selected' : ''); ?>>Ireland</option>
                                <option value="Europe" <?php echo e(old('country') == 'Europe' ? 'selected' : ''); ?>>Europe</option>
                            </select>
                            <small id="vatInfo" class="form-text text-muted mt-1">VAT will be applied according to your
                                country.</small>
                            <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-row mb-2">
                            <div class="form-group col">
                                <label for="firstName">First name (optional)</label>
                                <input type="text" name="first_name" id="firstName"
                                    class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('first_name')); ?>">
                                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group col">
                                <label for="lastName">Last name</label>
                                <input type="text" name="last_name" id="lastName" required
                                    class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('last_name')); ?>">
                                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="street">Street + House number</label>
                            <input type="text" name="street" id="street" required
                                class="form-control <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('street')); ?>">
                            <small class="form-text text-muted">PLEASE NOTE: Don't forget to add your house number!</small>
                            <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group mb-2">
                            <label for="apartment">Apartment, suite, etc. (optional)</label>
                            <input type="text" name="apartment" id="apartment"
                                class="form-control <?php $__errorArgs = ['apartment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('apartment')); ?>">
                            <?php $__errorArgs = ['apartment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-row mb-2">
                            <div class="form-group col">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" required
                                    class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('city')); ?>">
                                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group col">
                                <label for="postcode">Postcode</label>
                                <input type="text" name="postcode" id="postcode" required
                                    class="form-control <?php $__errorArgs = ['postcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('postcode')); ?>">
                                <?php $__errorArgs = ['postcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="phone">Phone</label>
                            <div class="input-group <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <!-- <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="https://flagcdn.com/gb.svg" alt="UK" style="width:16px; margin-right:2px;">
                                        +44
                                    </span>
                                </div> -->
                                <input type="text" name="phone" id="phone" required
                                    class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('phone')); ?>">
                            </div>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <h4>Delivery charges</h4>
                        <div class="form-group">
                            <?php $__currentLoopData = $deliveryCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="delivery-<?php echo e($charge->id); ?>" name="delivery_charge_id"
                                        class="custom-control-input" value="<?php echo e($charge->id); ?>" <?php echo e(old('delivery_charge_id', $deliveryCharges->firstWhere('is_default', true)?->id) == $charge->id ? 'checked' : ''); ?>>
                                    <label for="delivery-<?php echo e($charge->id); ?>" class="custom-control-label">
                                        <?php echo e($charge->title); ?>

                                        <small class="d-block text-muted"><?php echo e($charge->details); ?></small>
                                        <span class="badge badge-<?php echo e($charge->price > 0 ? 'secondary' : 'success'); ?> ml-2">
                                            <?php echo e($charge->price > 0 ? '£' . number_format($charge->price, 2) : 'FREE'); ?>

                                        </span>
                                        <small class="d-block text-muted">Delivery in <?php echo e($charge->no_of_days); ?> days</small>
                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__errorArgs = ['delivery_charge_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <h4>Payment</h4>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="pay-now" name="payment_type" value="now"
                                    class="custom-control-input" <?php echo e(old('payment_type', 'now') == 'now' ? 'checked' : ''); ?>>
                                <label for="pay-now" class="custom-control-label">Pay with Stripe</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="pay-later" name="payment_type" value="later"
                                    class="custom-control-input" <?php echo e(old('payment_type') == 'later' ? 'checked' : ''); ?>>
                                <label for="pay-later" class="custom-control-label">Pay Later</label>
                            </div>
                            <?php $__errorArgs = ['payment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">Place order</button>
                    </form>
                </div>

                
                <div class="col-lg-5 col-md-5">
                    <?php if($cart->isEmpty()): ?>
                        <p>Your cart is empty.</p>
                    <?php else: ?>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h4 class="mb-3 font-weight-bold">Order Summary</h4>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <!--<th>Extras</th>-->
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $item = $entry['item']; ?>
                                            <tr>
                                                <td>
                                                    <?php if(!empty($item['photos'][0])): ?>
                                                        <img src="<?php echo e(asset('storage/' . $item['photos'][0])); ?>" alt="Product"
                                                            style="width:60px;"><br>
                                                    <?php endif; ?>
                                                    <?php if(!empty($entry['subcategory_name'])): ?>
                                                        <div style="font-size:1rem; font-weight:bold; color:#343434;">
                                                            <?php echo e($entry['subcategory_name']); ?>

                                                        </div>
                                                    <?php endif; ?>

                                                    <?php $__currentLoopData = $entry['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div style="font-size:0.9rem;">
                                                            <?php echo e($attribute['name']); ?>: <strong><?php echo e($attribute['value']); ?></strong>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="d-flex justify-content-between mb-3 mt-2">
                                                        <?php if(!empty($entry['extra_options'])): ?>
                                                            <strong>Extras</strong>
                                                            <span>
                                                                <ul class="mb-0 pl-3">
                                                                    <?php $__currentLoopData = $entry['extra_options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li style="font-size:0.9rem;"><?php echo e($opt['title']); ?>

                                                                            (+£<?php echo e(number_format($opt['price'], 2)); ?>)</li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <!--<td>-->
                                                <!--    <?php if(!empty($entry['extra_options'])): ?>-->
                                                <!--        <ul class="mb-0 pl-3">-->
                                                <!--            <?php $__currentLoopData = $entry['extra_options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                                                <!--                <li style="font-size:0.9rem;"><?php echo e($opt['title']); ?> (+£<?php echo e(number_format($opt['price'], 2)); ?>)</li>-->
                                                <!--            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                                                <!--        </ul>-->
                                                <!--    <?php endif; ?>-->

                                                <!--</td>-->
                                                <td class="text-right">
                                                    £<?php echo e(number_format($entry['item_total'], 2)); ?>


                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>



                                <div class="d-flex justify-content-between">
                                    <strong>Subtotal</strong>
                                    <span>£<span id="subtotal"><?php echo e(number_format($subtotal, 2)); ?></span></span>
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
                                    <span>£<span id="total-price"><?php echo e(number_format($subtotal, 2)); ?></span></span>
                                </div>
                                <div class="small text-muted">Prices include VAT where applicable.</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const vats = <?php echo json_encode($vats->keyBy('country'), 15, 512) ?>;
            const charges = <?php echo json_encode($deliveryCharges->keyBy('id'), 15, 512) ?>;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/front/checkout.blade.php ENDPATH**/ ?>