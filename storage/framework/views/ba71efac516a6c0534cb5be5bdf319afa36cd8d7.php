<?php
    $collection = App\Models\Collection::all();
?>
    <option selected>Выберите</option>
<?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!empty($book)): ?>
    <option value="<?php echo e($item->collection_id); ?>" <?php echo e(($book->book_collection_id == $item->collection_id) ? "selected" : ""); ?>><?php echo e($item->collection_name_ru); ?></option>
    <?php else: ?>
    <option value="<?php echo e($item->collection_id); ?>"><?php echo e($item->collection_name_ru); ?></option>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/layouts/collection.blade.php ENDPATH**/ ?>