<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #<?php echo e($invoice->invoice_number); ?></title>
    
    <style>
        <?php echo file_get_contents(public_path('admin_assets/css/bootstrap.min.css')); ?>

        <?php echo file_get_contents(public_path('admin_assets/css/style.css')); ?>

 </style>
</head>

<body>
            <div class="content-body">
                <div class="card p-4 shadow-sm" style="max-width: 900px; margin: auto; background: #fff;">

                    
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="mb-0" style="font-weight:700;">INVOICE</h2>
                            <small class="text-muted"
                                style="font-weight:600;">#<?php echo e($invoice->invoice_number ?? 'N/A'); ?></small>
                        </div>
                        <div>
                            <img src="<?php echo e(public_path('admin_assets/images/logo.png')); ?>" alt="Logo" style="height: 30px;">
                        </div>
                    </div>

                    
                    <div class="row border-top border-bottom   mb-4" style="font-size: 14px;">
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">Info</strong>
                            <hr>
                            <p class="" style="margin-bottom:6px;"><strong>Invoice Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y')); ?></p>
                            <p style="margin-bottom:6px;"> <strong>Order Id: </strong>
                                #<?php echo e($quote->order_number); ?></p>
                            <p style="margin-bottom:6px;"> <strong>Payment Status: </strong>
                                <?php echo e($payments->sum('amount_received') >= $quote->grand_total ? 'Paid' : 'Unpaid'); ?></p>
                            <p style="margin-bottom:6px;"> <strong>Payment Method: </strong>
                                <?php echo e($payments->last()->payment_method ?? 'N/A'); ?></p>
                            <p style="margin-bottom:6px;"> <strong>Payment Date:
                                </strong><?php echo e(\Carbon\Carbon::parse($payments->last()->payment_date)->format('d M, Y') ?? 'N/A'); ?>

                            </p>

                        </div>
                        <div class="col-md-4 border-left border-right p-2">
                            <strong class="mb-1">Billed to</strong>
                            <hr>
                            <p class="" style="margin-bottom:6px;font-weight:600;">
                                <?php echo e($customer->first_name ?? '-'); ?>

                                <?php echo e($customer->last_name ?? ''); ?>

                            </p>
                            <p class="" style="margin-bottom:6px;"><?php echo e($quote->deliveryAddress->address ?? ''); ?>,
                                <?php echo e($quote->deliveryAddress->city ?? ''); ?>,
                                <?php echo e($quote->deliveryAddress->postcode ?? ''); ?>,
                                <?php echo e($quote->deliveryAddress->country_name ?? ''); ?></p>

                            <p style="margin-bottom:4px; "><?php echo e($customer->mobile ?? ''); ?></p>
                            <p class="text-blue" style="margin-bottom:6px; color:blue;"><?php echo e($customer->email ?? ''); ?></p>
                        </div>
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">From</strong>
                            <hr>

                            <p class="" style="margin-bottom:6px;font-weight:600;">Nuvem Print</p>
                            <p class="" style="margin-bottom:6px; ">Unit 7 Lotherton Way Garforth Leeds LS252JY</p>

                            <!--<p class="mb-1">www.company.com</p>-->
                            <p style="margin-bottom:4px; "> 01132 874724</p>
                            <p class=" text-blue" style="color:blue;">andy@nuvemprint.com</p>
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
    
    <div style="font-weight: 600;">
        <?php echo e($item->subcategory->name ?? 'N/A'); ?>

        (<?php echo e(optional($item->subcategory->categories->first())->name ?? 'N/A'); ?>)
    </div>

    
    <?php if($item->attributes && $item->count()): ?>
        <div style="margin-top: 5px;">
            <?php $__currentLoopData = $item->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="font-size: 13px; margin-left: 8px;">
                    <strong><?php echo e($attr->attribute->name ?? ''); ?>:</strong>
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
        <div style="margin-top: 10px; padding: 8px; background-color: #f8f9fa; border-radius: 5px; font-size: 12px;">
            <strong>Pet Details:</strong><br>
            <?php if($item->pet_name): ?>
                <div style="margin-left: 10px;">Name: <?php echo e($item->pet_name); ?></div>
            <?php endif; ?>
            <?php if($item->pet_birthdate): ?>
                <div style="margin-left: 10px;">Birthdate: <?php echo e($item->pet_birthdate->format('d M Y')); ?></div>
            <?php endif; ?>
            <?php if($item->personal_text): ?>
                <div style="margin-left: 10px;">Personal Text: <?php echo e($item->personal_text); ?></div>
            <?php endif; ?>
            <?php if($item->note): ?>
                <div style="margin-left: 10px;">Note: <?php echo e($item->note); ?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    
    <?php
        $extra_options = json_decode($item->extra_options, true);
    ?>
    <?php if(!empty($extra_options)): ?>
        <div style="margin-top: 10px;">
            <strong>Extra Options:</strong><br>
            <?php $__currentLoopData = $extra_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span style="display: inline-block; background-color: #17a2b8; color: white; padding: 3px 8px; 
                             border-radius: 12px; font-size: 12px; margin-right: 5px;">
                    <?php echo e($opt['title']); ?> <?php if(!empty($opt['price']) && (float)$opt['price'] > 0): ?>
                        (£<?php echo e(number_format((float)$opt['price'], 2)); ?>)
                    <?php endif; ?>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</td>


    <?php
  $extraOptions = json_decode($item->extra_options, true) ?: [];
  $extraOptionsTotal = 0;
  foreach($extraOptions as $opt) {
    if(isset($opt['price']) && floatval($opt['price']) > 0) {
      $extraOptionsTotal += floatval($opt['price']);
    }
  }
  $itemTotalWithExtras = $item->sub_total + $extraOptionsTotal;
  $rate = $item->quantity > 0 ? $itemTotalWithExtras / $item->quantity : 0;
?>
                                     <td><?php echo e($item->quantity); ?></td>
<td><?php echo e(number_format($rate, 2)); ?></td>
<td><?php echo e(number_format($itemTotalWithExtras, 2)); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <?php
  $optionsGrandTotal = 0;
  foreach($quote->items as $item) {
    $options = json_decode($item->extra_options, true) ?: [];
    foreach($options as $opt) {
      if(isset($opt['price']) && floatval($opt['price']) > 0) {
        $optionsGrandTotal += floatval($opt['price']);
      }
    }
  }
  $subtotalWithExtras = $quote->items->sum('sub_total') + $optionsGrandTotal + ($quote->proof_price ?? 0);
?>

                                <tr>
  <th>Subtotal:</th>
  <td class="text-right">£<?php echo e(number_format($subtotalWithExtras, 2)); ?></td>
</tr>

                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->delivery_price, 2)); ?></td>
                                </tr>
                                 <tr>
                                    <th>Proof Reading:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->proof_price, 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>VAT (<?php echo e((int)$quote->vat_percentage); ?>%):</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->vat_amount, 2)); ?></td>
                                </tr>
                            
                                <tr class="font-weight-bold "
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th><strong>Total</strong></th>
                                    <td class="text-right"><strong>£<?php echo e(number_format($quote->grand_total, 2)); ?></strong></td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    
                    <!-- <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="<?php echo e(route('admin.invoices.download', $quote->id)); ?>" class="btn btn-outline-primary btn-block">
                                Download Invoice
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success btn-block">Send via Email</button>
                        </div>
                    </div> -->

                </div>
            </div>
        

</body>

</html><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/quotes/down-invoice.blade.php ENDPATH**/ ?>