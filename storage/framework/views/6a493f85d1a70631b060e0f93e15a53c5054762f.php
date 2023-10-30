<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title"><?php echo e($author->name); ?></h1>
                <div class="row catalog">
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <a href="/book/<?php echo e($item->book_id); ?>"><div class="item-books">
                                    <div class="img-book"><img src="<?php echo e($item->main_image()->path); ?>"></div>
                                    <p class="text-grey fs-15">
                                        <?php $__currentLoopData = $item->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key==count($item->authors)-1): ?>
                                                <?php echo e($author->name); ?>

                                            <?php else: ?>
                                                <?php echo e($author->name); ?>,
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </p>
                                    <p><?php echo e($item->book_name); ?></p>
                                </div>
                            </a>
                            <?php if($item->available): ?>
                                <span onclick="buy('paper',<?php echo e($item->book_id); ?>)" class="item-bag">+ Добавить в корзину</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <nav>
                    <?php echo e($books->links('vendor.pagination.custom')); ?>

                </nav>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="/js/jquery.toast.min.js"></script>
    <script>
        function buy(type, bookid) {
            $.ajax({
                method: "POST",
                url: "/addToBasket",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    type: type,
                    book_id: bookid,
                }
            }).done(function (msg) {
                if (msg.success == true) {

                    let count = parseInt($('#shoppingcart_count').text()) + 1;
                    $("#shoppingcart_count").html(count);
                    $.toast({
                        heading: '<?php echo e(__('status.success')); ?>',
                        text: '<?php echo e(__('book.buysuccesstext')); ?>',
                        bgColor: '#8E2976',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position : 'bottom-left'
                    })
                }
                else {
                    Swal.fire({
                        title: '<?php echo app('translator')->get('book.buyerrortitle'); ?>',
                        icon: 'info',
                        html: '<?php echo app('translator')->get('book.buyerror'); ?>',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> <?php echo app('translator')->get('basket.button'); ?>!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText:
                            '<i class="fa fa-thumbs-down"></i><?php echo app('translator')->get('book.continue'); ?>',
                        cancelButtonAriaLabel: 'Thumbs down'
                    }).then((result) => {
                        if (result.value) {
                            window.location = "https://kitapal.kz/login";
                        }
                    });

                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/authorbooks.blade.php ENDPATH**/ ?>