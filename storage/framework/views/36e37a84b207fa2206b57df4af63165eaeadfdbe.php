<?php $__env->startSection('add_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/promocodes/create" class="btn btn-success">Добавить</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('table_title','Промокоды'); ?>
<?php $__env->startSection('breadcrumb','Промокоды'); ?>

<?php $__env->startSection('table'); ?>
    <table class="table table-bordered mb-4">
        <thead>
        <tr>
            <th style="width: 30px">Название</th>
            <th>Код</th>
            <th>Процент</th>
            <th>Многоразовое</th>
            <th>Количество</th>
            <th>Статус</th>
            <th>Использовано</th>
            <th>Истечет</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $promos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($value->title); ?></td>
                <td><?php echo e($value->code); ?></td>
                <td><?php echo e($value->percentage); ?></td>
                <td><?php echo e($value->reuseable?'Да':'Нет'); ?></td>
                <td><?php echo e($value->quantity); ?></td>
                <td><?php echo e($value->status?'Активно':'Неактивно'); ?></td>
                <td><?php echo e($value->used_quantity()); ?></td>
                <td><?php echo e($value->expire); ?></td>
                <td>
                    <a href="/admin/promocodes/<?php echo e($value->id); ?>/edit">Изменить</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/promo/index.blade.php ENDPATH**/ ?>