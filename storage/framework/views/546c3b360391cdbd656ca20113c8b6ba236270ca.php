<?php
    $lang=App::getLocale();
    $name='name_'.$lang;
?>
<?php $__env->startSection('title' ,__('gift.header')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="section-row">
                <div class="max-w-670">
                    <h1 class="big-title">
                        <?php echo app('translator')->get('gift.header'); ?>
                    </h1>
                    <p><?php echo app('translator')->get('gift.info'); ?></p>
                    <div class="right-block d-flex-page border-block mt-40">
                        <div>
                            <img src="<?php echo e($item->main_image()->path); ?>">
                        </div>
                        <div>
                            <p>
                                <b><?php echo e($item->book_name); ?></b>
                                <span class="text-grey d-block">
                                    <?php echo $__env->make('includes.bookauthors',['authors'=>$item->authors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </span>
                            </p>
                            <p><?php echo e($item->getPrice('ebook')); ?> ₸</p>
                        </div>
                    </div>
                    <div class="bottom-itog">
                        <p class="clearfix"><?php echo app('translator')->get('basket.total'); ?>
                            <b class="pull-right"><?php echo e($item->getPrice('ebook')); ?> <?php echo app('translator')->get('basket.tenge'); ?></b>
                        </p>
                    </div>
                    <div class="input-prof mt-40">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="/paymentInit">
                            <?php echo csrf_field(); ?>
                            <div class="mb-25">
                                <p class="mb-25 line-title">
                                    <b><?php echo app('translator')->get('basket.personalinfo'); ?></b>
                                </p>
                                <div class="row">
                                    <input  type="hidden"  name="book[]" value="<?php echo e($item->book_id); ?>">
                                    <input  type="hidden"  name="booktypes[]" value="ebook">
                                    <input  type="hidden"  name="order_id" value="<?php echo e($order->order_id); ?>">
                                    <input  type="hidden"  name="bookquantity[]" value="1">
                                    <input  type="hidden"  name="is_gift" value="1">
                                    <input  type="hidden" name="price" value="<?php echo e($item->getPrice('ebook')); ?>">
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" placeholder="<?php echo app('translator')->get('gift.recipient_name'); ?>" name="recipient_name">
                                        <?php $__errorArgs = ['recipient_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="email" placeholder="<?php echo app('translator')->get('gift.recipient_email'); ?>"
                                               name="recipient_email">
                                        <?php $__errorArgs = ['recipient_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                             <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea  rows="30" class="form-control" name="gift_comment" placeholder="Хабарлама"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-25">
                                <p class="fs-15 text-grey"><?php echo app('translator')->get('basket.errorinfo'); ?></p>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-blue btn-lg" type="submit"><?php echo app('translator')->get('basket.pay'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/giftPage.blade.php ENDPATH**/ ?>