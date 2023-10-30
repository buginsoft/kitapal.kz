<?php $__env->startSection('table_title','Пользователи'); ?>
<?php $__env->startSection('breadcrumb','Пользователи'); ?>
<?php $__env->startSection('add_button'); ?>
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/users/create" class="btn btn-success">Добавить</a>
    </div>
    <div class="col-3 text-right">

        <form  action="/admin/export/users"  method="get"  style="display:flex;">
            <select name="range" class="form-control" style="max-width: 150px;display:flex;">
                <?php for($i=0; $i<\App\Models\User::count(); $i=$i+15000): ?>
                    <?php if($i==0): ?>
                        <option value="15000">0-15000</option>
                    <?php else: ?>
                        <option value="<?php echo e($i+15000); ?>"><?php echo e($i); ?>-<?php echo e($i+15000); ?></option>
                    <?php endif; ?>
                <?php endfor; ?>
            </select>
            <button  type="submit" class="btn btn-primary">Экспорт</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('table'); ?>
    <?php echo $__env->make('admin.includes.search',['base_url'=>'/admin/users'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th>Фото</th>
            <th>Логин</th>
            <th>Телефон</th>
            <th>Эл книги пользователя</th>
            <th>Добавить подписку</th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($value->user_id); ?></td>
                <td><?php echo e($value->user_name); ?></td>
                <td><?php echo e($value->email); ?></td>
                <td><?php echo e($value->phone); ?></td>
                <td><a href="/admin/userEbooks?user_id=<?php echo e($value->user_id); ?>">Посмотреть</a></td>
                <td>

                    <?php if(is_null($value->subscription)): ?>
                        <form action="/buy-subscription" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="manually" value="1">
                            <input type="hidden" name="to_user" value="<?php echo e($value->user_id); ?>">
                            <select name="subscription_id">
                                <?php $__currentLoopData = \App\Models\Subscription::orderBy('sort_num')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subscription->id); ?>"><?php echo e($subscription->name_ru); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <button type="submit">Добавить</button>
                        </form>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="remove(this,'<?php echo e($value->user_id); ?>','users')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </td>
                <td>
                    <a href="/admin/users/<?php echo e($value->user_id); ?>/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($users->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/users/users.blade.php ENDPATH**/ ?>