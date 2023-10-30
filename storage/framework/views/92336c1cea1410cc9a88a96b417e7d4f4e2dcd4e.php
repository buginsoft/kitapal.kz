

<?php $__env->startSection('form_title','Изменить переводчика'); ?>
<?php $__env->startSection('breadcrumb','Изменить переводчика'); ?>

<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/translator" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
    <div class="widget-content widget-content-area simple-pills">
        <form  action="/admin/translator/<?php echo e($translator->id); ?>" method="POST" >
            <?php echo method_field('put'); ?>
            <?php echo csrf_field(); ?>
            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label>ФИО КЗ</label>
                    <input type="text" class="form-control" name="name_kz"
                           value="<?php echo e($translator->name_kz); ?>" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label>ФИО РУ</label>
                    <input type="text" class="form-control" name="name_ru" value="<?php echo e($translator->name_ru); ?>" />
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/translator/edit.blade.php ENDPATH**/ ?>