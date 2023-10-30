<?php
    $lang=App::getLocale();
    $name='name_'.App::getLocale();
    $description='description_'.$lang;
    $source='source_'.$lang;
?>
<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="/css/author_publish_style.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('main.title'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid author__box">
            <div class="container">
                <div class="row section-row">
                    <div class="col-lg-3">
                        <img src="<?php echo e($author->author_photo); ?>" alt="">
                        <div class="social d-flex">
                            <?php if($author->facebook): ?>
                                <a target="_blank" href="<?php echo e($author->facebook); ?>"><i class="fab fa-facebook-square"></i></a>
                            <?php endif; ?>
                            <?php if($author->instagram): ?>
                                <a target="_blank" href="<?php echo e($author->instagram); ?>"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>
                            <?php if($author->telegram): ?>
                                <a target="_blank" href="<?php echo e($author->telegram); ?>"><i class="fab fa-telegram-plane"></i></a>
                            <?php endif; ?>
                            <?php if($author->twitter): ?>
                                <a target="_blank" href="<?php echo e($author->twitter); ?>"><i class="fab fa-twitter-square"></i></a>
                            <?php endif; ?>
                            <?php if($author->vk): ?>
                                <a target="_blank" href="<?php echo e($author->vk); ?>"><i class="fab fa-vk"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h3 class="title"><?php echo e($author->$name); ?></h3>
                        <p class="text"><?php echo $author->$description; ?></p>
                        <p class="source">
                            <span>Дереккөзі:</span>
                            <?php echo e($author->$source); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section class="example__box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 example_cont">
                        <h2 class="book__title">
                            Шығармалар:
                        </h2>
                        <div class="book__cont d-flex">
                            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="book__box">
                                    <a target="_blank" href="/book/<?php echo e($book->book_url); ?>">
                                        <img src="<?php echo e($book->main_image()->path); ?>" alt="">
                                        <p><?php echo e($book->book_name); ?></p>
                                        <span>
                                            <?php $__currentLoopData = $book->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key==count($book->authors)-1): ?>
                                                    <?php echo e($author->$name); ?>

                                                <?php else: ?>
                                                    <?php echo e($author->$name); ?>,
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php echo e($books->links()); ?>

                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/author.blade.php ENDPATH**/ ?>