<div class="form-group">
    <label class="new-control new-checkbox checkbox-primary">
        <input <?php if(isset($id)): ?> id="<?php echo e($id); ?>" <?php endif; ?> type="checkbox" class="new-control-input" value="1" name="<?php echo e($name); ?>"
               <?php if(isset($checked) && $checked): ?> checked <?php endif; ?>>
        <span class="new-control-indicator"></span><?php echo e($label); ?>

    </label>
</div>
<?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/includes/form/checkbox.blade.php ENDPATH**/ ?>