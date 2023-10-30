<?php $__env->startSection('form_title','Изменить подборку'); ?>
<?php $__env->startSection('breadcrumb','Изменить подборку'); ?>

<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/collection" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
    <?php if(empty($collection)): ?>
        <form action="/admin/collection" method="POST" enctype="multipart/form-data">
            <?php else: ?>
                <form  action="/admin/collection/<?php echo e($collection->collection_id); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo method_field('PUT'); ?>
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>

                    <div class="widget-content widget-content-area simple-pills">

                        <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-russian-tab" data-toggle="pill" href="#pills-russian" role="tab" aria-controls="pills-russian" aria-selected="true">Русский</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-kz-tab" data-toggle="pill" href="#pills-kz" role="tab" aria-controls="pills-kz" aria-selected="false">Казахский</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-russian" role="tabpanel" aria-labelledby="pills-russian-tab">

                                <div class="form-group">
                                    <label>Название</label>
                                    <input type="text" class="form-control" name="collection_name_ru"
                                           value="<?php echo e(!empty($collection) ? $collection->collection_name_ru : old('collection_name_ru')); ?>" />
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-kz" role="tabpanel" aria-labelledby="pills-kz-tab">
                                <div class="form-group">
                                    <label>Название</label>
                                    <input type="text" class="form-control" name="collection_name_kz"
                                           value="<?php echo e(!empty($collection) ? $collection->collection_name_kz : old('collection_name_kz')); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Место</label>
                            <input type="text" class="form-control" name="sort_num"
                                   value="<?php echo e(!empty($collection) ? $collection->sort_num : old('sort_num')); ?>" />
                        </div>
                        <div class="form-group">
                            <label>Цвет</label>
                            <input type="text" class="form-control" name="color"
                                   value="<?php echo e(!empty($collection) ? $collection->color : old('color')); ?>" required/>
                        </div>
                        <div class="form-group">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input name="show_badge" type="checkbox" class="new-control-input"  <?php if(!empty($collection) && ($collection->show_badge)): ?> checked <?php endif; ?> value="1">
                                <span class="new-control-indicator"></span>Показать значок
                            </label>
                        </div>


                        <?php echo $__env->make('admin.includes.fileupload', ['name' => 'book_image'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>

                    <div class="col-lg-8 col-md-12 text-right">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
                <?php $__env->stopSection(); ?>

            <?php $__env->startSection('page_level_js'); ?>
                <script>
                    let upload_file_poster = new FileUploadWithPreview('myFirstImage');
                    <?php if(!empty($collection)): ?>
                    $(".custom-file-container__image-preview").css({
                        "background-image": "url(<?php echo e('https://kitapal.kz'.$collection->icon); ?>)"
                    });
                    <?php endif; ?>
                </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/collection/edit.blade.php ENDPATH**/ ?>