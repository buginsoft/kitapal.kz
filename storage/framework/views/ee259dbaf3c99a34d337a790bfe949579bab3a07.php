

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb','Меню'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-wrapper" style="min-height: 319px;">
    <?php echo Menu::render(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php echo Menu::scripts(); ?>

    <script>
        $("#menu-item-url-wrap").append( '<p>' +
            '<label class="howto" >'+
            '<span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp'+
            '<select id="pageid" class="menu-item-textbox "><option  value="nothing" selected="selected">Выберите страницу</option><?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="page/<?php echo e($page->id); ?>"><?php echo e($page->page_name_ru); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>'+
            '</label></p>');

        let selectmenu=document.getElementById("pageid");
        selectmenu.onchange=function(){
            var value=$("#pageid").val();
            var url='<?php echo e(url("/")); ?>';
            $("#custom-menu-item-url").val(url+'/'+value);
        };
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/menu/index.blade.php ENDPATH**/ ?>