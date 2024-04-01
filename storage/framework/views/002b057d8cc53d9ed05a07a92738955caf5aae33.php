<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        .selected {
            color: red;
        }

        #bg_popup {
            background-color: rgba(0, 0, 0, 0.8);
            display: none;
            position: fixed;
            z-index: 99999;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        #popup {
            background: #fff;
            width: 560px;
            margin: 20% auto;
            padding: 25px 17px 40px 16px;
            position: relative;
            background: #FFFFFF;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1), 0px 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            position: relative;
            top: -220px;
        }

        .big-title{
            font-family: "Roboto", sans-serif;
        }

        .popup__cont .close {
            display: block;
            position: absolute;
            top: 18px;
            right: 14px;
            width: 27px;
            height: 32px;
            cursor: pointer;
            opacity: 1;
        }

        .popup__cont .close:hover {
            background-color: unset;
        }

        .close:hover {
            background-color: #f30;
        }

        .popup__box {
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .popup__box h1 {
            font-weight: 600;
            font-size: 26px;
            line-height: 130%;
            /* identical to box height, or 34px */
            text-align: center;
            color: #222222;
            margin-bottom: 15px;
        }

        .popup__box .img__container {
            margin-bottom: 40px;
        }

        .popup__box .img__container img {
            max-width: 100%;
            appearance: none;
        }

        .popup__box .icons-container {
        }

        .popup__box .icons-container a img {
            max-width: 100%;
            opacity: 0.7;
            margin: 0px 8px;
            transition: all 0.5s;
        }

        .popup__box .icons-container a img:hover {
            opacity: 1;
        }

        /*favourite__item*/
        .slide-main-books .item-bag.chosen {
            position: absolute;
            top: 10px;
            right: 21px;
            left: unset;
            border: none;
            padding: unset;
        }

        .slide-main-books .item-bag.chosen:hover {
            color: #e80909;
            background: unset;
        }

        .slide-main-books .item-bag.chosen .fa-heart {
            font-size: 18px;
        }

        .slide-main-books .item-bag.text {
            border: unset;
            background: unset;
            padding: unset;
            top: 10px;
        }


        .item-article{
            box-shadow: 0 2px 4px rgb(0 0 0 / 15%)
        }

        p.block__title{
            font-size: 18px;
        }

        @media (max-width: 767px){
            .text-article {
                height: 13rem
            }
        }
        @media (max-width: 1200px) {
            #popup {
                top: -139px;
            }
            .img-book img{
                width: 100%;
                height: 100%;
            }
            .img-book{
                height: 195px;
            }
        }
        @media (max-width: 991px){
            /*.img-book img{*/
            /*    height: 234px;*/
            /*}*/
            .img-book{
                height: 225px;
                margin-bottom: .5rem
            }
        }
        @media (max-width: 767px){
            .item-books{
                height: 351px;
            }
        }

        @media (max-width: 800px) {
            #popup {
                width: 505px;
                top: -42px;
            }
        }

        @media (max-width: 600px) {
            #popup {
                width: 399px;
                /*height: 439px;*/
                top: -42px;
            }

            .popup__box h1 {
                margin-bottom: 6px;
                margin-top: 8px;
            }

            .popup__box .img__container {
                display: flex;
                justify-content: center;
                margin-bottom: 15px;
            }

            .popup__box .img__container img {
                max-width: 81%;

            }

            .popup__box .icons-container a img {

                margin: 0px 3px;
            }
        }

        @media (max-width: 530px) {
            #popup {
                width: 304px;
                /*height: 410px;*/
                top: 0px;
            }

            .popup__cont .close {
                top: 10px;
                right: 8px;
            }

            .popup__box h1 {
                line-height: 110%;
            }

            .popup__box .icons-container a img {
                margin: 0px 0px;
                width: 129px;
                height: 37px;
            }

            .popup__box .img__container img {
                width: 220px;
                height: 216px;
                max-width: unset;
            }

        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title',__('main.title')); ?>
