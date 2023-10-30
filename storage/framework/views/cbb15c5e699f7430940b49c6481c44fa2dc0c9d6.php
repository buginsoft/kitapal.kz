<?php $__env->startSection('table_title','Подписки FAQ'); ?>
<?php $__env->startSection('breadcrumb','Подписки FAQ'); ?>

<?php $__env->startSection('table'); ?>
    <a class="btn btn-primary mb-2" href="/admin/subscription-faq/create">Добавить</a>
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th>Название</th>
            <th>Порядок</th>
            <th>Изменить</th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($value->name); ?></td>
                <td><?php echo e($value->order); ?></td>
                <td class="d-flex">
                    <a  class="btn btn-primary" href="/admin/subscription-faq/<?php echo e($value->id); ?>/edit">Изменить</a>
                    <form action="/admin/subscription-faq/<?php echo e($value->id); ?>" method="post">
                        <?php echo method_field('delete'); ?>
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/subscription/faq/index.blade.php ENDPATH**/ ?>