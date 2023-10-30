<?php $__env->startSection('table_title','Переводчик'); ?>
<?php $__env->startSection('breadcrumb','Переводчик'); ?>

<?php $__env->startSection('table'); ?>

    <form action="/admin/translator" method="POST" id="createForm">
        <?php echo csrf_field(); ?>
        <div class="form-group col-lg-4">
            <label>ФИО(kz)</label>
            <input type="text" class="form-control" name="name_kz" />
        </div>
        <div class="form-group col-lg-4">
            <label>ФИО(ru)</label>
            <input type="text" class="form-control" name="name_ru" />
        </div>
        <div class="form-group col-lg-4 m-b-0">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>


    <?php echo $__env->make('admin.includes.search',['base_url'=>'/admin/translator'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th>ФИО(kz)</th>
            <th>ФИО(ru)</th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $translator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($value->id); ?></td>
                <td><?php echo e($value->name_kz); ?></td>
                <td><?php echo e($value->name_ru); ?></td>
                <td>
                    <a href="javascript:void(0)"
                       onclick="remove(this,'<?php echo e($value->id); ?>','translator')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </td>
                <td><a href="/admin/translator/<?php echo e($value->id); ?>/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/translator/index.blade.php ENDPATH**/ ?>