<?php $__env->startSection('content'); ?>
    <?php if(\Session::has('success')): ?>
        <script>
            Swal.fire(
                '<?php echo app('translator')->get('status.success'); ?>',
                '<?php echo e(\Session::get('success')); ?>',
                'success'
            );
        </script>
    <?php endif; ?>
    <?php if(\Session::has('error')): ?>
        <script>
            Swal.fire(
                '<?php echo app('translator')->get('status.error'); ?>',
                '<?php echo e(\Session::get('error')); ?>',
                'warning'
            );
        </script>
    <?php endif; ?>
    <?php if(session('status')): ?>
        <script>
            Swal.fire(
                '<?php echo app('translator')->get('status.success'); ?>',
                '<?php echo e(session('status')); ?>',
                'success'
            );
        </script>
    <?php endif; ?>
    <?php if(isset($_GET['paymentstatus'])): ?>
        <?php if($_GET['paymentstatus']==1): ?>
        <script>
            Swal.fire(
                'Успешно оплачен',
                '<?php echo e(session('status')); ?>',
                'success'
            );
        </script>
            <?php elseif($_GET['paymentstatus']==0): ?>
            <script>
                Swal.fire(
                    'С сожалением сообщаем вам, что ваш  платеж не прошел. Убедитесь, что предоставленная вами платежная информация является точной и актуальной. Если вы по-прежнему испытываете трудности, пожалуйста, не стесняйтесь обращаться к нам за помощью.',
                    '<?php echo e(session('status')); ?>',
                    'error'
                );
            </script>
            <?php endif; ?>
    <?php endif; ?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <?php echo $__env->make('includes.booksearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div id="bg_popup" class="popup__cont">
                    <div id="popup">
                        <div class="popup__box">
                            <h1>Мобильді приложение жүктеп алыңыз!</h1>

                            <div class="img__container">
                                <img src="../img/popup_window/woman.jpg" alt="">
                            </div>
                            <div class="icons-container d-flex">
                                <a target="_blank" href="https://apps.apple.com/kz/app/kitapal/id1510525545">
                                    <img src="../img/popup_window/app_store.svg" alt="">
                                </a>
                                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.buginsoft.kitapal&hl=en_NZ">
                                    <img src="../img/popup_window/google_play.svg" alt="">
                                </a>
                            </div>

                            
                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                            
                            
                            

                            
                            
                            
                            
                            

                            
                            
                            
                            


                            
                        </div>
                        <a class="close" href="#" title="Закрыть"
                           onclick="document.getElementById('bg_popup').style.display='none'; return false;">
                            <img src="../img/popup_window/the_cross.svg" alt="">
                        </a>
                    </div>
                    <script type="text/javascript">
                        function setCookie(cname, cvalue, exdays) {
                            var d = new Date();
                            d.setTime(d.getTime() + (exdays*24*60*60*1000));
                            var expires = "expires="+d.toUTCString();
                            document.cookie = cname + "=" + cvalue + "; " + expires;
                        }

                        function getCookie(cname) {
                            var name = cname + "=";
                            var ca = document.cookie.split(';');
                            for(var i=0; i<ca.length; i++) {
                                var c = ca[i];
                                while (c.charAt(0)==' ') c = c.substring(1);
                                if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
                            }
                            return "";
                        }

                        var cookie = getCookie('shown');
                        if (!cookie) {
                            showPopup();
                        }

                        function showPopup() {
                            setCookie('shown', 'true', 365);
                            var delay_popup = 3000;
                            setTimeout("document.getElementById('bg_popup').style.display='block'", delay_popup);
                        }
                    </script>
                </div>
                <div class="big-slid">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->type == 'book'): ?>
                            <a href="/book/<?php echo e(\App\Models\Book::find($item->book_id)->book_url); ?>" class="bg-green">
                        <?php elseif($item->type == 'catalog'): ?>
                                    <a href="/catalog/<?php echo e($item->catalog_id); ?>" class="bg-green">
                                        <?php else: ?>
                                            <a href="/collection/<?php echo e($item->collection_id); ?>" class="bg-green">
                        <?php endif; ?>


                            <div class="container">
                                <div class="top-slid">
                                    <div class="main-image">
                                        <img src="<?php echo e($item->slider_image); ?>" alt="">
                                    </div>
                                    <div class="main-image-adap">
                                        <img src="<?php echo e($item->adaptive_image); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($collection->books->count()): ?>


                            <!--Нижний слайдер с книгами-->
                            <?php if($loop->iteration==2): ?>
                                <?php if($bottom_sliders): ?>
                                    <?php $__currentLoopData = $bottom_sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="section-row">
                                            <div class="bg-white-pink">
                                                <div class="offer__book">
                                                    <div class="offer__book_img">
                                                        <img src="<?php echo e($slider->book->main_image()->path); ?>" alt="">
                                                    </div>
                                                    <div class="offer__book_text">
                                                        <h2><?php echo e($slider->book->book_name); ?></h2>
                                                        <div class="offer__book_author_category">
                                                            <p>Автор:
                                                                <?php $__currentLoopData = $slider->book->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <span class="text-green">
                                                                        <a href="/author/<?php echo e($author->id); ?>"><?php echo e($author["name_$lang"]); ?></a><?php if(!$loop->last): ?>,<?php endif; ?>
                                                                    </span>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </p>

                                                            <p><?php echo app('translator')->get('book.serya'); ?>:
                                                                <?php $__currentLoopData = $slider->book->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <span class="text-green">
                                                                        <a href="/catalog/<?php echo e($genres->genre_id); ?>"><?php echo e($genres["genre_name_$lang"]); ?><?php if(!$loop->last): ?>,<?php endif; ?></a>
                                                                    </span>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </p>
                                                        </div>
                                                        <div class="offer__book_annotation">
                                                            <h3><?php echo app('translator')->get('book.annotasya'); ?></h3>
                                                            <hr>
                                                            <?php echo $slider->book->book_description; ?>

                                                        </div>
                                                        <div class="offer__book_price">
                                                            <h2>
                                                                <?php echo e(($slider->book->sale_percentage>0)?number_format(round($slider->book->paperbook_price*(100-$slider->book->sale_percentage)/100), 0, '', ' '):number_format($slider->book->paperbook_price, 0, '', ' ')); ?>₸
                                                            </h2>
                                                            <div class="offer__book_price_btns">
                                                                <button class="offer__book_buy_btn" onclick="buynow('paper',<?php echo e($slider->book->book_id); ?>)">
                                                                    <?php echo app('translator')->get('book.buy_now'); ?>
                                                                </button>
                                                                <button class="offer__book_addToCart_btn" onclick="buy('paper',<?php echo e($slider->book->book_id); ?>)">
                                                                    <img src="../img/icons/addToCart-icon.svg" alt="">
                                                                    <?php echo app('translator')->get('book.to_cart'); ?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <!----------------------------------------------------------------------------------------->
                            <?php if(isset($collection->banner_url)): ?>
                                <div class="section-row">
                                    <a href="<?php echo e($collection->banner_url); ?>">
                                        <img style="max-height: 100px;width: 100%;object-fit: cover;"
                                             src="<?php echo e($collection->banner_image); ?>" alt="Изображение">
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="section-row">
                                <p class="big-title">
                                    <a style="color:unset" href="/collection/<?php echo e($collection->collection_id); ?>"><?php echo e($collection["collection_name_$lang"]); ?></a>
                                </p>
                                <div class="slid-books">
                                    <?php
                                        if($collection->collection_id==12){
                                            $collection_books=$collection->books()->with(['authors','main_image2'])->orderBy('created_at','desc')->take(15)->get();
                                        }
                                        else{
                                            $collection_books=$collection->books()->with(['authors','main_image2'])->inRandomOrder()->take(15)->get();
                                        }
                                    ?>
                                    <?php $__currentLoopData = $collection_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="slide-main-books" style="z-index: -111;width: 194px;position:relative;">
                                            <a href="/book/<?php echo e($item->book_url); ?>" style="z-index: -111;">
                                                <div class="item-books">
                                                    <div class="img-book">
                                                        <?php if($item->main_image2->first()): ?>
                                                            <img src="<?php echo e($item->main_image2->first()->thumbnail180_250?$item->main_image2->first()->thumbnail180_250:$item->main_image2->first()->path); ?>">
                                                        <?php endif; ?>
                                                        <?php if($collection->show_badge): ?>
                                                            <div style='background: <?php echo e($collection->color); ?>;color: #fff;' class="top-text-books">
                                                                <i style='background: url("<?php echo e($collection->icon); ?>") no-repeat center/11px;
                                                                        width: 11px;
                                                                        height: 11px;
                                                                        margin-right: 3px;
                                                                        vertical-align: text-top;' class="icons"></i><?php echo e($collection["collection_name_$lang"]); ?>

                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="opacity-img"></div>
                                                    </div>
                                                    <span><?php echo e($item->paperbook_price*((100-$item->sale_percentage)/100)); ?> тг</span>
                                                    <?php if($item->sale_percentage>0): ?>
                                                        <span class="old-price" style="z-index: 999;"><?php echo e($item->paperbook_price); ?> ₸</span>
                                                    <?php endif; ?>
                                                    <p class="text-grey fs-15">
                                                        <?php echo $__env->make('includes.bookauthors',['authors'=>$item->authors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </p>
                                                    <p class="description__text"><?php echo e($item->book_name); ?></p>
                                                    <?php if($item->subscribable): ?>
                                                        <h4 class="text-pro-purple"><?php echo app('translator')->get('main.subscribe'); ?></h4>
                                                    <?php else: ?>
                                                        <h4 class="text-pro-green"><?php echo app('translator')->get('main.buy'); ?></h4>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                            <?php if($item->available): ?>
                                                <span onclick="buy('paper',<?php echo e($item->book_id); ?>)" class="item-bag">+ Добавить в корзину</span>
                                            <?php endif; ?>

                                            <span class="item-bag chosen" onclick="addToSelected(<?php echo e($item->book_id); ?>)">
                                                <i id="heart<?php echo e($item->book_id); ?>"
                                                   class="<?php if(\Auth::user() && $item->selected->where('user_id',\Auth::user()->user_id)->first()): ?> selected <?php endif; ?> fas fa-heart"></i>
                                            </span>
                                            <span class="item-bag text">
                                                 <p id="heart_text<?php echo e($item->book_id); ?>">
                                                     <?php echo e((\Auth::user() && $item->selected->where('user_id',\Auth::user()->user_id)->first())?'Удалить из избранного':' Добавить в избранное'); ?>

                                                 </p>
                                            </span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="section-row">
                        <p class="big-title"><?php echo app('translator')->get('main.articles_title'); ?>
                            <span class="pull-right">
                                <a class="text-green" href="/articles"><?php echo app('translator')->get('main.all_articles'); ?>
                                    <i class="icons ic-arrow-r"></i></a>
                            </span>
                        </p>
                        <div class="row">
                            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3 col-sm-6">
                                    <a href="/article/<?php echo e($article['id']); ?>">
                                        <div class="item-article">
                                            <img src="<?php echo e($article['image']); ?>">
                                            <div class="text-article">
                                                <p class="block__title"><?php echo e($article["title_$lang"]); ?></p>
                                                <p class="fs-15 text-grey"><?php echo $article["short_text_$lang"]; ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="section-row">
                        <div class="bg-black-grey">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="big-title"><?php echo app('translator')->get('main.prilozhenie_kokzhiek'); ?></p>
                                    <p class="max-w-420"><?php echo app('translator')->get('main.teper_u_vas_est_vozm'); ?></p>
                                    <button class="btn btn-grey"
                                            onclick="window.location.href='https://apps.apple.com/kz/app/kitapal/id1510525545'">
                                        <i class="icons ic-app"></i>
                                        <?php echo app('translator')->get('main.appstore'); ?>
                                    </button>
                                    <button class="btn btn-grey"
                                            onclick="window.location.href='https://play.google.com/store/apps/details?id=com.buginsoft.kitapal&hl=ru'">
                                        <i class="icons ic-and"></i>
                                        <?php echo app('translator')->get('main.playmarket'); ?>
                                    </button>
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
                if (msg.success) {
                    let count = parseInt($('#shoppingcart_count').text()) + 1;
                    $("#shoppingcart_count").html(count);
                    $.toast({
                        heading: '<?php echo e(__('status.success')); ?>',
                        text: '<?php echo e(__('book.buysuccesstext')); ?>',
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
        function buynow(type, bookid) {
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
                    window.location.href = '/basket';
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
                    let hinttext;
                    if (msg.action === 'add') {
                        $("#heart" + bookid).addClass('selected');
                        text = 'Успешно добавлен';
                        hinttext = 'Удалить из избранного';
                    } else {
                        $("#heart" + bookid).removeClass('selected');
                        text = 'Успешно удален';
                        hinttext = 'Добавить в избранное';
                    }
                    $.toast({
                        heading: '<?php echo e(__('status.success')); ?>',
                        text: text,
                        bgColor: '#8E2976',
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                    $("#heart_text" + bookid).text(hinttext);
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/index.blade.php ENDPATH**/ ?>