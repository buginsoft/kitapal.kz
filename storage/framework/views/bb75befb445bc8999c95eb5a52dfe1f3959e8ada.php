<?php if(session()->has('notify')): ?>
    <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            Swal.fire({
                icon: '<?php echo e($msg[0]); ?>',
                text: '<?php echo e($msg[1]); ?>'
            })
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/includes/notify.blade.php ENDPATH**/ ?>