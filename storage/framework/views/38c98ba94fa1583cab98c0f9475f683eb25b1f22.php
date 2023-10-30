<?php $__env->startSection('table_title','Подборка'); ?>
<?php $__env->startSection('breadcrumb','Подборка'); ?>

<?php $__env->startSection('add_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/collection/create" class="btn btn-success">Добавить</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('table'); ?>

    <table class="table table-bordered mb-4">
        <thead>
        <tr>
            <th style="width: 30px">№</th>
            <th>Название(ru)</th>
            <th>Название(kz)</th>
            <th>Место</th>
            <th>Иконка</th>
            <th>Цвет</th>
            <th>Показать значок</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($value->collection_id); ?></td>
                <td><?php echo e($value->collection_name_ru); ?></td>
                <td><?php echo e($value->collection_name_kz); ?></td>
                <td><?php echo e($value->sort_num); ?></td>
                <td><img  style="width:90px;height:90px" src="<?php echo e($value->icon); ?>"></td>
                <td><?php echo e($value->color); ?></td>
                <td><?php if($value->show_badge ): ?>Да <?php else: ?> Нет <?php endif; ?></td>
                <td>
                   <?php echo $__env->make('includes.delete_form',['action'=>"/admin/collection/$value->collection_id"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </td>
                <td>
                    <a href="/admin/collection/<?php echo e($value->collection_id); ?>/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/collection.blade.php ENDPATH**/ ?>