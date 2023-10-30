<?php
    $lang=app()->getLocale();
    $name = 'name_'.$lang;
?>
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('words.search_result_header'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/main.css?v=24">
    <style>
        @media (max-width: 1200px) {
            .slide-main-books .item-bag.search {
                right: 19%;
            }

            .slide-main-books .item-bag.text.search {
                top: 4%;
                right: 32%;
                padding: 0px 3px;
            }

        }

        @media (max-width: 767px) {
            span.item-bag {
                left: 9%;
            }

            .slide-main-books .item-bag.search {
                right: 18%;
            }

            .slide-main-books .item-bag.text.search {
                right: 31%;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="section-row">
                <?php if(empty($search_word)): ?>
                <?php else: ?>
                    <h1 class="big-title"><?php echo app('translator')->get('words.search_result_header'); ?>: <?php echo e($search_word); ?></h1>
                <?php endif; ?>
                <div class="row catalog">
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <div class="slide-main-books" style="width: 180px;position:relative;">
                                <a href="/book/<?php echo e($item->book_url); ?>">
                                    <div class="item-books">
                                        <div class="img-book">
                                            <img src="<?php echo e($item->main_image()?$item->main_image()->path:''); ?>">
                                            <div class="opacity-img"></div>
                                        </div>
                                        <?php if($item->paperbook_price): ?>
                                            <span><?php echo e($item->paperbook_price*((100-$item->sale_percentage)/100)); ?> тг</span>
                                        <span class="old-price" style="z-index: 999;"><?php echo e($item->paperbook_price); ?> ₸</span>
                                        <?php endif; ?>
                                        <p class="text-grey fs-15">
                                            <?php $__currentLoopData = $item->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key==count($item->authors)-1): ?>
                                                    <?php echo e($author->$name); ?>

                                                <?php else: ?>
                                                    <?php echo e($author->$name); ?>,
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </p>
                                        <p><?php echo e($item->book_name); ?></p>
                                        <?php if($item->subscribable): ?>
                                        <h4 class="text-pro-purple">Подписка</h4>
                                        <?php else: ?>
                                        <h4 class="text-pro-green">Покупка</h4>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                <?php if($item->available): ?>
                                    <span onclick="buy('paper',<?php echo e($item->book_id); ?>)" class="item-bag">+ Добавить в корзину</span>
                                <?php endif; ?>
                                <span class="item-bag chosen search" onclick="addToSelected(<?php echo e($item->book_id); ?>)">
                                                <i id="heart<?php echo e($item->book_id); ?>"
                                                   class="<?php if(\Auth::user() && \App\Models\UserSelected::where([['user_id',\Auth::user()->user_id],['book_id',$item->book_id]])->first()): ?>selected <?php endif; ?> fas fa-heart"></i>
                                            </span>
                                <span class="item-bag text search">
                                                 <p>Добавить в избранное</p>
                                            </span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <nav>
                    <?php echo e($books->appends(request()->input())->links('vendor.pagination.custom')); ?>

                </nav>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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
                        position: 'bottom-left'
                    })
                } else {
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

        function addToSelected(bookid) {
            $.ajax({
                method: "POST",
                url: "/selected",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    book_id: bookid,
                }
            }).done(function (msg) {
                if (msg.status === 'true') {
                    if (msg.action === 'add') {
                        $("#heart" + bookid).addClass('selected');
                        text = 'Успешно добавлен';
                    } else {
                        $("#heart" + bookid).removeClass('selected');
                        text = 'Успешно удален';

                    }
                    $.toast({
                        heading: '<?php echo e(__('status.success')); ?>',
                        text: text,
                        bgColor: '#8E2976',
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                } else {
                    Swal.fire({
                        title: '<?php echo app('translator')->get('book.buyerrortitle'); ?>',
                        icon: 'info',
                        html: '<?php echo app('translator')->get('book.buyerror'); ?>',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> <?php echo app('translator')->get('basket.button'); ?>!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText: '<i class="fa fa-thumbs-down"></i><?php echo app('translator')->get('book.continue'); ?>',
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/searchresult.blade.php ENDPATH**/ ?>