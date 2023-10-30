<?php $__env->startSection('css'); ?>
    <link href="/new_admin_design/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form_title',$title); ?>
<?php $__env->startSection('breadcrumb',$title); ?>

<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/publisher" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form'); ?>

    <form  action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
        <?php if(!empty($publisher)): ?>
            <?php echo method_field('put'); ?>
        <?php endif; ?>
        <?php echo csrf_field(); ?>
        <div class="widget-content widget-content-area simple-pills">
            <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                       href="#pills-contact" role="tab" aria-controls="pills-home" aria-selected="true">
                        Русский
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                       href="#pills-home" role="tab" aria-controls="pills-contact" aria-selected="false">
                        Казахский
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" class="form-control" name="name_ru" value="<?php echo e(!empty($publisher)?$publisher->name_ru:''); ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="description_ru"  id="editor1" class="form-control"><?php echo e(!empty($publisher)?$publisher->description_ru:''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Дереккөз</label>
                        <textarea name="source_ru" id="editor2" class="form-control"><?php echo e(!empty($publisher)?$publisher->source_ru:''); ?></textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab2">

                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" class="form-control" name="name_kz" value="<?php echo e(!empty($publisher)?$publisher->name_kz:''); ?>" />
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="description_kz" id="editor3" class="form-control"><?php echo e(!empty($publisher)?$publisher->description_kz:''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Дереккөз</label>
                        <textarea name="source_kz" id="editor4" class="form-control"><?php echo e(!empty($publisher)?$publisher->source_kz:''); ?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Facebook</label>
                <input type="text" class="form-control" name="facebook" value="<?php echo e(!empty($publisher)?$publisher->facebook:''); ?>"/>
            </div>
            <div class="form-group">
                <label>Instagram</label>
                <input type="text" class="form-control" name="instagram" value="<?php echo e(!empty($publisher)?$publisher->instagram:''); ?>"/>
            </div>
            <div class="form-group">
                <label>VK</label>
                <input type="text" class="form-control" name="vk" value="<?php echo e(!empty($publisher)?$publisher->vk:''); ?>"/>
            </div>
            <div class="form-group">
                <label>Telegram</label>
                <input type="text" class="form-control" name="telegram" value="<?php echo e(!empty($publisher)?$publisher->telegram:''); ?>"/>
            </div>
            <div class="form-group">
                <label>Twitter</label>
                <input type="text" class="form-control" name="twitter" value="<?php echo e(!empty($publisher)?$publisher->twitter:''); ?>"/>
            </div>

            <?php echo $__env->make('admin.includes.fileupload', ['name' => 'photo'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="col-lg-8 col-md-12 text-right">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="/new_admin_design/assets/js/scrollspyNav.js"></script>
    <script src="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.js"></script>
    <script>
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        <?php if(!empty($publisher)): ?>
        $(".custom-file-container__image-preview").css({
            "background-image": "url(<?php echo e('https://kitapal.kz'.$publisher->photo); ?>)"
        });
        <?php endif; ?>
    </script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.replace("editor1");
        CKEDITOR.replace("editor2");
        CKEDITOR.replace("editor3");
        CKEDITOR.replace("editor4");
        CKEDITOR.config.filebrowserUploadUrl = '<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/publisher/form.blade.php ENDPATH**/ ?>