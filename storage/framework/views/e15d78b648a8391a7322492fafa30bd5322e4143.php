<div class="form-group">
    <?php if(isset($label)): ?>
        <label for="<?php echo e($name); ?>"><?php echo e($label); ?></label>
    <?php endif; ?>
    <textarea name="<?php echo e($name); ?>" <?php if(isset($id)): ?> id="<?php echo e($id); ?>" <?php endif; ?> class="form-control <?php if(isset($class)): ?> <?php echo e($class); ?> <?php endif; ?>"><?php echo e($value); ?></textarea>
</div>
<?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/form/textarea.blade.php ENDPATH**/ ?>