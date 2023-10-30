<?php $__env->startSection('title',__('Profile.subscriptions')); ?>

<?php
    $lang=App::getLocale();
    $name='name_'.$lang;
?>
<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="/css/bootstrap_select/bootstrap-select.min.css">
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/filter.css?v=33">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
<!-- CSS only -->
    <style>
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="subscription-main">
                <h2 class="subscription-title"><?php echo app('translator')->get('subscription.choose'); ?></h2>
                <div class="subsription-slider">
                    <div class="swiper subscrSwiper">
                        <div class="swiper-subscr-btns">
                            <div class="swiper-subscr-left-btn">
                                <div class="swiper-subscr-button-prev">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 0C8.50659 0 0 8.50659 0 19C0 29.4934 8.50659 38 19 38C29.4934 38 38 29.4934 38 19C38 8.50659 29.4934 0 19 0ZM21.2929 12.2929L14.5858 19L21.2929 25.7071L22.7071 24.2929L17.4142 19L22.7071 13.7071L21.2929 12.2929Z" fill="#E5E5E5"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="swiper-subscr-right-btn">
                                <div class="swiper-subscr-button-next">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 0C29.4934 0 38 8.50659 38 19C38 29.4934 29.4934 38 19 38C8.50659 38 0 29.4934 0 19C0 8.50659 8.50659 0 19 0ZM16.7071 12.2929L23.4142 19L16.7071 25.7071L15.2929 24.2929L20.5858 19L15.2929 13.7071L16.7071 12.2929Z" fill="#E5E5E5"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = \App\Models\Subscription::orderBy('sort_num')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <div class="slider-title">
                                        <h2 class="subscr-title"><?php echo e($subscription["title_$lang"]); ?></h2>
                                    </div>
                                    <div class="slider-center">
                                        <div class="subscr-content">
                                            <h3 class="subscr-price"><?php echo e($subscription->price); ?> ₸/ <?php echo e($subscription["name_$lang"]); ?></h3>
                                            <div class="subscr-center">
                                                <ul class="subscr-list">
                                                    <?php $__currentLoopData = \App\Models\SubscriptionInformation::orderBy('sort')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(array_key_exists($value->id, json_decode($subscription["description"],true))): ?>
                                                            <li <?php if(json_decode($subscription["description"],true)[$value->id]): ?> class="subscr-li-done" <?php else: ?> class="subscr-li-error" <?php endif; ?>><span><?php echo e($value["title_$lang"]); ?></span></li>
                                                        <?php else: ?>
                                                            <li  class="subscr-li-error"><span><?php echo e($value["title_$lang"]); ?></span></li>
                                                            <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <form action="\buy-subscription" method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="subscription_id" value="<?php echo e($subscription->id); ?>">
                                        <button type="submit" class="subscr-btn"><?php echo app('translator')->get('subscription.buy'); ?></button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>

                </div>

                <section class="faq" id="faq">
                    <div class="container">
                        <h1 class="section__title"><?php echo app('translator')->get('subscription.faq'); ?></h1>
                        <div class="section__content">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">

                                <?php $__currentLoopData = \App\Models\SubscriptionFaq::orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="panel-acc1 panel panel-default">
                                        <div class="panel-acc-heading1 panel-heading" role="tab" id="heading<?php echo e($key); ?>">
                                            <h4 class="panel-acc-title1 panel-title">
                                                <a class="panel-acc-btn1 collapsed" role="button" data-toggle="collapse" href="#collapse<?php echo e($key); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($key); ?>">
                                                    <?php echo e($faq->content['title_'.$lang]); ?>

                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse<?php echo e($key); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo e($key); ?>">
                                            <div class="panel-acc-body1 panel-body">
                                                <?php echo $faq->content['content_'.$lang]; ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<!-- JavaScript Bundle with Popper -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="/js/plugins/jquery/3.5/jquery-3.5.1.min.js"></script>
    <script src="/js/bootstrap_select/bootstrap-select.min.js"></script>
    <script src="/js/jquery.toast.min.js"></script>

    <script>
        $(function () {
            $('.selectpicker').selectpicker();
        });

       /* function buy_subscription(subscription_id){
            alert('df');
            var newForm = $('<form>', {
                    'action': 'buy-subscription',
                    'method': 'post'
                });
            newForm.append($('<input>', {
                    'name': 'subscription_id',
                    'value': subscription_id,
                    'type': 'number'
                }));
            newForm.append($('<input>', {
                'name': '_token',
                'value': '<?php echo e(csrf_token()); ?>'
            }));
            $(document.body).append(newForm);
            console.log(newForm);
                newForm.submit();
        }*/

        //выводит уведомление
        function callToast(heading ,text){
            $.toast({
                heading: heading,
                text: text,
                bgColor: '#8E2976',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'bottom-left'
            })
        }
        //Выводит alert
        function swalAlert(title ,html){
            Swal.fire({
                title: title,
                icon: 'info',
                html: html,
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

        function buy(type, bookid) {
            console.log(type);
            $.ajax({
                method: "POST",
                url: "/addToBasket",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    type: type,
                    book_id: bookid,
                }
            }).done(function (msg) {
                if (msg.success) {
                    let count = parseInt($('#shoppingcart_count').text()) + 1;
                    $("#shoppingcart_count").html(count);
                    callToast('<?php echo e(__('status.success')); ?>','<?php echo e(__('book.buysuccesstext')); ?>');
                }
                else {
                    swalAlert('<?php echo app('translator')->get('book.buyerrortitle'); ?>','<?php echo app('translator')->get('book.buyerror'); ?>');
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
                    callToast('<?php echo e(__('status.success')); ?>',text);
                } else {
                    swalAlert('<?php echo app('translator')->get('book.buyerrortitle'); ?>','<?php echo app('translator')->get('book.buyerror'); ?>');
                }
            });
        }
</script>
<script>
    var subscrSwiper = new Swiper(".subscrSwiper", {
        spaceBetween: 30,
        // autoplay: {
        //     delay: 2500,
        //     disableOnInteraction: false,
        // },
        breakpoints: {
            1024: {
                slidesPerView: 4,
            },
            600: {
                slidesPerView: 2,
            }
        },
        navigation: {
            nextEl: ".swiper-subscr-button-next",
            prevEl: ".swiper-subscr-button-prev",
        },
        loop: 0,
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/subscription/index.blade.php ENDPATH**/ ?>