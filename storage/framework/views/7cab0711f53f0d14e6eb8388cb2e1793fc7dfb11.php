
<?php
    $content = 'page_content_'.app()->getLocale();
    $name = 'page_name_'.app()->getLocale();
?>
<?php $__env->startSection('title'); ?>
    <?php echo e($page->$name); ?>

<?php $__env->stopSection(); ?>
<style>
    .crumbs__container.page{
        margin: 0px 0px 20px 0px;
    }
    .crumbs__container.page .crumbs__box a,
    .crumbs__container.page .crumbs__box p {
        margin: 0px 10px 0px 0px;
    }
    .crumbs__container.page .crumbs__box a:hover{
        color: #72215e;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="section-row">
                <div class="crumbs__container page">
                    <div class="crumbs__box d-flex aling-items-center">
                        <a href="/">Главная</a>
                        <p> > </p> <?php echo e($page->$name); ?>

                    </div>
                </div>

                <?php echo $page->$content; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/page.blade.php ENDPATH**/ ?>