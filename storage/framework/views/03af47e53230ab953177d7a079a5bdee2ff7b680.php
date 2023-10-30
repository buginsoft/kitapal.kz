<?php
    use App\Http\Helpers;
    $lang=App::getLocale();
    $text = 'text_'.$lang;
    $title = 'title_'.$lang;
?>


<?php $__env->startSection('title'); ?>
    <?php echo e($article->$title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row section-row">
                <div class="col-md-8">
                    <h1 class="big-title mb-25"><?php echo e($article->$title); ?></h1>
                    <div class="top-tags">
                        <span class="text-uppercase">
                            <i class="icons ic-calendar"></i>
                            <?php echo e($article->created_at->format('d')); ?>

                            <?php echo e(Helpers::getMonthName($article->created_at->format('n') )); ?>

                            <?php echo e($article->created_at->format('Y')); ?></span>
                    </div>
                    <div class="mt-40"><img class="img-100" src="<?php echo e($article->image); ?>"></div>
                    <div class="mt-40">
                        <?php echo $article->$text; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/singlearticle.blade.php ENDPATH**/ ?>