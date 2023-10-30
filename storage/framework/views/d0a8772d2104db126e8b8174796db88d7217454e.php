<?php $__env->startSection('breadcrumb',$title); ?>
<?php $__env->startSection('form_title' ,$title); ?>
<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/subscription" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form'); ?>
    <form  action="/admin/subscription/<?php echo e($subscription->id); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <?php $__currentLoopData = \App\Models\SubscriptionInformation::orderBy('sort')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$information): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="n-chk">
                <label class="new-control new-checkbox checkbox-primary">
                    <input type="checkbox" class="new-control-input" name="information[<?php echo e($information->id); ?>]" value="1"   <?php if(array_key_exists($information->id, json_decode($subscription["description"],true))): ?> <?php if(json_decode($subscription["description"],true)[$information->id]): ?> checked <?php endif; ?>  <?php endif; ?>>
                    <span class="new-control-indicator"></span><?php echo e($information->title_ru); ?>

                </label>






                    <div class="form-group">
                        <label>Card_colour:</label>
                        <input type="color" class="form-control" name="card_colour" value="#ECF9FF"/>
                    </div>

                    <div class="form-group">
                        <label>Button colour:</label>
                        <input type="color" class="form-control" name="button_colour" value="#ECF9FF"/>
                    </div>

                <?php echo $__env->make('admin.includes.fileupload', ['name' => 'post_image'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="col-lg-8 col-md-12 text-right">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_level_js'); ?>
    <!--Page level js-->
    <script>
        let upload_file_poster = new FileUploadWithPreview('myFirstImage');
        <?php if(!empty($information)): ?>
        $(".custom-file-container__image-preview").css("background-image", "url(<?php echo e($subscription->post_image); ?>)");
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/subscription/form.blade.php ENDPATH**/ ?>