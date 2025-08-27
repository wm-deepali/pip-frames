

<?php $__env->startSection('content'); ?>
    <div class="app-content content mb-3">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card p-4 shadow-sm" style="max-width: 900px; margin: auto; background: #fff;">

                    
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="mb-0" style="font-weight:700;">INVOICE</h2>
                            <small class="text-muted"
                                style="font-weight:600;">#<?php echo e($invoice->invoice_number ?? 'N/A'); ?></small>
                        </div>
                        <div>
                            <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="Logo" style="height: 30px;">
                        </div>
                    </div>

                    
                    <div class="row border-top border-bottom mb-4" style="font-size: 14px;">
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">Info</strong>
                            <hr>
                            <p style="margin-bottom:6px;"><strong>Invoice Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y')); ?></p>
                            <p style="margin-bottom:6px;"><strong>Order Id:</strong> #<?php echo e($quote->order_number); ?></p>
                            <p style="margin-bottom:6px;"><strong>Payment Status:</strong>
                                <?php echo e($payments->sum('amount_received') >= $quote->grand_total ? 'Paid' : 'Unpaid'); ?></p>
                            <p style="margin-bottom:6px;"><strong>Payment Method:</strong>
                                <?php echo e($payments->last()->payment_method ?? 'N/A'); ?></p>
                            <p style="margin-bottom:6px;"><strong>Payment Date:</strong>
                                <?php echo e($payments->last()->payment_date ? \Carbon\Carbon::parse($payments->last()->payment_date)->format('d M, Y') : 'N/A'); ?>

                            </p>
                        </div>

                        <div class="col-md-4 border-left border-right p-2">
                            <strong class="mb-1">Billed to</strong>
                            <hr>
                            <p style="margin-bottom:6px;font-weight:600;"><?php echo e($customer->first_name ?? '-'); ?>

                                <?php echo e($customer->last_name ?? ''); ?></p>
                            <p style="margin-bottom:6px;"> <?php echo e($quote->deliveryAddress->address ?? ''); ?>,
                                <?php echo e($quote->deliveryAddress->city ?? ''); ?>,
                                <?php echo e($quote->deliveryAddress->postcode ?? ''); ?>,
                                <?php echo e($quote->deliveryAddress->country_name ?? ''); ?>

                            </p>
                            <p style="margin-bottom:4px;"><?php echo e($customer->mobile ?? ''); ?></p>
                            <p class="text-blue" style="margin-bottom:6px; color:blue;"><?php echo e($customer->email ?? ''); ?></p>
                        </div>

                        <div class="col-md-4 p-2">
                            <strong class="mb-1">From</strong>
                            <hr>
                            <p style="margin-bottom:6px;font-weight:600;">Nuvem Print</p>
                            <p style="margin-bottom:6px;">Unit 7 Lotherton Way Garforth Leeds LS252JY</p>
                            <p style="margin-bottom:4px;">01132 874724</p>
                            <p class="text-blue" style="color:blue;">andy@nuvemprint.com</p>
                        </div>
                    </div>

                    
                    <h5 class="mb-2">Item Summary</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 14px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Rate (£)</th>
                                    <th>Total (£)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $quote->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            
                                            <div style="font-weight: 600; margin-bottom: 8px;">
                                                <?php echo e($item->subcategory->name ?? 'N/A'); ?>

                                                (<?php echo e(optional($item->subcategory->categories->first())->name ?? 'N/A'); ?>)
                                            </div>

                                            
                                            <?php if($item->attributes && $item->attributes->count()): ?>
                                                <div style="margin-bottom: 8px;">
                                                    <?php $__currentLoopData = $item->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div style="font-size: 14px; margin-left: 10px;">
                                                            <strong><?php echo e($attr->attribute->name ?? 'Attribute'); ?>:</strong>
                                                            <?php if($attr->attributeValue): ?>
                                                                <?php echo e($attr->attributeValue->value); ?>

                                                            <?php elseif($attr->length && $attr->width): ?>
                                                                <?php echo e($attr->length); ?> x <?php echo e($attr->width); ?> <?php echo e($attr->unit); ?>

                                                            <?php elseif($attr->length): ?>
                                                                <?php echo e($attr->length); ?> <?php echo e($attr->unit); ?>

                                                            <?php else: ?>
                                                                -
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>

                                            
                                            <?php if($item->pet_name || $item->pet_birthdate || $item->personal_text || $item->note): ?>
                                                <div style="margin-bottom: 8px; font-size: 14px;">
                                                    <strong>Pet Details :</strong><br>
                                                    <?php if($item->pet_name): ?>
                                                        <div style="margin-left: 10px;"><strong>Name:</strong> <?php echo e($item->pet_name); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($item->pet_birthdate): ?>
                                                        <div style="margin-left: 10px;"><strong>Birthdate:</strong> <?php echo e($item->pet_birthdate->format('d F Y')); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if($item->personal_text): ?>
                                                        <div style="margin-left: 10px;"><strong>Personal Text:</strong> <?php echo e($item->personal_text); ?></div>
                                                    <?php endif; ?>
                                                    <?php if($item->note): ?>
                                                        <div style="margin-left: 10px;"><strong>Note:</strong> <?php echo e($item->note); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                            
                                            <?php
                                                $extra_options = json_decode($item->extra_options, true);
                                              ?>
                                            <?php if(!empty($extra_options)): ?>
                                                <div style="margin-bottom: 8px;">
                                                    <strong>Extra Options:</strong>
                                                    <ul style="list-style-type:none; padding-left: 0; margin-bottom:0;">
                                                        <?php $__currentLoopData = $extra_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li
                                                                style="display: inline-block; background: #17a2b8; color: white; padding: 4px 8px; margin: 2px; border-radius: 12px; font-size: 13px;">
                                                                <?php echo e($option['title']); ?>

                                                                <?php if(!empty($option['price']) && $option['price'] !== '0'): ?>
                                                                (£<?php echo e(number_format($option['price'], 2)); ?>) <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </td>

                                       <?php
  $extra_options = json_decode($item->extra_options, true);
  $extra_options_total = 0;
  if (!empty($extra_options)) {
      foreach ($extra_options as $option) {
          if (!empty($option['price']) && floatval($option['price']) > 0) {
              $extra_options_total += floatval($option['price']);
          }
      }
  }
  $item_total_with_extras = $item->sub_total + $extra_options_total;
  $rate = $item->quantity > 0 ? $item_total_with_extras / $item->quantity : 0;
