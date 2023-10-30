<?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($author["name_$lang"]); ?> <?php if(!$loop->last): ?>,<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/includes/bookauthors.blade.php ENDPATH**/ ?>