<?php $__env->startSection('form_title' ,'Добавить страницу'); ?>
<?php $__env->startSection('breadcrumb' ,'Добавить страницу'); ?>

<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/pages" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
    <form  action="<?php echo e($action); ?>" method="POST" >
        <?php if($method=='PUT'): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
        <?php echo csrf_field(); ?>
        <div class="widget-content widget-content-area simple-pills">
            <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-russian-tab" data-toggle="pill"
                       href="#pills-russian" role="tab" aria-controls="pills-russian" aria-selected="true">Русский</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-kz-tab" data-toggle="pill" href="#pills-kz"
                       role="tab" aria-controls="pills-kz" aria-selected="false">Казахский</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-russian" role="tabpanel" aria-labelledby="pills-russian-tab">

                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" name="page_name_ru"
                               value="<?php echo e(!empty($page) ? $page->page_name_ru : old('page_name_ru')); ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea  id="editor1" class="form-control" name="page_content_ru">
                            <?php echo e(!empty($page) ? $page->page_content_ru : old('page_content_ru')); ?>

                        </textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-kz" role="tabpanel" aria-labelledby="pills-kz-tab">

                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" name="page_name_kz"
                               value="<?php echo e(!empty($page) ? $page->page_name_kz : old('page_name_kz')); ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea id="editor2" class="form-control" name="page_content_kz">
                            <?php echo e(!empty($page) ? $page->page_content_kz : old('page_content_kz')); ?>

                        </textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 text-right">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_level_js'); ?>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.replace("editor1");
        CKEDITOR.replace("editor2");
        CKEDITOR.config.filebrowserUploadUrl = '<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/pages/pages-edit.blade.php ENDPATH**/ ?>