?>

<td><?php echo e($item->quantity); ?></td>
<td><?php echo e(number_format($rate, 2)); ?></td>
<td><?php echo e(number_format($item_total_with_extras, 2)); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                     <?php
                    $extra_options_grand_total = 0;
                    foreach ($quote->items as $item) {
                      $options = json_decode($item->extra_options, true);
                      if (!empty($options)) {
                        foreach ($options as $option) {
                          if (!empty($option['price']) && floatval($option['price']) > 0) {
                            $extra_options_grand_total += floatval($option['price']);
                          }
                        }
                      }
                    }
                    $subtotal_with_extras = $quote->items->sum('sub_total') + $extra_options_grand_total + ($quote->proof_price ?? 0);
                  ?>
                                    <th>Subtotal:</th>
                                   <td class="text-right">£<?php echo e(number_format($subtotal_with_extras, 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->delivery_price, 2)); ?></td>
                                </tr>
                                <!-- <tr>
                    <th>Proof Reading:</th>
                    <td class="text-right">£<?php echo e(number_format($quote->proof_price, 2)); ?></td>
                  </tr> -->
                                <tr>
                                    <th>VAT (<?php echo e((int) $quote->vat_percentage); ?>%):</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->vat_amount, 2)); ?></td>
                                </tr>
                                <tr class="font-weight-bold"
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th><strong>Total</strong></th>
                                    <td class="text-right"><strong>£<?php echo e(number_format($quote->grand_total, 2)); ?></strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="<?php echo e(route('admin.invoices.download', $quote->id)); ?>"
                                class="btn btn-outline-primary btn-block">
                                Download Invoice
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success btn-block">Send via Email</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/quotes/view-invoice.blade.php ENDPATH**/ ?>