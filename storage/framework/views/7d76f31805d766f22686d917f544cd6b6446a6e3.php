
<?php $__env->startSection('breadcrumb',''); ?>
<?php $__env->startSection('form_title' ,''); ?>
<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/subscription-information" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form'); ?>
    <form  action="/admin/subscription-information/<?php echo e($item->id); ?>" method="POST">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <input type="text" name="title_ru" class="form-control" value="<?php echo e($item->title_ru); ?>">
        <input type="text" name="title_kz" class="form-control" value="<?php echo e($item->title_kz); ?>">
        <input type="number" name="sort" class="form-control" value="<?php echo e($item->sort); ?>">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/subscription/information/form.blade.php ENDPATH**/ ?>