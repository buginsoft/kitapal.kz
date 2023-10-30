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

                        <form id="form" action="/paymentInit" method="post">
                            <input type="hidden" value="<?php echo e(\Cart::getTotal()); ?>" name="price">
                            <input id="delivery_price" type="hidden" value="" name="delivery_price">
                            <input type="hidden" value="<?php echo e($order->order_id); ?>" name="order_id">
                            <?php echo csrf_field(); ?>
                            <div class="mb-25">
                                <p class="mb-25 line-title"><b><?php echo app('translator')->get('Profile.menu_label1_header2'); ?></b></p>
                                <?php if(empty($address) || $errors->has('city')): ?>
                                    <div id="addressyerror" class="alert alert-danger" role="alert" style="text-align:center;">
                                        <?php echo app('translator')->get('basket.address_fill_warning'); ?>
                                    </div>
                                <?php endif; ?>

                                <div id="address" class="row" style="display: none">
                                    <?php echo $__env->make('checkout.includes.address_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>

                                <div id="address_change" class="row" >
                                    <?php echo $__env->make('checkout.includes.address_change_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <button id="addressChangeButton" onclick="changeAddress()" class="btn btn-blue btn-lg" type="button" style="display: none">
                                            <?php echo e(empty($address)?'Толтыру':'Өзгерту'); ?>

                                        </button>

                                        <button  id="cacldelprice" onclick="calcDeliverPrice()" class="btn btn-blue btn-lg" type="button">
                                            <?php echo app('translator')->get('basket.calculate_delivery'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-25">
                                <p class="fs-15 text-grey"><?php echo app('translator')->get('basket.errorinfo'); ?></p>
                            </div>

                            <div class="text-right hidden-xs">
                                <div id="deliveryerror" class="alert alert-danger" role="alert" style="text-align:center;display: none;"></div>
                                <a href="<?php echo e(url()->previous()); ?>"  class="btn  btn-lg" style="background: linear-gradient(
180deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%), #676566;;color:#fff"><?php echo app('translator')->get('basket.back'); ?></a>
                                <button id="sbmBtn1" class="btn btn-blue btn-lg" type="submit"  style="display: none"><?php echo app('translator')->get('basket.pay'); ?></button>
                            </div>
                    </div>
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
                                <p class="clearfix"><?php echo app('translator')->get('basket.delivery'); ?>
                                    <b class="pull-right"><span id="price">0</span> <?php echo app('translator')->get('basket.tenge'); ?></b>
                                </p>
                                <p class="clearfix"><?php echo app('translator')->get('basket.total'); ?>
                                    <b class="pull-right">
                                        <span id="totalprice"><?php echo e(\Cart::getTotal()); ?></span> <?php echo app('translator')->get('basket.tenge'); ?>
                                    </b>
                                </p>
                                <?php if($order->promocode_id): ?>
                                    <p class="clearfix">С промокодом
                                        <b class="pull-right">
                                        <span>
                                            <?php if(\Auth::user()): ?>
                                                <?php echo e(\Cart::session(\Auth::user()->user_id)->getTotal()*(100-\App\Models\Promocodes::find($order->promocode_id)->percentage)/100); ?>

                                            <?php else: ?>
                                                <?php echo e(\Cart::session(session()->getId())->getTotal()*(100-\App\Models\Promocodes::find($order->promocode_id)->percentage)/100); ?>

                                            <?php endif; ?>
                                        </span>
                                            <?php echo app('translator')->get('basket.tenge'); ?>
                                        </b>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-------------Promo-------------------------------------------------------------->
                <!--Ajaxpen jiberu-->

                <div class="formItem <?php if($errors->has('promo')): ?> errorBox <?php endif; ?>">
                    <div class="text-center mt-40 visible-xs">
                        <div id="deliveryerrormobile" class="alert alert-danger" role="alert" style="text-align:center;display:none;"></div>
                        <a href="<?php echo e(url()->previous()); ?>"  class="btn  btn-lg" style="background: linear-gradient(
180deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%), #676566;;color:#fff" ><?php echo app('translator')->get('basket.back'); ?></a>
                        <button id="sbmBtn2" class="btn btn-blue btn-lg" type="submit" style="display: none"><?php echo app('translator')->get('basket.pay'); ?></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="map" style="display: none"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=1c5b5a65-31ff-4dbd-89e5-d2ceaed5453c" type="text/javascript"></script>
    <script>

        //форманы повторно жибермей ушин
        let form = document.getElementById('form');
        let button1 = document.getElementById('sbmBtn1');
        let button2 = document.getElementById('sbmBtn2');
        form.addEventListener('submit', function() {
            button1.disabled = true;
            button2.disabled = true;
        });
        //


        function calcDeliverPrice(){
            <?php if($cart->getTotal()>=$free->price || $free_delivery): ?>
            $("#price").html(0);
            $("#delivery_price").val(0);
            saveDelPricenAddress('<?php echo e($order->delivery_type); ?>',<?php echo e($order->order_id); ?>)
            <?php else: ?>
            <?php if($order->delivery_type == 'courier' ): ?>
            ymaps.ready(init);
            <?php else: ?>
            getPostPrice()
            saveDelPricenAddress('<?php echo e($order->delivery_type); ?>',<?php echo e($order->order_id); ?>)
            <?php endif; ?>
            <?php endif; ?>
        }

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [43.223342794696485, 76.95543649999995],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            });
            var Polygon1 = new ymaps.GeoObject({
                geometry: {
                    type: "Polygon",
                    coordinates: [
                        [
                            [43.28096028597733, 76.91173166074293],
                            [43.28221443254844, 76.91542238034764],
                            [43.28647833613404, 76.9211730364756],
                            [43.29067924087404, 76.92735284604588],
                            [43.292278015909, 76.93198770322343],
                            [43.293688664613086, 76.9370517138436],
                            [43.294879853387364, 76.95112794675389],
                            [43.29437830307338, 76.95361703671945],
                            [43.26482678303403, 76.95811032193656],
                            [43.264585753696586, 76.95409589570448],
                            [43.25072194491856, 76.95594125550633],
                            [43.23638793982004, 76.9577093392848],
                            [43.228559414148066, 76.9606087096755],
                            [43.22771703191939, 76.94422193976884],
                            [43.207378332382696, 76.91422411414645],
                            [43.20405067266317, 76.91345163794979],
                            [43.20116236697494, 76.90976091834534],
                            [43.200848412406444, 76.9058985373641],
                            [43.19463177690143, 76.89508387061565],
                            [43.19462519047127, 76.87882920397638],
                            [43.19531595934886, 76.87475224627362],
                            [43.197451013289665, 76.87084694994822],
                            [43.19914644370561, 76.86917325152297],
                            [43.20106159506878, 76.86801453722835],
                            [43.205613761042166, 76.86535378588557],
                            [43.20790541168497, 76.86295052660863],
                            [43.19826790459326, 76.84205122668362],
                            [43.20043425027252, 76.83999129016011],
                            [43.20307143610853, 76.83810301501325],
                            [43.20869077055232, 76.8353135176382],
                            [43.210825353138326, 76.8340260573107],
                            [43.23268054402241, 76.82530677006422],
                            [43.242208155507925, 76.82194089471623],
                            [43.24361997329939, 76.82760572015582],
                            [43.254160504753244, 76.82288503228953],
                            [43.25949726629967, 76.84925343953553],
                            [43.27724732173191, 76.89783360921327],
                            [43.27957493090634, 76.90547984171543],
                            [43.28096028597733, 76.91173166074293]
                        ]
                    ]
                }
            });

            var Polygon2 = new ymaps.GeoObject({
                geometry: {
                    type: "Polygon",
                    coordinates: [
                        [
                            [43.21275631332884, 76.9689061610217],
                            [43.21226977619743, 76.9664599864001],
                            [43.21032813923686, 76.95484478797084],
                            [43.18175471886071, 76.9104511758446],
                            [43.18000401237177, 76.89715668700637],
                            [43.181986979870324, 76.87104873071242],
                            [43.191419837745165, 76.85527917017549],
                            [43.18306190162184, 76.83642192386027],
                            [43.1998727329973, 76.8190415824934],
                            [43.23587921682672, 76.80498139735045],
                            [43.23953654339877, 76.80957008009287],
                            [43.26436146043744, 76.80026779469682],
                            [43.27168635778994, 76.84271287850736],
                            [43.28985445964523, 76.89955259311442],
                            [43.30701075558935, 76.92325994361269],
                            [43.30913595108665, 76.95517923153675],
                            [43.31238515574286, 76.98102309850269],
                            [43.22560205032136, 76.98742009769913],
                            [43.21275631332884, 76.9689061610217]
                        ],
                        [
                            [43.28096028597733, 76.91173166074293],
                            [43.28221443254844, 76.91542238034764],
                            [43.28647833613404, 76.9211730364756],
                            [43.29067924087404, 76.92735284604588],
                            [43.292278015909, 76.93198770322343],
                            [43.293688664613086, 76.9370517138436],
                            [43.294879853387364, 76.95112794675389],
                            [43.29437830307338, 76.95361703671945],
                            [43.26482678303403, 76.95811032193656],
                            [43.264585753696586, 76.95409589570448],
                            [43.25072194491856, 76.95594125550633],
                            [43.23638793982004, 76.9577093392848],
                            [43.228559414148066, 76.9606087096755],
                            [43.22771703191939, 76.94422193976884],
                            [43.207378332382696, 76.91422411414645],
                            [43.20405067266317, 76.91345163794979],
                            [43.20116236697494, 76.90976091834534],
                            [43.200848412406444, 76.9058985373641],
                            [43.19463177690143, 76.89508387061565],
                            [43.19462519047127, 76.87882920397638],
                            [43.19531595934886, 76.87475224627362],
                            [43.197451013289665, 76.87084694994822],
                            [43.19914644370561, 76.86917325152297],
                            [43.20106159506878, 76.86801453722835],
                            [43.205613761042166, 76.86535378588557],
                            [43.20790541168497, 76.86295052660863],
                            [43.19826790459326, 76.84205122668362],
                            [43.20043425027252, 76.83999129016011],
                            [43.20307143610853, 76.83810301501325],
                            [43.20869077055232, 76.8353135176382],
                            [43.210825353138326, 76.8340260573107],
                            [43.23268054402241, 76.82530677006422],
                            [43.242208155507925, 76.82194089471623],
                            [43.24361997329939, 76.82760572015582],
                            [43.254160504753244, 76.82288503228953],
                            [43.25949726629967, 76.84925343953553],
                            [43.27724732173191, 76.89783360921327],
                            [43.27957493090634, 76.90547984171543],
                            [43.28096028597733, 76.91173166074293]
                        ]
                    ]
                }
            });

            var Polygon3 = new ymaps.GeoObject({
                geometry: {
                    type: "Polygon",
                    coordinates: [
                        [
                            [43.29458841400743, 76.87012956830027],
                            [43.31993425076197, 76.91240291688122],
                            [43.324975295650034, 76.99433479348258],
                            [43.21965568186784, 77.00434130747826],
                            [43.201140191806665, 76.97726785618818],
                            [43.19732773794628, 76.95442653517539],
                            [43.16989573295001, 76.91249480189859],
                            [43.16921950493439, 76.89211323658766],
                            [43.17077902229939, 76.86185034416597],
                            [43.176604911908974, 76.84476331020554],
                            [43.16838010293925, 76.82744401946644],
                            [43.194513276058395, 76.80295414486321],
                            [43.23851007528382, 76.78629781725498],
                            [43.244776499155485, 76.79550658010747],
                            [43.271238945287685, 76.78459755272712],
                            [43.29458841400743, 76.87012956830027]
                        ],
                        [
                            [43.21275631332884, 76.9689061610217],
                            [43.21226977619743, 76.9664599864001],
                            [43.21032813923686, 76.95484478797084],
                            [43.18175471886071, 76.9104511758446],
                            [43.18000401237177, 76.89715668700637],
                            [43.181986979870324, 76.87104873071242],
                            [43.191419837745165, 76.85527917017549],
                            [43.18306190162184, 76.83642192386027],
                            [43.1998727329973, 76.8190415824934],
                            [43.23587921682672, 76.80498139735045],
                            [43.23953654339877, 76.80957008009287],
                            [43.26436146043744, 76.80026779469682],
                            [43.27168635778994, 76.84271287850736],
                            [43.28985445964523, 76.89955259311442],
                            [43.30701075558935, 76.92325994361269],
                            [43.30913595108665, 76.95517923153675],
                            [43.31238515574286, 76.98102309850269],
                            [43.22560205032136, 76.98742009769913],
                            [43.21275631332884, 76.9689061610217]
                        ]
                    ]
                }
            });
            myMap.geoObjects.add(Polygon1);
            myMap.geoObjects.add(Polygon2);
            myMap.geoObjects.add(Polygon3);
            let street = $("#street").val();
            let home = $("#home").val();
            var myGeocoder = ymaps.geocode('Алматы,' + street + ',' + home);
            myGeocoder.then(
                function (res) {
                    var firstGeoObject = res.geoObjects.get(0);
                    coords = firstGeoObject.geometry.getCoordinates();
                    if (Polygon1.geometry.contains(coords)) {
                        $("#price").html('<?php echo e($almatycourier[0]->price); ?>');
                        $("#delivery_price").val(<?php echo e($almatycourier[0]->price); ?>);
                        saveDelPricenAddress('<?php echo e($order->delivery_type); ?>',<?php echo e($order->order_id); ?>)
                    } else if (Polygon2.geometry.contains(coords)) {
                        $("#price").html('<?php echo e($almatycourier[1]->price); ?>');
                        $("#delivery_price").val(<?php echo e($almatycourier[1]->price); ?>);
                        saveDelPricenAddress('<?php echo e($order->delivery_type); ?>',<?php echo e($order->order_id); ?>)
                    } else if (Polygon3.geometry.contains(coords)) {
                        $("#price").html('<?php echo e($almatycourier[2]->price); ?>');
                        $("#delivery_price").val(<?php echo e($almatycourier[2]->price); ?>);
                        saveDelPricenAddress('<?php echo e($order->delivery_type); ?>',<?php echo e($order->order_id); ?>)
                    }
                    else {
                        document.getElementById("deliveryerror").style.display = "block";
                        $('#deliveryerror').text('<?php echo app('translator')->get('basket.notdelivering'); ?>')
                        document.getElementById("deliveryerrormobile").style.display = "block";
                        $('#deliveryerrormobile').text('<?php echo app('translator')->get('basket.notdelivering'); ?>')
                    }
                }
            );
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/checkout/checkout-delivery.blade.php ENDPATH**/ ?>