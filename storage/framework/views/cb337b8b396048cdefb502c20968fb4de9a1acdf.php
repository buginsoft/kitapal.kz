

<?php $__env->startSection('table_title','Подписки'); ?>
<?php $__env->startSection('breadcrumb','Подписки'); ?>

<?php $__env->startSection('table'); ?>
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th>Название ру</th>
            <th>Название кз</th>
            <th>Продолжительность ру</th>
            <th>Продолжительность кз</th>
            <th>Цена</th>
            <th>Изменить описание</th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <form id="title_ru" action="/admin/subscription/<?php echo e($value->id); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <input class="form-control" name="title_ru" type="text" value="<?php echo e($value->title_ru); ?>" onkeyup="$('#title_ru').submit();">
                    </form>
                </td>
                <td>
                    <form id="title_kz" action="/admin/subscription/<?php echo e($value->id); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <input class="form-control" name="title_kz" type="text" value="<?php echo e($value->title_kz); ?>" onkeyup="$('#title_kz').submit();">
                    </form>
                </td>
                <td><?php echo e($value->name_ru); ?></td>
                <td><?php echo e($value->name_kz); ?></td>
                <td>
                    <form  action="/admin/subscription/<?php echo e($value->id); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <input class="form-control" name="price" type="number" value="<?php echo e($value->price); ?>">
                        <input type="submit" value="Изменить">
                    </form>
                </td>
                <td>
                    <a  class="btn btn-primary" href="/admin/subscription/<?php echo e($value->id); ?>/edit">Изменить</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/subscription/index.blade.php ENDPATH**/ ?>