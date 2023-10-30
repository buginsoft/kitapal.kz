<?php $__env->startSection('form_title','Контакты'); ?>
<?php $__env->startSection('breadcrumb','Контакты'); ?>
<?php $__env->startSection('page_level_css'); ?>
    <script src="/new_admin_design/assets/js/libs/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/ckeditor4/samples/css/samples.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form'); ?>
    <div class="widget-content widget-content-area simple-pills">
        <form action="/admin/contacts/<?php echo e($contact->id); ?>" method="POST" id="createForm" >
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
            <div class="form-group">
                <label>Ватсап</label>
                <input type="text" class="form-control" name="phone" value="<?php echo e($contact->phone); ?>" />
            </div>
            <div class="form-group">
                <label>Почта</label>
                <input type="text" class="form-control" name="email" value="<?php echo e($contact->email); ?>"/>
            </div>

            <?php echo $__env->make('form.textarea' , ['id'=>'editor1' , 'label'=>'Телефон','name'=>'contact2' , 'value'=>$contact->contact2 , ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('form.textarea' , ['id'=>'editor2' ,'label'=>'Адрес самовывоза(kz)','name'=>'pickup_address_ru' , 'value'=>$contact->pickup_address_ru], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('form.textarea' , ['id'=>'editor3' , 'label'=>'Адрес самовывоза(ru)','name'=>'pickup_address_kz' , 'value'=>$contact->pickup_address_kz], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Изменить</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_js'); ?>

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.replace("editor1");
        CKEDITOR.replace("editor2");
        CKEDITOR.replace("editor3");
        CKEDITOR.config.filebrowserUploadUrl = '<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/contact/index.blade.php ENDPATH**/ ?>