<?php $__env->startSection('form_title','Добавить содержание'); ?>
<?php $__env->startSection('breadcrumb','Добавить содержание'); ?>

<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/chapter" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form'); ?>
    <?php if(empty($chapter)): ?>
        <form class="col-lg-12 col-md-12 row" action="/admin/chapter" method="POST">
            <?php else: ?>
                <form class="col-lg-12 col-md-12 row" action="/admin/chapter/<?php echo e($chapter->chapter_id); ?>" method="POST">
                    <?php echo method_field('PUT'); ?>
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>

                    <div class="widget-content widget-content-area simple-pills">
                        <div class="form-group">
                            <label>К книге</label>
                            <select name="ch_book_id" class="form-control">
                                <?php echo $__env->make('admin.layouts.book', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" class="form-control" name="chapter_name"
                                   value="<?php echo e(!empty($chapter) ? $chapter->chapter_name : old('chapter_name')); ?>" />
                        </div>
                        <div class="form-group">
                            <label>Время</label>
                            <input id="time" type="text" class="form-control"  name="chapter_time"
                                   value="<?php echo e(!empty($chapter) ? $chapter->chapter_time : old('chapter_time')); ?>" />
                        </div>
                        <div class="form-group">
                            <label>Сортировка</label>
                            <input type="number" class="form-control" name="sort_num"
                                   value="<?php echo e(!empty($chapter) ? $chapter->sort_num : old('sort_num')); ?>" />
                        </div>

                        <div class="col-lg-8 col-md-12 text-right">
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_level_js'); ?>
                    <script src="/js/masking-input.js"></script>
    <script>
        var selector = document.getElementById("time");

        var im = new Inputmask("99:99:99");
        im.mask(selector);
    </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/chapter/chapter-edit.blade.php ENDPATH**/ ?>