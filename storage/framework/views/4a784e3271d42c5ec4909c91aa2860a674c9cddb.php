

<?php $__env->startSection('title'); ?>
    Cart
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="featured-area">
        <div class="container py-1">
            <h1 class="text-center font-weight-bold mb-4" style="font-size:2.8rem">Your shopping cart</h1>
            <p class="text-center mb-3" style="font-size:1.1rem;">
                We can produce up to 50 drawings per day. Receive your artwork proof within 24 hours!
                <span style="color:#ff3c78;font-weight:bold;">15/50</span> Spots left
            </p>
            <div class="progress mx-auto mb-4" style="max-width:400px; height:18px;">
                <div class="progress-bar" role="progressbar" style="width:30%;background:#ffb9c9;" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="50">
                    <span style="position:absolute;left:50%;transform:translateX(-50%);color:#ff3c78;">15</span>
                </div>
            </div>
            <?php if(count($enrichedCart) > 0): ?>
                <div class="text-center mb-4">
                    <a href="<?php echo e(route('checkout')); ?>" class="btn btn-lg"
                        style="background:#ff3c78;color:#fff;font-size:1.5rem;font-weight:bold;border-radius:25px;padding:14px 40px;box-shadow:0 2px 10px #ff3c7833;">
                        Go to checkout &rarr;
                    </a>
                </div>

                <div class="row d-none d-lg-flex font-weight-bold mb-2 " style="color:#343434;font-size:1.15rem;">
                    <div class="col-12 col-lg-2">Product</div>
                    <div class="col-12 col-lg-5"></div>
                    <div class="col-6 col-lg-2 text-center">Quantity</div>
                    <div class="col-6 col-lg-2 text-right">Total</div>
                    <div class="col-12 col-lg-1"></div>
                </div>
            <?php endif; ?>
            <?php $__empty_1 = true; $__currentLoopData = $enrichedCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $cart = $entry['item'];
                    $attributes = $entry['attributes'];
                ?>

                <div class="row align-items-center py-3 border-bottom border mb-3 ">
                    <div class="col-12 col-lg-2">
                        <?php if(!empty($cart['photos'][0])): ?>
                            <img src="<?php echo e(asset('storage/' . $cart['photos'][0])); ?>" alt="Product image"
                                style="width:90px; border-radius:8px; box-shadow:0 2px 8px #eee;">
                        <?php else: ?>
                            <div
                                style="width:90px; height:110px; background:#f2f2f2; display:flex; align-items:center; justify-content:center; color:#bbb;">
                                No Image
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-lg-5" style="padding-bottom:10px;">
                        
                        <?php if(!empty($entry['subcategory_name'])): ?>
                            <div style="font-size:1.1rem; font-weight:bold; color:#343434;">
                                <?php echo e($entry['subcategory_name']); ?>

                            </div>
                        <?php endif; ?>
                        <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="font-size:1rem; margin-top:3px; margin-bottom:5px;">
                                <span style="color:#555;"><?php echo e($attr['name']); ?>:</span><br>
                                <span style="font-weight:600;"><?php echo e($attr['value']); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php if(!empty($cart['extra_options'])): ?>
                            <div style="margin-top:8px;">
                                <strong>Extra Options:</strong>
                                <ul style="padding-left: 20px; margin-bottom: 0;">
                                    <?php $__currentLoopData = $cart['extra_options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($extra['title']); ?> (+&pound;<?php echo e(number_format($extra['price'], 2)); ?>)</li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-6 col-lg-2  mt-2">
                        <form method="POST" action="<?php echo e(route('cart.update', ['index' => $loop->index])); ?>"
                            class="d-inline-flex align-items-center justify-content-center">
                            <?php echo csrf_field(); ?>
                            <button type="submit" name="action" value="decrease"
                                class="btn btn-outline-secondary btn-sm px-2">−</button>
                            <input type="text" name="quantity" value="<?php echo e($cart['quantity'] ?? 1); ?>" readonly
                                class="form-control form-control-sm text-center mx-2" style="width: 45px;">
                            <button type="submit" name="action" value="increase"
                                class="btn btn-outline-secondary btn-sm px-2">+</button>
                        </form>
                    </div>

                    <div class="col-6 col-lg-2 text-right font-weight-bold mt-2" style="font-size:1.15rem;">
                        &pound;<?php echo e(number_format($cart['total_price'] ?? 0, 2)); ?>

                    </div>

                    <div class="col-12 col-lg-1 text-right">
                        <a href="<?php echo e(route('cart.remove', ['index' => $loop->index])); ?>" class="text-danger" title="Remove"><i
                                class="fa fa-trash" style="font-size:22px;"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-5" style="font-size:1.3rem; color:#777;">
                    No Portrait has been added to cart.
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <?php if($firstCategory): ?>
                <a href="<?php echo e(route('category.show', $firstCategory->slug)); ?>"
                    style="display:inline-block; border-radius:6px; padding:8px 26px; font-size:1.4rem; font-weight:600; box-shadow:0 2px 8px #dcf1fb; color:#11B7D7; text-decoration:underline; position:relative;">
                    <span style="color:#ff3b7c; font-size:1.3em; position:relative; top:2px; margin-right:8px;">&#9998;</span>
                    Customize Your portrait
                </a>
            <?php endif; ?>
            <div style="color:#999; font-size:1.07rem; margin-top:4px; font-style:italic;">
                and receive a free digital download
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/front/cart.blade.php ENDPATH**/ ?>