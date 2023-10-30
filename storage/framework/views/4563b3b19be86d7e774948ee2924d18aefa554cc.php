<?php
    $lang=App::getLocale();
    $title = 'title_'.$lang;
    $short_text = 'short_text_'.$lang;
?>

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('title.articles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title"></h1>
                <div class="row catalog">
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-sm-6">
                            <a href="/article/<?php echo e($article->id); ?>">
                                <div class="item-article">
                                    <img src="<?php echo e($article->image); ?>">
                                    <div class="text-article">
                                        <p><?php echo e($article->$title); ?></p>
                                        <p class="fs-15 text-grey"><?php echo $article->$short_text; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <nav>
                    <?php echo e($articles->links('vendor.pagination.custom')); ?>

                </nav>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/articles.blade.php ENDPATH**/ ?>