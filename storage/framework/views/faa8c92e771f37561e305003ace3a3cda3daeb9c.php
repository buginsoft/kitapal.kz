<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="wallet-box">
                    <form style="display:none" id="walletoneform" class="signUpForm" action="https://wl.walletone.com/checkout/checkout/Index" method="POST">
                        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(is_array($val)): ?>
                                <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($val); ?>">
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <input type="submit" value="<?php echo app('translator')->get('basket.button'); ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function(){
            $("form#walletoneform").submit();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/walletone.blade.php ENDPATH**/ ?>