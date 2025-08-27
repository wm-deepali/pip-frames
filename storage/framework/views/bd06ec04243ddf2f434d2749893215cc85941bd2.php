<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quote #<?php echo e($quote->quote_number); ?></title>
    
    <style>
        <?php echo file_get_contents(public_path('admin_assets/css/bootstrap.min.css')); ?>

        <?php echo file_get_contents(public_path('admin_assets/css/style.css')); ?>

    </style>
</head>

<body>
    <div class="content-body">
        <div class="card">
            <div class="card-body">

                
                <div class="text-center mb-3">
                    <img src="<?php echo e(public_path('admin_assets/images/logo.png')); ?>" alt="Company Logo"
                        style="max-width: 200px;">
                </div>

                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5><strong>Order ID:</strong> #<?php echo e($quote->quote_number); ?></h5>
                        <h5>
                            <strong>Payment Status:</strong>
                            <?php if($quote->payments->isEmpty()): ?>
                                <span class="badge badge-danger">UnPaid</span>
                            <?php else: ?>
                                <span class="badge badge-success">Paid</span>
                            <?php endif; ?>
                        </h5>
                        <h5>
                            <strong>Order Status:</strong>
                            <?php if($quote->status === 'cancelled'): ?>
                                <span class="badge badge-danger">Cancelled</span>
                            <?php elseif($quote->status === 'approved'): ?>
                                <span class="badge badge-success">Approved</span>
                            <?php else: ?>
                                <span class="badge badge-secondary text-capitalize"><?php echo e($quote->status ?? 'Pending'); ?></span>
                            <?php endif; ?>
                        </h5>

                    </div>


                </div>

                
                <div class="row border p-3 mb-4">
                    <div class="col-md-6">
                        <h5><strong>Customer Info</strong></h5>
                        <p><strong>Name:</strong> <?php echo e($quote->customer->first_name ?? 'N/A'); ?>

                            <?php echo e($quote->customer->last_name ?? ''); ?>

                        </p>
                        <p><strong>Contact:</strong> <?php echo e($quote->customer->mobile ?? 'N/A'); ?></p>
                        <p><strong>Email:</strong> <?php echo e($quote->customer->email ?? 'N/A'); ?></p>
                        <p><strong>Expected Delivery:</strong>
                            <?php echo e(\Carbon\Carbon::parse($quote->delivery_date)->format('d F Y') ?? 'N/A'); ?></p>
                        <p><strong>Date & Time:</strong> <?php echo e($quote->created_at->format('d F Y, h:i A') ?? 'N/A'); ?></p>
                        <p><strong>Delivery Address:</strong>
                            <?php echo e($quote->deliveryAddress->address ?? ''); ?>, <?php echo e($quote->deliveryAddress->city ?? ''); ?>,
                            <?php echo e($quote->deliveryAddress->postcode ?? ''); ?>,
                            <?php echo e($quote->deliveryAddress->country_name ?? ''); ?>

                        </p>

                    </div>
                    <div class="col-md-6 text-right">
                        <h5><strong>Company Info</strong></h5>
                        <p><strong>Name:</strong> My Company Name</p>
                        <p><strong>Contact:</strong> 0-00-000-000</p>
                        <p><strong>Email:</strong> yourcompany@gmail.com</p>
                        <p><strong>Address:</strong> Company Street, NY 1001-234</p>
                        <p><strong>Website:</strong> www.company.com</p>
                    </div>
                </div>

                
                
                <h5 class="mb-2">Quote Items</h5>
                <div class="table-responsive">
                    <?php
                        $totalExtraOptions = 0;
                        foreach ($quote->items as $item) {
                            $options = json_decode($item->extra_options, true) ?: [];
                            foreach ($options as $opt) {
                                if (!empty($opt['price']) && floatval($opt['price']) > 0) {
                                    $totalExtraOptions += floatval($opt['price']);
                                }
                            }
                        }
                    ?>

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
                                <?php
                                    $extraOptions = json_decode($item->extra_options, true) ?: [];
                                    $extraOptionsTotal = 0;
                                    foreach ($extraOptions as $opt) {
                                        if (!empty($opt['price']) && floatval($opt['price']) > 0) {
                                            $extraOptionsTotal += floatval($opt['price']);
                                        }
                                    }
                                    $itemTotalWithExtras = $item->sub_total + $extraOptionsTotal;
                                    $rate = ($item->quantity > 0) ? $itemTotalWithExtras / $item->quantity : 0;
                                  ?>
                                <tr>
                                    <td>
                                        <div style="font-weight: 600; margin-bottom: 5px;">
                                            <?php echo e($item->subcategory->name ?? 'N/A'); ?>

                                            (<?php echo e(optional($item->subcategory->categories->first())->name ?? 'N/A'); ?>)
                                        </div>
                                        <?php if($item->attributes->count()): ?>
                                            <?php $__currentLoopData = $item->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div style="font-size: 13px; margin-left: 8px;">
                                                    <strong><?php echo e($attribute->attribute->name ?? ''); ?>:</strong>
                                                    <?php if($attribute->attributeValue): ?>
                                                        <?php echo e($attribute->attributeValue->value); ?>

                                                    <?php elseif($attribute->length && $attribute->width): ?>
                                                        <?php echo e($attribute->length); ?> x <?php echo e($attribute->width); ?> <?php echo e($attribute->unit); ?>

                                                    <?php elseif($attribute->length): ?>
                                                        <?php echo e($attribute->length); ?> <?php echo e($attribute->unit); ?>

                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if($item->pet_name || $item->pet_birthdate || $item->personal_text || $item->note): ?>
                                            <div
                                                style="margin-top: 8px; font-size: 13px; background-color: #f8f9fa; padding: 5px; border-radius: 5px;">
                                                <strong>Pet Details:</strong><br>
                                                <?php if($item->pet_name): ?>
                                                <div>Name: <?php echo e($item->pet_name); ?></div><?php endif; ?>
                                                <?php if($item->pet_birthdate): ?>
                                                <div>Birthdate: <?php echo e($item->pet_birthdate->format('d M Y')); ?></div><?php endif; ?>
                                                <?php if($item->personal_text): ?>
                                                <div>Personal Text: <?php echo e($item->personal_text); ?></div><?php endif; ?>
                                                <?php if($item->note): ?>
                                                <div>Note: <?php echo e($item->note); ?></div><?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(count($extraOptions)): ?>
                                            <div style="margin-top: 8px;">
                                                <strong>Extra Options:</strong><br>
                                                <?php $__currentLoopData = $extraOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span
                                                        style="background: #17a2b8; color: #fff; padding: 3px 8px; margin-right: 4px; border-radius: 12px; font-size: 12px;">
                                                        <?php echo e($opt['title']); ?>

                                                        <?php if(!empty($opt['price']) && floatval($opt['price']) > 0): ?>(£<?php echo e(number_format(floatval($opt['price']), 2)); ?>)<?php endif; ?>
                                                    </span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td>£<?php echo e(number_format($rate, 2)); ?></td>
                                    <td>£<?php echo e(number_format($itemTotalWithExtras, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    
                    <?php
                        $subtotalWithExtras = $quote->items->sum('sub_total') + $totalExtraOptions + ($quote->proof_price ?? 0);
                    ?>

                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">£<?php echo e(number_format($subtotalWithExtras, 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->delivery_price, 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>VAT (<?php echo e((int) $quote->vat_percentage); ?>%):</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->vat_amount, 2)); ?></td>
                                </tr>
                                <tr
                                    style="border-top: 2px solid #6B3DF4; border-bottom: 2px solid #6B3DF4; font-weight: bold; font-size: 18px; color: #6B3DF4;">
                                    <th>Total:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->grand_total, 2)); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>



                
                <!-- <div class="row justify-content-end mt-4">
                    <div class="col-md-5">
                        <table class="table table-borderless">
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-right">
                                    £<?php echo e(number_format($quote->items->sum('sub_total') + ($quote->proof_price ?? 0), 2)); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Delivery Charge:</th>
                                <td class="text-right">£<?php echo e(number_format($quote->delivery_price, 2)); ?></td>
                            </tr>
                            <tr>
                                <th>VAT (<?php echo e((int) $quote->vat_percentage); ?>%):</th>
                                <td class="text-right">£<?php echo e(number_format($quote->vat_amount, 0)); ?></td>
                            </tr>
                            <tr class="border-top">
                                <th><strong>Grand Total:</strong></th>
                                <td class="text-right"><strong>£<?php echo e(number_format($quote->grand_total, 2)); ?></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div> -->


                
                <!-- <hr> -->

                
                <!-- <h5>Customer Documents</h5>
                <div class="table-responsive">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Remarks / Title</th>
                                <th>Thumbnail</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $quote->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($doc->name ?? 'Untitled'); ?></td>
                                    <td>
                                        <?php if(Str::endsWith($doc->path, ['.jpg', '.jpeg', '.png'])): ?>
                                            <img src="<?php echo e(asset('storage/' . $doc->path)); ?>" width="80" />
                                        <?php elseif(Str::endsWith($doc->path, '.pdf')): ?>
                                            <img src="<?php echo e(asset('admin_assets/images/pdf.png')); ?>" width="40" alt="PDF" />
                                        <?php elseif(Str::endsWith($doc->path, ['.doc', '.docx'])): ?>
                                            <img src="<?php echo e(asset('admin_assets/images/google-docs.png')); ?>" width="40"
                                                alt="Word Doc" />
                                        <?php else: ?>
                                            <span class="text-muted">No Preview</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(asset('storage/' . $doc->path)); ?>" target="_blank"
                                            class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center">No documents uploaded.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div> -->


                <!-- 
                <div class="row justify-content-center mt-4">
                    <div class="col-md-2">
                        <a href="<?php echo e(route('admin.quotes.download.pdf', $quote->id)); ?>" class="btn btn-primary btn-block"
                            target="_blank">
                            Download PDF
                        </a>

                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btn-block">Send Email</button>
                    </div>
                </div> -->

            </div>
        </div>
    </div>


</body>

</html><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/quotes/pdf.blade.php ENDPATH**/ ?>