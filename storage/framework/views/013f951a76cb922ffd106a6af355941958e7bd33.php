<?php
    use App\Models\Book;
    use App\Models\OrderProducts;
    $text='text_'.App::getLocale();
    $lang=App::getLocale();
    $name='name_'.$lang;
?>

<?php $__env->startPush('styles'); ?>
    <style>
        .error-message {
            color: #cc0033;
            display: inline-block;
            font-size: 12px;
            line-height: 15px;
            margin: 5px 0 0;
        }

        .table-paument td {
            min-width: unset;
        }

        .section-row {
            padding: 30px 0;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Profile.main_header'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title"><?php echo app('translator')->get('Profile.main_header'); ?></h1>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <ul class="nav nav-tabs tab-li-prof">
                            <li class="active">
                                <a data-toggle="tab" href="#tabs1">
                                    <i class="icons ic-user"></i><?php echo app('translator')->get('Profile.menu_label1'); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabs2">
                                    <i class="icons ic-book"></i><?php echo app('translator')->get('Profile.menu_label2'); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabs5">
                                    <i class="icons "></i><?php echo app('translator')->get('Profile.my_subscriptions'); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabs3"><i class="icons ic-paument"></i><?php echo app('translator')->get('Profile.menu_label3'); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabs4">
                                    <i class="icons ic-book"></i><?php echo app('translator')->get('Profile.selecteds'); ?></a>
                            </li>
                            <li>
                                <a href="/basket"><i class="icons ic-bask"></i><?php echo app('translator')->get('Profile.menu_label4'); ?>
                                    <span class="ic-nof"><?php echo e(\Cart::getTotalQuantity()); ?></span></a>
                            </li>
                            <?php if($user->user_role_id): ?>
                                <li>
                                    <a href="/admin/dashboard"><i class="icons ic-star"></i>Админка</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="/logout"><i class="icons ic-out-user"></i><?php echo app('translator')->get('Profile.menu_label5'); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-8 input-prof">
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="tabs1">
                                <form method="post" action="updateProfile">
                                    <?php echo csrf_field(); ?>
                                    <div class="formBox">
                                        <div class="profileForm-head">
                                            <div class="profImg">
                                                <img id="userphoto" src="<?php echo e($user->avatar); ?>" alt="">
                                                <input id="avatar" name="avatar" type="file">
                                                <span><?php echo app('translator')->get('Profile.changephoto'); ?></span>
                                            </div>
                                        </div>
                                        <div class="formBox_caption">
                                            <p class="line-title"><b><?php echo app('translator')->get('Profile.menu_label1_header1'); ?></b></p>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <input class="form-control" name="email" type="email"
                                                           value='<?php echo e($user->email); ?>'
                                                           placeholder="Email" readonly="readonly">
                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="error-message">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control" name="name" type="text"
                                                           value='<?php echo e($user->user_name); ?>'
                                                           placeholder="<?php echo app('translator')->get('Profile.fio'); ?>">
                                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="error-message">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control" name="phone" type="text"
                                                           placeholder="<?php echo app('translator')->get('Profile.phone'); ?>"
                                                           value="<?php echo e($user->phone); ?>">
                                                </div>
                                            </div>
                                            <p class="line-title"><b><?php echo app('translator')->get('Profile.menu_label1_header2'); ?></b></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select class="form-control" name="city">
                                                <option selected="true"
                                                        disabled="disabled"><?php echo app('translator')->get('Profile.notchosen'); ?></option>
                                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(!empty($address)&& ($address->city == $item->id)): ?> <?php echo e('selected'); ?> <?php endif; ?>  value="<?php echo e($item->id); ?>"><?php echo e($item->$text); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="naselenny_punkt"
                                                   placeholder="<?php echo app('translator')->get('Profile.naselenny_punkt'); ?>"
                                                   value="<?php echo e((!empty($address))?$address->naselenny_punkt:''); ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="street"
                                                   placeholder="<?php echo app('translator')->get('Profile.street'); ?>"
                                                   value="<?php echo e((!empty($address))?$address->street:''); ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="home"
                                                   placeholder="<?php echo app('translator')->get('Profile.home'); ?>"
                                                   value="<?php echo e((!empty($address))?$address->home:''); ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="podezd"
                                                   placeholder="<?php echo app('translator')->get('Profile.podezd'); ?>"
                                                   value="<?php echo e((!empty($address))?$address->podezd:''); ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="kvartira"
                                                   placeholder="<?php echo app('translator')->get('Profile.kvartira'); ?>"
                                                   value="<?php echo e((!empty($address))?$address->kvartira:''); ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="post_index"
                                                   placeholder="<?php echo app('translator')->get('Profile.post_index'); ?>"
                                                   value="<?php echo e((!empty($address))?$address->post_index:''); ?>">
                                        </div>
                                    </div>


                                    <button class="btn btn-blue btn-lg" type="submit"><?php echo app('translator')->get('Profile.save'); ?></button>
                                </form>
                                <div class="change__password">
                                    <p class="line-title"><b><?php echo app('translator')->get('auth.changepass'); ?></b></p>
                                    <?php if(\Session::has('change_pass_success')): ?>
                                        <div class="alert alert-success">
                                            <ul>
                                                <li><?php echo \Session::get('change_pass_success'); ?></li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(\Session::has('change_pass_error')): ?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li><?php echo \Session::get('change_pass_error'); ?></li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <form method="POST" action="/changepass">
                                        <?php echo csrf_field(); ?>
                                        <div class="change__password__body">
                                            <input name="current_password" class="form-control input-lg "
                                                   type="password" placeholder="<?php echo app('translator')->get('auth.current_pass'); ?>" required="">
                                            <input name="new_password" class="form-control input-lg " type="password"
                                                   placeholder="<?php echo app('translator')->get('auth.new_pass'); ?>" required="">
                                            <input name="confirm_password" class="form-control input-lg "
                                                   type="password" placeholder="<?php echo app('translator')->get('auth.confirm_pass'); ?>" required="">
                                        </div>

                                        <button class="btn btn-blue btn-lg" type="submit"><?php echo app('translator')->get('auth.changepass'); ?></button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs2">
                                <ul class="nav nav-tabs tabs-li">
                                    <li class="active">
                                        <a data-toggle="tab" href="#tab1"><?php echo app('translator')->get('Profile.menu_label2_tab1'); ?></a></li>
                                    <li>
                                        <a data-toggle="tab" href="#tab2"><?php echo app('translator')->get('Profile.menu_label2_tab2'); ?></a></li>
                                    <li>
                                        <a data-toggle="tab" href="#tab3"><?php echo app('translator')->get('Profile.menu_label2_tab3'); ?></a></li>
                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane fade in active" id="tab1">
                                        <div class="row catalog">
                                            <?php $__currentLoopData = $user->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $item->books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($book->pivot->type =='paper'): ?>
                                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                                            <div class="item-books">
                                                                <div class="img-book">
                                                                    <?php if($book->main_image() && $item->status): ?>
                                                                        <img src="<?php echo e($book->main_image()->path); ?>">
                                                                        <div class="top-text-books bg-white">
                                                                            <i class="icons icon-make"></i>
                                                                            <?php echo e($item->status[$text]); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <p class="text-grey fs-15"></p>
                                                                <p>
                                                                    <?php echo e($book->book_name); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2">
                                        <div class="top-catalog">
                                            <p class="text-green">
                                                <i class="icons ic-tel"></i><?php echo app('translator')->get('Profile.menu_label2_tab2_info'); ?></p>
                                        </div>
                                        <div class="row catalog">
                                            <?php $__currentLoopData = $user->books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->pivot->type =='ebook'): ?>
                                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                                        <div class="item-books">
                                                            <a target="_blank" href="#" style="pointer-events: none;" title="Тек мобильді қосымшада оқи аласыздар">
                                                                <?php if($item->main_image()): ?>
                                                                    <div class="img-book">
                                                                        <img src="<?php echo e($item->main_image()->path); ?>">
                                                                    </div>
                                                                <?php endif; ?>
                                                                <p class="text-grey fs-15">
                                                                    <?php echo $__env->make('includes.bookauthors',['authors'=>$item->authors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                </p>
                                                                <p>
                                                                    <?php echo e($item->book_name); ?>

                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab3">
                                        <div class="top-catalog">
                                            <p class="text-green">
                                                <i class="icons ic-audio"></i><?php echo app('translator')->get('Profile.menu_label2_tab3_info'); ?>
                                            </p>
                                        </div>
                                        <div class="row catalog">
                                            <?php $__currentLoopData = $user->books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->pivot->type=='audio'): ?>
                                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                                        <div class="item-books">
                                                            <div class="img-book">
                                                                <img src="<?php echo e($item->main_image()->path); ?>">
                                                            </div>
                                                            <p class="text-grey fs-15"><?php echo $__env->make('includes.bookauthors',['authors'=>$item->authors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></p>
                                                            <p><?php echo e($item->book_name); ?></p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!---------------------------------История заказов------------------------------------------>
                            <div class="tab-pane fade" id="tabs3">
                                <div class="table-responsive">
                                    <table class="table table-paument">
                                        <tr>
                                            <th><?php echo app('translator')->get('Profile.order_number'); ?></th>
                                            <th><?php echo app('translator')->get('Profile.time'); ?></th>
                                            <th><?php echo app('translator')->get('Profile.books'); ?></th>
                                            <th><?php echo app('translator')->get('basket.deliverytitle'); ?></th>
                                            <th><?php echo app('translator')->get('Profile.bookssum'); ?></th>
                                            <th><?php echo app('translator')->get('basket.deliveryprice'); ?></th>
                                            <th>Жалпы</th>
                                            <th>Статус</th>
                                        </tr>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $deliveryprice =$order->deliveryprice?$order->deliveryprice:0; ?>
                                            <tr>
                                                <td class="text-nowrap"><?php echo e($order->order_id); ?></td>
                                                <td class="text-nowrap">
                                                    <?php echo e($order->updated_at->format('d/m/Y')); ?><br>
                                                    <?php echo e($order->updated_at->format('H:i:s')); ?>

                                                </td>
                                                <td class="text-green">
                                                        <?php
                                                        $books = OrderProducts::where('order_id', $order->order_id)->get()
                                                        ?>

                                                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <a href="/book/<?php echo e($book->product_id); ?>">
                                                            <?php if(Book::where('book_id',$book->product_id)->first()): ?>
                                                                <?php echo e(Book::where('book_id',$book->product_id)->first()->book_name); ?>

                                                            <?php else: ?>

                                                            <?php endif; ?>
                                                        </a>
                                                        ( <span style="color:#000"><?php echo app('translator')->get('Profile.'.$book->type); ?>
                                                            <?php if($book->type=='paper'): ?>
                                                                x <?php echo e($book->quantity); ?>

                                                            <?php endif; ?>
                                                            </span>)
                                                        <?php if($key!=count($books)-1): ?>,<br><?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?php if($order->delivery_type): ?><?php echo app('translator')->get('basket.'.$order->delivery_type); ?><?php endif; ?>
                                                </td>
                                                <td class="text-nowrap"><b><?php echo e($order->total); ?> ₸</b></td>
                                                <td class="text-nowrap">
                                                    <?php echo e($deliveryprice); ?> ₸
                                                </td>
                                                <td class="text-nowrap">
                                                    <?php echo e($deliveryprice+$order->total); ?> ₸
                                                </td>

                                                <td class="text-nowrap">
                                                    <?php if($order->status): ?>
                                                        <?php if($order->status_id==1): ?>
                                                            <?php echo app('translator')->get('order.paid'); ?>
                                                        <?php elseif($order->status_id==2): ?>
                                                            <?php if($order->delivery_type == 'pickup'): ?>
                                                                <?php echo app('translator')->get('order.waiting_pickup'); ?>
                                                            <?php else: ?>
                                                                <?php echo app('translator')->get('order.waiting_delivery'); ?>
                                                            <?php endif; ?>
                                                        <?php elseif($order->status_id==3): ?>
                                                            <?php echo app('translator')->get('order.delivered'); ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                </div>
                            </div>
                            <!---END------------------------------------История заказов--------- ---------------------->
                            <!--------------------------------------Избранные------------------------------------------>
                            <div class="tab-pane fade" id="tabs4">
                                <div class="row catalog">
                                    <?php $__currentLoopData = $selected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item-books">
                                                <?php if($item->book): ?>
                                                    <a target="_blank" href="/book/<?php echo e($item->book["book_url"]); ?>">
                                                        <div class="img-book">
                                                            <img src="<?php echo e($item->book->main_image()->path); ?>">
                                                        </div>
                                                        <p class="text-grey fs-15"></p>
                                                        <p><?php echo e($item->book->book_name); ?></p>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <!---END-------------------------------------------------- Избранные ---------------------->

                            <!--Подписки-->
                            <div class="tab-pane fade" id="tabs5">
                                <div class="row">
                                    <?php if($user->subscription): ?>
                                        <div class="col-md-6">
                                            <div class="profile-subscr-block">
                                                <h3 class="profile-subscr-block-title"><?php echo e($user->subscription->subscription["title_$lang"]); ?></h3>
                                                <p class="profile-subscr-block-text"><span class="text-pro-green"><?php echo app('translator')->get('Profile.active'); ?></span></p>
                                                <div class="profile-subscr-block-card">
                                                    <div class="profile-subscr-block-count">
                                                        <h3 class="profile-subscr-block-coin"><?php echo e($user->subscription->subscription->price); ?> ₸</h3>
                                                        <p class="profile-subscr-block-date">спишутся 2 февраля</p>
                                                    </div>
                                                    <img src="/img/icons/credit-card 1.png" alt="">
                                                </div>
                                            </div>
                                            <div class="profile-subscr-btns">
                                                <a href="/buy-subscription" class="view-btn"><?php echo app('translator')->get('Profile.other_tarifs'); ?></a>
                                                <button class="cancel-btn">Отменить подписку</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profile-subscr-block">
                                                <h3 class="profile-subscr-block-title">В вашу ежемесячную подписку входит:</h3>
                                                <?php if($user->subscription): ?>
                                                    <ul class="profile-subscr-list">
                                                        <?php $__currentLoopData = \App\Models\SubscriptionInformation::orderBy('sort')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(array_key_exists($value->id, json_decode($user->subscription->subscription["description"],true))): ?>
                                                                <li <?php if(json_decode($user->subscription->subscription["description"],true)[$value->id]): ?> class="subscr-li-done" <?php else: ?> class="subscr-li-error" <?php endif; ?>><span><?php echo e($value["title_$lang"]); ?></span></li>
                                                            <?php else: ?>
                                                                <li  class="subscr-li-error"><span><?php echo e($value["title_$lang"]); ?></span></li>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php if($user->last_subscription): ?>
                                            <div class="col-md-6">
                                                <div class="profile-subscr-block">
                                                    <h3 class="profile-subscr-block-title"><?php echo e($user->last_subscription->subscription["title_$lang"]); ?></h3>
                                                    <p class="profile-subscr-block-text">
                                                        <?php if($user->last_subscription->active): ?>
                                                            <span class="text-pro-green"><?php echo app('translator')->get('Profile.active'); ?>   </span>
                                                        <?php else: ?>
                                                            <span style="color:red"><?php echo app('translator')->get('subscription.nonactive'); ?> </span>
                                                        <?php endif; ?>
                                                    </p>
                                                    <div class="profile-subscr-block-card">
                                                        <div class="profile-subscr-block-count">
                                                            <h3 class="profile-subscr-block-coin"><?php echo e($user->last_subscription->subscription->price); ?> ₸</h3>
                                                            <p class="profile-subscr-block-date">
                                                                Закончился <?php echo e(date("d-m-Y", strtotime($user->last_subscription->final_date))); ?>

                                                            </p>
                                                        </div>
                                                        <img src="/img/icons/credit-card 1.png" alt="">
                                                    </div>
                                                </div>

                                                <div class="profile-subscr-btns">
                                                    <a href="/buy-subscription" class="view-btn"><?php echo app('translator')->get('subscription.buy_again'); ?></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile-subscr-block">
                                                    <h3 class="profile-subscr-block-title"><?php echo app('translator')->get('subscription.contains'); ?></h3>
                                                    <ul class="profile-subscr-list">
                                                        <?php $__currentLoopData = \App\Models\SubscriptionInformation::orderBy('sort')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(array_key_exists($value->id, json_decode($user->last_subscription->subscription["description"],true))): ?>
                                                                <li <?php if(json_decode($user->last_subscription->subscription["description"],true)[$value->id]): ?> class="subscr-li-done" <?php else: ?> class="subscr-li-error" <?php endif; ?>><span><?php echo e($value["title_$lang"]); ?></span></li>
                                                            <?php else: ?>
                                                                <li  class="subscr-li-error"><span><?php echo e($value["title_$lang"]); ?></span></li>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="profile-subscr-btns">
                                                <a href="/buy-subscription" class="view-btn"><?php echo app('translator')->get('Profile.see_tarifs'); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        //Изменить аватар
        $('#avatar').change(function () {
            formdata = new FormData();
            if ($(this).prop('files').length > 0) {
                file = $(this).prop('files')[0];
                formdata.append("avatar", file);
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '/uploadavatar',
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (result) {
                    $('#userphoto').attr("src", result);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/profile.blade.php ENDPATH**/ ?>