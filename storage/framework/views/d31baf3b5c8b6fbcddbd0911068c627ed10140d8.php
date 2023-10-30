<?php
    $book = App\Models\Book::all();
?>
    <option selected>Выберите</option>
<?php $__currentLoopData = $book; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!empty($chapter)): ?>
    <option value="<?php echo e($item->book_id); ?>" <?php echo e(($chapter->ch_book_id == $item->book_id) ? "selected" : ""); ?>><?php echo e($item->book_name); ?></option>
    <?php elseif(!empty($slider)): ?>
    <option value="<?php echo e($item->book_id); ?>" <?php echo e(($slider->slider_book_id == $item->book_id) ? "selected" : ""); ?>><?php echo e($item->book_name); ?></option>
    <?php elseif(!empty($text)): ?>
    <option value="<?php echo e($item->book_id); ?>" <?php echo e(($text->text_book_id == $item->book_id) ? "selected" : ""); ?>><?php echo e($item->book_name); ?></option>
    <?php else: ?>
    <option value="<?php echo e($item->book_id); ?>"><?php echo e($item->book_name); ?></option>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/layouts/book.blade.php ENDPATH**/ ?>