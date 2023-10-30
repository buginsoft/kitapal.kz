<?php $__env->startSection('table_title','Сообщений'); ?>
<?php $__env->startSection('breadcrumb','Сообщений'); ?>
<?php $__env->startSection('table'); ?>
    <table id="showed" class="table table-bordered table-striped">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th>Email</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Проблема</th>
            <th>Дата подачи</th>
            <th>Удалить</th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $problem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($value->problem_id); ?></td>
                <td><?php echo e($value->email); ?></td>
                <td><?php echo e($value->name); ?></td>
                <td><?php echo e($value->phone); ?></td>
                <td><?php echo e($value->problem_text); ?></td>
                <td><?php echo e($value->created_at); ?></td>
                <td>
                    <a href="javascript:void(0)"
                       onclick="remove(this,'<?php echo e($value->problem_id); ?>','user_problem')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($problem->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/problem.blade.php ENDPATH**/ ?>