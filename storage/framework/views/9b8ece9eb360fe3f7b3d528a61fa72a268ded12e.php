

<?php $__env->startSection('table_title','Подписчики'); ?>
<?php $__env->startSection('breadcrumb','Подписчики'); ?>

<?php $__env->startSection('table'); ?>
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th>Логин</th>
            <th>Тип</th>
            <th>Статус</th>
            <th>Дата начало</th>
            <th>Дата окончания</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>
                <form action="" method="get">
                    <input type="text" name="user_name">
                    <button type="submit">Искать</button>
                </form>
            </td>
            <td></td>
            <td>
                <form action="" method="get"  id="filter-form">
                    <select name="type" id="type-select">
                        <option value="2" <?php if(request()->has('type') && request()->type==2): ?> selected <?php endif; ?>>Все</option>
                        <option value="1" <?php if(request()->has('type') && request()->type==1): ?> selected <?php endif; ?>>Активные</option>
                        <option value="0" <?php if(request()->has('type') && request()->type==0): ?> selected <?php endif; ?>>Неактивные</option>
                    </select>
                </form>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td title="<?php echo e($value->id); ?>"><?php echo e($value->user?$value->user->user_name:''); ?></td>
                <td><?php echo e($value->subscription->name_ru); ?></td>
                <td><?php echo e($value->active?'Активный':'Неактивный'); ?></td>
                <td><?php echo e($value->created_at); ?></td>
                <td><?php echo e($value->final_date); ?></td>
                <td>
                    <?php if($value->active): ?>
                        <form action="/admin/user_subscription/<?php echo e($value->id); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                            <select name="subscription_id" >
                                <?php $__currentLoopData = \App\Models\Subscription::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subscription->id); ?>"><?php echo e($subscription->title_kz); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <button type="submit">Изменить</button>
                        </form>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($value->active): ?>
                        <form action="/admin/user_subscription/<?php echo e($value->id); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <button type="submit">Удалить</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($list->appends(request()->input())->links()); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_level_js'); ?>
    <script>
        $(document).ready(function () {
            $('#type-select').on('change', function () {
                $('#filter-form').submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/subscription/subscripted.blade.php ENDPATH**/ ?>