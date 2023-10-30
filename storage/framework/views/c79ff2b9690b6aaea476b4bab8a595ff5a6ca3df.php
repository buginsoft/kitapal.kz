<?php $__env->startSection('table_title','Цены'); ?>
<?php $__env->startSection('breadcrumb','Цены доставки'); ?>

<?php $__env->startSection('table'); ?>
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">Тип</th>
            <th>Описание</th>
            <th>Цена</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->type); ?></td>
                <td><?php echo e($item->description); ?></td>
                <td>
                    <input id="price<?php echo e($item->id); ?>" style="width:80px;"
                           class="form-control" value="<?php echo e($item->price); ?>">
                </td>
                <td>
                    <button id="id<?php echo e($item->id); ?>" class="btn btn-primary" onclick="savePriceBtn(this.id)">
                        Сохранить
                    </button>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function savePriceBtn(id){
            let price = $("#price"+id.substr(2)).val();
            $.ajax({
                type: "PUT",
                url: "/admin/delivery_price/"+id.substr(2),
                data: {
                    'price':price
                },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/deliveryprice/index.blade.php ENDPATH**/ ?>