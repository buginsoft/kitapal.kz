

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="wallet-box">
                    <form style="display:none" id="walletoneform" class="signUpForm" action="https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=<?php echo e($mrh_login); ?>&OutSum=<?php echo e($out_summ); ?>&InvoiceID=<?php echo e($inv_id); ?>&Description=<?php echo e($inv_desc); ?>&SignatureValue=<?php echo e($crc); ?>&IsTest=<?php echo e($IsTest); ?>" method="POST">
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/robokassa.blade.php ENDPATH**/ ?>