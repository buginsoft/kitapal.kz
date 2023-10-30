<?php $__env->startSection('form_title','Добавить'); ?>
<?php $__env->startSection('breadcrumb','Добавить промокод'); ?>

<?php $__env->startSection('preview_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/promocodes" class="btn btn-danger">Назад</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('form'); ?>
    <form  action="<?php echo e($action); ?>" method="POST" >
        <?php echo csrf_field(); ?>
        <?php if(isset($promocodes)): ?>
            <?php echo method_field('put'); ?>
            <?php endif; ?>
        <div class="widget-content widget-content-area simple-pills">
            <div class="form-group">
                <label>Название</label>
                <input type="text" class="form-control" name="title" value="<?php echo e(isset($promocodes)?$promocodes->title:''); ?>" />
            </div>
            <div class="form-group">
                <label>Код</label>
                <input type="text" class="form-control" name="code" value="<?php echo e(isset($promocodes)?$promocodes->code:''); ?>" />
            </div>
            <button class="btn btn-success generate" >Генерировать</button>
            <div class="form-group">
                <label>Процент</label>
                <input type="number" class="form-control" name="percentage" value="<?php echo e(isset($promocodes)?$promocodes->percentage:''); ?>" />
            </div>
            <div class="form-group">
                <label>Время истечения</label>
                <input type="date" class="form-control" name="expire" value="<?php echo e(isset($promocodes)?$promocodes->expire:''); ?>" />
            </div>


            <?php if(isset($promocodes)): ?>
                <?php if($promocodes->reuseable): ?>
                    <div class="form-group">

                        <input style="position:unset;left:unset;opacity:unset;" type="checkbox"  name="reuseable" value="1" checked>
                        <label for="is_show_yes">Многоразовое</label>

                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <input style="position:unset;left:unset;opacity:unset;" type="checkbox"  name="reuseable" value="1">
                        <label for="is_show_yes">Многоразовое</label>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="form-group">
                    <input style="position:unset;left:unset;opacity:unset;" type="checkbox"  name="reuseable" value="1" checked>
                    <label for="is_show_yes">Многоразовое</label>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label>Количество</label>
                <input type="number" class="form-control" name="quantity" value="<?php echo e(isset($promocodes)?$promocodes->quantity:'1'); ?>" />
            </div>
            <?php if(isset($promocodes)): ?>
                <?php if($promocodes->status): ?>
                    <div class="form-group">
                        <input style="position:unset;left:unset;opacity:unset;" type="checkbox" name="status" value="1" checked>
                        <label  for="is_show_yes">Активный</label>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <input style="position:unset;left:unset;opacity:unset;" type="checkbox" name="status" value="1">
                        <label  for="is_show_yes">Активный</label>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="form-group">
                    <input style="position:unset;left:unset;opacity:unset;" type="checkbox" name="status" value="1" checked>
                    <label  for="is_show_yes">Активный</label>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-8 col-md-12 text-right">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(".generate").on("click", function(e) {
            var len = 10;
            generateCode(len);
            return false;
        });
        function generateCode(length) {
            $.ajax({
                method: "POST",
                url: "/admin/generate-promocode",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    length: length,
                }
            }).done(function (msg) {
                $("input[name='code']").val(msg.code);
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/promo/create.blade.php ENDPATH**/ ?>