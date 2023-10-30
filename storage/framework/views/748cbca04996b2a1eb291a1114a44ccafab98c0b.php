<div class="form-group">
    <?php if(isset($label)): ?>
        <label for="<?php echo e($name); ?>"><?php echo e($label); ?></label>
    <?php endif; ?>
    <input type="<?php echo e($type); ?>" <?php if(isset($id)): ?> id="<?php echo e($id); ?>" <?php endif; ?> class="form-control <?php if(isset($class)): ?> <?php echo e($class); ?> <?php endif; ?>"
           name="<?php echo e($name); ?>" <?php if(isset($placeholder)): ?> placeholder="<?php echo e($placeholder); ?>" <?php endif; ?> value="<?php echo e($value); ?>"/>
</div>
<?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/form/input.blade.php ENDPATH**/ ?>