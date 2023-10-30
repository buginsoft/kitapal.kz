<?php $__env->startSection('form_title',$title); ?>
<?php $__env->startSection('breadcrumb',$title); ?>

<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/genre" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
    <form  action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
        <input name="showonheader" type="hidden"  value="0">
        <?php if(!empty($genre)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>
        <?php echo csrf_field(); ?>
        <div class="widget-content widget-content-area simple-pills">
            <div class="form-group">
                <label>Название(ru)</label>
                <input type="text" class="form-control" name="genre_name_ru" value="<?php echo e(!empty($genre) ? $genre->genre_name_ru : old('genre_name_ru')); ?>" />
            </div>
            <div class="form-group">
                <label>Название(kz)</label>
                <input type="text" class="form-control" name="genre_name_kz" value="<?php echo e(!empty($genre) ? $genre->genre_name_kz : old('genre_name_kz')); ?>" />
            </div>
            <div class="form-group">
                <label class="new-control new-checkbox checkbox-primary">
                    <input name="showonheader" type="checkbox" class="new-control-input" value="1"  <?php if(!empty($genre) && ($genre->showonheader)): ?> checked <?php endif; ?>>
                    <span class="new-control-indicator"></span>Показать в шапке
                </label>
            </div>
            <div class="form-group">
                <label>Сортировка</label>
                <input type="number" class="form-control" name="sort_num"
                       value="<?php echo e(!empty($genre) ? $genre->sort_num : old('sort_num')); ?>" />
            </div>
            <?php echo $__env->make('admin.includes.fileupload', ['name' => 'genre_image'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-lg-8 col-md-12 text-right">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_js'); ?>
    <script>
        let upload_file_poster = new FileUploadWithPreview('myFirstImage');
        <?php if(!empty($genre)): ?>
        $(".custom-file-container__image-preview").css("background-image", "url(<?php echo e($genre->genre_image); ?>)");
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/genre/form.blade.php ENDPATH**/ ?>