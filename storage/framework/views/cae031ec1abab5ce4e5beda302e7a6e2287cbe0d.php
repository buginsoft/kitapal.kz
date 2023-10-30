<?php if($paginator->hasPages()): ?>




    <ul class="pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="disabled"><span>Предыдущий</span></li>
        <?php else: ?>
            <li><a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="Previous">
                    <span aria-hidden="true">Предыдущий</span></a></li>
        <?php endif; ?>


        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="disabled"><span><?php echo e($element); ?></span></li>
            <?php endif; ?>


            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="active my-active"><span><?php echo e($page); ?></span></li>
                    <?php else: ?>
                        <li><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        
        <?php if($paginator->hasMorePages()): ?>
            <li><a href="<?php echo e($paginator->nextPageUrl()); ?>" aria-label="Next" rel="next">
                    <span aria-hidden="true">Следующий</span></a></li>
        <?php else: ?>
            <li class="disabled"><span>Следующий</span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/vendor/pagination/custom.blade.php ENDPATH**/ ?>