<?php $__env->startSection('form_title','Добавить пользователя'); ?>
<?php $__env->startSection('breadcrumb','Добавить пользователя'); ?>

<?php $__env->startSection('previews_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/users" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('form'); ?>
    <?php if(empty($user)): ?>
        <form  action="/admin/users" method="POST" enctype="multipart/form-data">
            <?php else: ?>
                <form action="/admin/users/<?php echo e($user->user_id); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo method_field('PUT'); ?>
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>
                    <div class="widget-content widget-content-area simple-pills">
                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text" class="form-control" name="user_name" value="<?php echo e((!empty($user)) ? $user->user_name : old('user_name')); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo e((!empty($user)) ? $user->email : old('email')); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="tel" class="form-control" name="phone" id="phone" value="<?php echo e((!empty($user)) ? $user->phone : old('phone')); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Дата рождения</label>
                            <input type="date" class="form-control" name="date_of_birth" max="2999-12-31" value="<?php echo e((!empty($user)) ? $user->date_of_birth : old('date_of_birth')); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" class="form-control" name="password"/>
                        </div>

                        <?php echo $__env->make('admin.includes.fileupload', ['name' => 'avatar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                    <div class="col-lg-8 col-md-12 text-right">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
                <?php $__env->stopSection(); ?>

            <?php $__env->startSection('page_level_js'); ?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#phone').mask('8 (000) 000-00-00');
                    });

                    let upload_file_poster = new FileUploadWithPreview('myFirstImage');
                    <?php if(!empty($user)): ?>
                    $(".custom-file-container__image-preview").css("background-image", "url(<?php echo e($user->avatar); ?>)");
                    <?php endif; ?>

                </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/users/users-edit.blade.php ENDPATH**/ ?>