<?php $__env->startSection('css'); ?>
    <link href="/new_admin_design/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/new_admin_design/assets/css/forms/theme-checkbox-radio.css">
    <link href="/new_admin_design/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <?php echo $__env->yieldContent('page_level_css'); ?>
<?php $__env->stopSection(); ?>

<style>
    .form__button{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn{
        box-shadow:unset !important;
    }
</style>

<?php $__env->startSection('content'); ?>
    <div class="container" style="justify-content:center; margin:0; max-width:unset !important;">
        <div class="container">
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-10">
                                    <div class="form__button">
                                        <h4><?php echo $__env->yieldContent('form_title'); ?></h4>
                                        <?php echo $__env->yieldContent('previews_button'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php echo $__env->yieldContent('form'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="/new_admin_design/assets/js/scrollspyNav.js"></script>
    <script src="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.js?v=2"></script>
    <?php echo $__env->yieldContent('page_level_js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/layouts/form.blade.php ENDPATH**/ ?>