<?php $__env->startSection('form_title',$title); ?>
<?php $__env->startSection('breadcrumb',$title); ?>

<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/slider" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2{
            width: 100% !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form'); ?>
    <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
        <?php if(!empty($slider)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>
        <?php echo csrf_field(); ?>
        <div class="widget-content widget-content-area simple-pills">




            <div class="form-group">
                <label>Тип</label>
                <select  class="form-control" name="slider_type">
                    <option value="upper">Верхний слайдер</option>
                    <option value="bottom">Нижний слайдер</option>
                </select>
            </div>

            <div class="form-group">
                <label>Тип</label>
                <select  class="form-control" name="type" required>
                    <option value="book" <?php echo e(!empty($slider) && $slider->type=='book' ? 'selected'  : ''); ?>>Книга</option>
                    <option value="catalog" <?php echo e(!empty($slider) && $slider->type=='catalog' ? 'selected'  : ''); ?>>Каталог</option>
                    <option value="collection" <?php echo e(!empty($slider) && $slider->type=='collection' ? 'selected'  : ''); ?>>Подборка</option>
                </select>
            </div>

            <div id="books_list" class="form-group">
                <label>Книги</label>
                <select id="ebook" class="js-example-basic-single" name="book_id" >
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option  value="<?php echo e($item->book_id); ?>" <?php echo e(!empty($slider) && $slider->book_id==$item->book_id ? 'selected'  : ''); ?>><?php echo e($item->book_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>


            <label>Каталоги</label>
            <select name="catalog_id" >
                <?php $__currentLoopData = \App\Models\Genre::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option  value="<?php echo e($genre->genre_id); ?>" <?php echo e(!empty($slider) && $slider->catalog_id==$genre->genre_id ? 'selected'  : ''); ?>>
                        <?php echo e($genre->genre_name_kz); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label>Подборки</label>
            <select name="collection_id" >
                <?php $__currentLoopData = \App\Models\Collection::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option  value="<?php echo e($collection->collection_id); ?>" <?php echo e(!empty($slider) && $slider->collection_id==$collection->collection_id ? 'selected'  : ''); ?>>
                        <?php echo e($collection->collection_name_ru); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>



            <div class="form-group">
                <label>Название слайда</label><i style="color:red" class="mdi mdi-asterisk"></i>
                <input type="text" class="form-control" name="slider_name" value="<?php echo e(!empty($slider) ? $slider->slider_name : old('slider_name')); ?>" />
                <?php $__errorArgs = ['slider_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <?php echo $__env->make('admin.includes.form_error',['message'=>$message], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label>Сортировка</label>
                <input type="number" class="form-control" name="sort_num"
                       value="<?php echo e(!empty($slider) ? $slider->sort_num : old('sort_num')); ?>" />
                <?php $__errorArgs = ['sort_num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <?php echo $__env->make('admin.includes.form_error',['message'=>$message], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>Для сайта
                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a>
                        </label>
                        <label class="custom-file-container__custom-file" >
                            <input name="slider_image" type="file"   class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div id="leftPhoto" class="custom-file-container__image-preview"></div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                    <div class="custom-file-container" data-upload-id="myFirstImage2">
                        <label>Для мобилки
                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a>
                        </label>
                        <label class="custom-file-container__custom-file" >
                            <input name="adaptive_image" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div id="rightPhoto" class="custom-file-container__image-preview"></div>
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
    <script>
        var upload_file_poster = new FileUploadWithPreview('myFirstImage');
        var upload_file_poster2 = new FileUploadWithPreview('myFirstImage2');
        <?php if(!empty($slider)): ?>

        $("#leftPhoto").css({
            "background-image": "url(<?php echo e('https://kitapal.kz'.$slider->slider_image); ?>)"
        })
        $("#rightPhoto").css({
            "background-image": "url(<?php echo e('https://kitapal.kz'.$slider->adaptive_image); ?>)"
        })
        <?php endif; ?>




        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/slider/form.blade.php ENDPATH**/ ?>