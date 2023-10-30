<?php
    $count=0;
?>
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($item->attributes->type=='paper'): ?>
        <?php $count++; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('basket.checkoutheader'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="/css/promocode.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title"><?php echo app('translator')->get('basket.checkoutheader'); ?></h1>
                <div class="row">
                    <div class="col-md-7 input-prof">
                        <?php if(isset($errors) && $errors->has('price')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <li><?php echo e($errors->first('price')); ?></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form id="form" action="/checkout-delivery" method="post">
                            <input type="hidden" value="<?php echo e(\Cart::getTotal()); ?>" name="price">
                            <input type="hidden" value="<?php echo e($order->order_id); ?>" name="order_id">
                        <?php echo csrf_field(); ?>

                        <!-------------------------------Personal info-------------------------------------------->
                            <div class="mb-25">
                                <p class="mb-25 line-title"><b><?php echo app('translator')->get('basket.personalinfo'); ?></b></p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="formItem <?php if($errors->has('fio')): ?> errorBox <?php endif; ?>">
                                            <input class="form-control" type="text" placeholder="<?php echo app('translator')->get('Profile.fio'); ?>" name="fio" value="<?php echo e($user->user_name); ?>" required>
                                            <?php $__errorArgs = ['fio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <?php echo $__env->make('checkout.includes.error' ,['message'=>$message], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="email" placeholder="Email" value="<?php echo e($user->email); ?>" readonly="readonly">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="formItem <?php if($errors->has('phone')): ?> errorBox <?php endif; ?>">
                                            <input class="form-control" type="text" name="phone" placeholder="<?php echo app('translator')->get('Profile.phone'); ?>" value="<?php echo e($user->phone); ?>" required>
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <?php echo $__env->make('checkout.includes.error' ,['message'=>$message], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----------------------------------------------------------------------------------------->

                            <!---------------------------------Delivery methods select-------------------------------->
                            <?php if($count>0): ?>
                                <div class="mb-25">
                                    <p class="mb-25 line-title"><b><?php echo app('translator')->get('basket.deliverytitle'); ?></b></p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="container-radio"><?php echo app('translator')->get('basket.courier'); ?>
                                                <input type="radio"  id="courier" value="courier" checked="checked" name="delivery_type">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="container-radio"><?php echo app('translator')->get('basket.pickup'); ?>
                                                <input type="radio" id="samovivoz" value="pickup" name="delivery_type"><span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="container-radio"><?php echo app('translator')->get('basket.post'); ?>
                                                <input type="radio" id="post" value="post" name="delivery_type"><span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="fs-15 text-grey"><?php echo app('translator')->get('basket.info'); ?></p>
                                </div>
                                <textarea class="form-control" placeholder="<?php echo app('translator')->get('basket.comment'); ?>" name="order_comment" cols="20" rows="20"></textarea>
                        <?php endif; ?>
                        <!----------------------------------------------------------------------------------------->

                            <div class="mb-25">
                                <p class="fs-15 text-grey"><?php echo app('translator')->get('basket.errorinfo'); ?></p>
                            </div>
                            <span id="pickup_addres">
                                <?php echo \App\Models\Contact::first()['pickup_address_'.app()->getLocale()]; ?>

                            </span>
                            <div class="text-right hidden-xs">
                                <button id="sbmBtn1" class="btn btn-blue btn-lg" type="submit"> <?php echo app('translator')->get('basket.filladdress'); ?></button>
                            </div>
                    </div>
                    <!---------------------------------------Right sidebar--------------------------------------------->
                    <div class="col-md-offset-1 col-md-4">
                        <div class="border-right-b">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="right-block d-flex">
                                    <div><img src="<?php echo e(\App\Models\Book::find($item->attributes->book_id)->main_image()->path); ?>"></div>
                                    <div>
                                        <p>
                                            <b><?php echo e(\App\Models\Book::find($item->attributes->book_id)->book_name); ?></b>
                                            <span class="text-grey d-block">
                                                 <?php echo $__env->make('includes.bookauthors',['authors'=>\App\Models\Book::find($item->attributes->book_id)->authors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </span>
                                        </p>
                                        <p><?php echo e($item->quantity); ?> х <?php echo e($item->price); ?> ₸</p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            <div class="bottom-itog">
                                <div class="promocode__box d-flex">
                                    <div class="promocode__item">
                                        <input id="promo" class="form-control promo" type="text" name="promo" placeholder="Промокод(Не обязательно)">
                                        <span id="promocode_error" class="invalid-feedback" role="alert"></span>
                                    </div>
                                    <a class="promo__button" href="#" onclick="checkpromo()">Проверить</a>
                                </div>
                                <p class="clearfix"><?php echo app('translator')->get('basket.total'); ?>
                                    <b class="pull-right">
                                        <span id="totalprice"><?php echo e(\Cart::session(\Auth::user()->user_id)->getTotal()); ?></span> <?php echo app('translator')->get('basket.tenge'); ?>
                                    </b>
                                </p>
                                <p id="promo_wrapper"  class="clearfix" style="display: none">С промокодом
                                    <b class="pull-right"><span id="promocodeprice"></span> <?php echo app('translator')->get('basket.tenge'); ?></b>
                                </p>
                            </div>

                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                </div>

                <!-------------Promo-------------------------------------------------------------->
                <!--Ajaxpen jiberu-->

                <div class="formItem <?php if($errors->has('promo')): ?> errorBox <?php endif; ?>">


                    <!---------------------------------------------------------------------------------->

                    <div class="text-center mt-40 visible-xs">
                        <button id="sbmBtn2" class="btn btn-blue btn-lg" type="submit"><?php echo app('translator')->get('basket.filladdress'); ?></button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        function checkpromo() {
            $.ajax({
                method: "POST",
                url: "/checkpromo",
                data: {
                    'promocode': $("#promo").val(),
                    'order_id': <?php echo e($order->order_id); ?>

                },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            }).done(function (msq) {
                if (msq.success == 'true') {
                    $("#promo_wrapper").css('display','block');
                    $("#promo_wrapper").children().children().html(<?php echo e(\Cart::session(\Auth::user()->user_id)->getTotal()); ?>* (100 - msq.percentage) / 100);
                } else {
                    $("#promocode_error").html('<strong>* ' + msq.error + '</strong>');
                }
            });
        }

        window.onload = function() {
            <?php if($count==0): ?>
            document.getElementById('form').action = "/paymentInit";
            document.getElementById('sbmBtn1').innerText  = "<?php echo app('translator')->get('basket.pay'); ?>";
            document.getElementById('sbmBtn2').innerText  = "<?php echo app('translator')->get('basket.pay'); ?>";
            <?php endif; ?>
        };

        $("#samovivoz").change(function () {
            if (this.checked) {
                $('#pickup_addres').show();
                let form = document.getElementById('form');
                let button1 = document.getElementById('sbmBtn1');
                let button2 = document.getElementById('sbmBtn2');

                button1.innerText  = "<?php echo app('translator')->get('basket.pay'); ?>";
                button2.innerText  = "<?php echo app('translator')->get('basket.pay'); ?>";
                form.action = "/paymentInit";

                //форманы повторно жибермей ушин
                form.addEventListener('submit', function() {
                    button1.disabled = true;
                    button2.disabled = true;
                });
            }
        });
        $("#courier").change(function () {
            if (this.checked) {
                $('#pickup_addres').hide();
                document.getElementById('sbmBtn1').innerText  = "<?php echo app('translator')->get('basket.filladdress'); ?>";
                document.getElementById('sbmBtn2').innerText  = "<?php echo app('translator')->get('basket.filladdress'); ?>";
                document.getElementById('form').action = "/checkout-delivery";
            }
        });

        $("#post").change(function () {
            if (this.checked) {
                $('#pickup_addres').hide();
                document.getElementById('sbmBtn1').innerText  = "<?php echo app('translator')->get('basket.filladdress'); ?>";
                document.getElementById('sbmBtn2').innerText  = "<?php echo app('translator')->get('basket.filladdress'); ?>";
                document.getElementById('form').action = "/checkout-delivery";
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/checkout/checkout.blade.php ENDPATH**/ ?>