<?php
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Helpers;
$lang = app()->getLocale();
$name = 'name_' . $lang;

?>

<?php $__env->startSection('meta'); ?>
    <meta property="og:title" content="<?php echo e($book->book_name); ?>"/>
    <meta property="og:description" content="<?php echo e(Str::limit(substr($book->book_description, 3,-4), 20)); ?>"/>
    <meta property="og:image" content="https://kitapal.kz<?php echo e($book->main_image()->path); ?>"/>
    <meta property="vk:image" content="https://kitapal.kz<?php echo e($book->main_image()->path); ?>"/>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <script src="/js/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <link rel="stylesheet" href="/css/sweetalert2.min.css">
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <style>
        .selected{
            color:rgb(236, 24, 24) !important;
        }
        .discount-price .old-price {
            display: inline-block;
            margin-left: 20px;
            /*text-decoration: line-through;*/
            color: #777777;
            font-size: 28px;
            position: relative;
        }

        .discount-price .old-price:after {
            position: absolute;
            content: "";
            left: 0;
            top: 50%;
            right: 0;
            border-top: 2px solid #777777;
            border-color: inherit;

            -webkit-transform: rotate(-5deg);
            -moz-transform: rotate(-5deg);
            -ms-transform: rotate(-5deg);
            -o-transform: rotate(-5deg);
            transform: rotate(-5deg);
        }

        /*crumbs*/
        .single_book.crumbs__container {
            margin: 20px 0px 0px 0px;
        }

        .single_book.crumbs__container a,
        .single_book.crumbs__container p {
            margin: 0px 8px 0px 0px;
        }

        /*favaorite_icon*/
        .btn__box .fav__box {
            padding: 14px 13px;
            border: 1px solid rgba(3, 133, 124, 0.2);
            width: 47px;
            height: 49px;
            margin-left: 10px;
            border-radius: 3px;
        }

        .btn__box .fav__box .fa-heart {
            font-size: 20px;
            color: rgb(245, 93, 93);
            cursor: pointer;
            transition: all 0.5s;
        }

        .btn__box .fav__box .fa-heart:hover {
            color: rgb(236, 24, 24);
        }

        @media (max-width: 768px) {
            .btn__box .btn-border-blue  {
                width: 83%;
            }
        }

        @media (max-width: 420px) {
            .tab-inf-books .btn.btn-blue {
                margin-right: unset;
            }

            .btn__box .btn-border-blue {
                width: 82%;
            }

            .btn__box .fav__box {
                margin-left: 13px;
            }
            .img-in-book{
                width: 100%;
            }
        }
        .fotorama__thumb-border {
            border-color: #8E2976 !important;
        }
        iframe{
            max-width: 100%;
        }

    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e($book->book_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">

            <div class="row">
                <?php echo $__env->make('includes.booksearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <?php echo $__env->make('includes.breadcrumb',['wrapper_class'=>'single_book crumbs__container','breadcrumb_link'=>$breadcrumb_link], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="section-row clearfix d-flex">
                <div class="img-in-book">
                    <div class="fotorama" style="box-shadow: 0px 20px 40px rgb(34 34 34 / 18%)"
                         data-nav="thumbs">
                        <a href="1.jpg"> <img src="<?php echo e($book->images->where('is_main',1)->first()->path); ?>"></a>
                        <?php $__currentLoopData = $book->images->where('is_main',0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="1.jpg"> <img src="<?php echo e($image->path); ?>"></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="inf-in-book">
                    <div class='book-info-wrapper'>
                        <div class="">
                            <p class="fs-24"><b><?php echo e($book->book_name); ?></b></p>
                            <p>
                                <span class="d-block">Автор:
                                    <?php $__currentLoopData = $book->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="text-green">
                                            <a href="/author/<?php echo e($author->id); ?>"><?php echo e($author->$name); ?></a><?php if(!$loop->last): ?>,<?php endif; ?>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </span>
                                <span class="d-block">Издатель:
                                    <a target="_blank" href="/publisher/<?php echo e($book->publisher_id); ?>">
                                        <?php echo e($book->publisher?$book->publisher->$name:''); ?>

                                    </a>
                                </span>
                                <?php if($book->translators->count()>0): ?>
                                    <span class="d-block">Аударған:
                                        <?php $__currentLoopData = $book->translators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="text-green">
                                                <a href="/author/<?php echo e($author->id); ?>"><?php echo e($author->$name); ?></a><?php if(!$loop->last): ?>,<?php endif; ?>
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </span>
                                <?php endif; ?>
                                <span class="d-block"><?php echo app('translator')->get('book.serya'); ?>:
                                    <?php $__currentLoopData = $book->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$genres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="text-green">
                                            <a href="/catalog/<?php echo e($genres->genre_id); ?>"><?php echo e($genres->$genre_name); ?><?php if(!$loop->last): ?>,<?php endif; ?></a>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </span>
                            </p>
                            <div class="inf-range text-grey">
                                <div>
                                    <span>
                                        <span>
                                            <?php
                                            if ($book->feedbacks->count() > 0) {
                                                $rating = $book->feedbacks->sum('rating') / $book->feedbacks->count();
                                            } else {
                                                $rating = 0;
                                            }
                                            ?>
                                            <?php for($i=1;$i<=5;$i++): ?>
                                                <?php if($i<=floor($rating)): ?><span class="fa fa-star checked"></span>
                                                <?php else: ?><span class="fa fa-star"></span>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </span> <?php echo e(number_format((float)$rating, 2, '.', '')); ?>

                                    </span>
                                    <span class="count-review text-green">
                                        <a href="#feedbacksection"><?php echo app('translator')->get('book.otzyvov'); ?>(<?php echo e($book->feedbacks->count()); ?>)</a>
                                    </span>
                                </div>
                                <?php if(!is_null($book->fragment_path) && !empty($book->fragment_path)): ?>
                                    <div>
                                        <span>
                                             <a target="_blank" href="/readfragment/<?php echo e($book->book_id); ?>">
                                                 <i class="icons ic-frag"></i><?php echo app('translator')->get('book.fragment'); ?>
                                             </a>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs link-type-books nav-justified">
                        <?php if($book->paperbook_price): ?>
                            <li class="active">
                                <a data-toggle="tab" href="#tabs1">
                                    <?php echo app('translator')->get('book.bumajnaya_kniga'); ?> <br>
                                    <?php echo e($book->paperbook_price?$book->paperbook_price.' ₸':''); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(!is_null($book->ebook_path) && !empty($book->ebook_path)): ?>
                            <li>
                                <a data-toggle="tab" href="#tabs2">
                                    <?php echo app('translator')->get('book.elektronnaya'); ?> <br>
                                    <?php echo e($book->ebook_price?$book->ebook_price.' ₸':''); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(!is_null($book->audio_file) && !empty($book->audio_file)): ?>
                            <li>
                                <a data-toggle="tab" href="#tabs3">
                                    <?php echo app('translator')->get('book.audiokniga'); ?> <br>
                                    <?php echo e($book->audio_price?$book->audio_price.' ₸':''); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="tab-content tab-inf-books nav-prices">
                        <?php if($book->paperbook_price): ?>
                            <div class="tab-pane fade in active" id="tabs1">
                                <?php echo $__env->make('includes.bookinfo',['price'=>$book->paperbook_price ,'sale_percentage'=>$book->sale_percentage,'type' => 'paper','available'=>$book->available,'book_id' => $book->book_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(!is_null($book->ebook_path)): ?>
                            <div class="tab-pane fade in" id="tabs2">
                                <?php echo $__env->make('includes.bookinfo',['price'=>$book->ebook_price ,'sale_percentage'=>$book->sale_percentage,'type' => 'ebook','available'=>$book->available,'book_id' => $book->book_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(!is_null($book->audio_file)): ?>
                            <div class="tab-pane fade in" id="tabs3">
                                <?php echo $__env->make('includes.bookinfo',['price'=>$book->audio_price ,'sale_percentage'=>$book->sale_percentage,'type' => 'audio','available'=>$book->available,'book_id' => $book->book_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="section-row">
                <p class="fs-24 mb-25 title-min"><b><?php echo app('translator')->get('book.annotasya'); ?></b></p>
                <?php echo $book->book_description; ?>

                <!-- uSocial -->
                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                <div class="uSocial-Share" data-pid="2bdc0bdde7a070f8d020683dac35a407" data-type="share" data-options="round-rect,style1,default,absolute,horizontal,size32,eachCounter0,counter0" data-social="vk,fb,mail,twi,ok,telegram" data-mobile="vi,wa,sms"></div>
                <!-- /uSocial -->
            </div>
            <div class="section-row">
                <p class="fs-24 mb-25 title-min"><b><?php echo app('translator')->get('book.informatsya'); ?></b></p>
                <div class="row">
                    <div class="col-md-3 text-grey">
                        <p><?php echo app('translator')->get('book.page_quantity'); ?><span class="text-black"> <?php echo e($book->page_quanity); ?></span></p>
                        <p>ISBN: <span class="text-black"><?php echo e($book->isbn); ?></span></p>
                        <p><?php echo app('translator')->get('book.god_vipuska'); ?><span class="text-black"> <?php echo e($book->year.''.__('book.god')); ?></span>
                        </p>
                    </div>
                    <div class="col-md-3 text-grey">
                        <p>
                            <?php echo app('translator')->get('book.imeyetsya_label'); ?>
                            <span class="text-black">
                                <?php if($book->available): ?><?php echo e(__('book.imeyetsya')); ?> <?php else: ?> <?php echo e(__('book.neimeyetsya')); ?> <?php endif; ?>
                            </span>
                        </p>
                        <p><?php echo app('translator')->get('book.dostavka'); ?><span class="text-black"> <?php echo app('translator')->get('book.dostavka_info'); ?></span></p>
                        <?php if(!is_null($book->cover)): ?>
                            <p><?php echo app('translator')->get('book.oblojka'); ?>
                                <span class="text-black">
                                <?php if($book->cover == 'hard'): ?>
                                        <?php echo app('translator')->get('book.tverdaya'); ?>
                                    <?php elseif($book->cover == 'soft'): ?>
                                        <?php echo app('translator')->get('book.myagkaya'); ?>
                                    <?php elseif($book->cover == 'integral'): ?>
                                        <?php echo app('translator')->get('book.integral'); ?>
                                    <?php endif; ?>
                            </span>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="section-row">
                <p class="fs-24 mb-25"><b><?php echo app('translator')->get('book.s_etoi_knigoi_chitayut'); ?></b></p>
                <div class="slid-books">
                    <?php
                        $collection = collect([]);
                        foreach($book->genres as $genre){
                            foreach($genre->setimchitayut->take(4) as $item){
                                $collection->push($item);
                            }
                        }
                        $unique = $collection->unique('book_name');
                    ?>
                    <?php $__currentLoopData = $unique->values()->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="/book/<?php echo e($item->book_url); ?>">
                            <div class="item-books">
                                <div class="img-book"><img src="<?php echo e($item->main_image()->path); ?>">
                                    <?php if($item->show_badge): ?>
                                        <div class="top-text-books"
                                             style='background: <?php echo e($item->collection["color"]); ?>;color: #fff;'>
                                            <i style='background: url("<?php echo e($item->collection["icon"]); ?>") no-repeat center/11px;
                                                    width: 11px;
                                                    height: 11px;
                                                    margin-right: 3px;
                                                    vertical-align: text-top;' class="icons"></i>
                                            <?php echo e($item->collection["collection_name_".$lang]); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p class="text-grey fs-15">
                                    <?php echo $__env->make('includes.bookauthors',['authors'=>$item->authors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </p>
                                <p><?php echo e($item->book_name); ?></p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="section-row" id="feedbacksection">
                <p class="fs-24 mb-25"><b><?php echo app('translator')->get('book.otzivy'); ?> (<?php echo e($book->feedbacks->count()); ?>)</b></p>
                <div class="row">
                    <div class="col-md-7">
                        <?php if(auth()->guard()->check()): ?>
                            <div class="review-cover">
                                <div class="item-review clearfix">
                                    <div class="img-review">
                                        <img class="img-100" src="<?php echo e(Auth::user()->avatar); ?>"></div>
                                </div>
                                <div class="text-review">
                                    <p class="fs-15 text-grey">
                                        <span><?php echo e(Auth::user()->user_name); ?></span>
                                        <span class="ml-15 add-star-rev">
                                            <b class="text-black"><?php echo app('translator')->get('book.vasha_otsenka'); ?></b>
                                        <span id="star1" onclick="setRating(1)" class="fa fa-star"></span>
                                        <span id="star2" onclick="setRating(2)" class="fa fa-star"></span>
                                        <span id="star3" onclick="setRating(3)" class="fa fa-star"></span>
                                        <span id="star4" onclick="setRating(4)" class="fa fa-star"></span>
                                        <span id="star5" onclick="setRating(5)" class="fa fa-star"></span>
                                    </span>
                                    </p>
                                    <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <form action="/leavefeedback" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="add-review">
                                            <input type="hidden" name="rating" value="">
                                            <input type="hidden" name="book_id" value="<?php echo e($book->book_id); ?>">
                                            <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->user_id); ?>">
                                            <textarea class="form-control textConut" rows="4" placeholder="<?php echo app('translator')->get('book.otzyv_placeholder'); ?>" name="text"></textarea>

                                            <?php $__errorArgs = ['text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <button id="feedbackbtn" class="btn btn-grey-b btn-lg" type="submit">
                                            <?php echo app('translator')->get('book.opublikovat'); ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php else: ?><p><?php echo app('translator')->get('book.voidite_shtobi_ostavit_otziv'); ?></p>
                        <?php endif; ?>
                        <?php $__currentLoopData = $book->feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="review-cover">
                                <div class="item-review clearfix">
                                    <div class="img-review">
                                        <img class="img-100" src="<?php echo e($feedback->user["avatar"]); ?>"></div>
                                </div>
                                <div class="text-review">
                                    <p class="fs-15 text-grey"><span><?php echo e($feedback->user["user_name"]); ?></span>
                                        <span class="ml-15">
                                            <?php for($i=1;$i<=5;$i++): ?>
                                                <?php if($i<=$feedback->rating): ?>
                                                    <span class="fa fa-star checked"></span>
                                                <?php else: ?>
                                                    <span class="fa fa-star"></span>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </span>
                                        <span class="pull-right">
                                            <?php echo e(Carbon::createFromFormat('Y-m-d H:i:s', $feedback->created_at)->format('j').' '.
                                            Helpers::getMonthName(Carbon::createFromFormat('Y-m-d H:i:s', $feedback->created_at)->format('n'))
                                            .', '.Carbon::createFromFormat('Y-m-d H:i:s', $feedback->created_at)->format('H:i')); ?>

                                        </span></p>
                                    <div class="word-break">
                                        <?php echo $feedback->text; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="/js/jquery.toast.min.js"></script>
    <!--<script src="/js/buy.js?v=2"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>

    <script>
        $('.nav-prices').find('.tab-pane:first').addClass('active');

        let feedbackbtn = $('#feedbackbtn');
        $(".textConut").keyup(function () {

            let len = $(this).val().length;
            let counter = $('#count');
            if ($(this).val().length >= 1) {
                counter.css('color', 'unset');
                feedbackbtn.removeClass('btn-grey-b');
                feedbackbtn.addClass('btn-blue');
            } else {
                counter.css('color', 'red');
                feedbackbtn.addClass('btn-grey-b');
                feedbackbtn.removeClass('btn-blue');
            }
            counter.text(len);
        });

        function setRating(rating) {
            $('input[name="rating"]').val(rating);
            for (let i = 1; i <= 5; i++) {
                $('#star' + i).removeClass('checked');
            }

            for (let i = 1; i <= rating; i++) {
                $('#star' + i).addClass('checked');
            }
        }

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
                if (msg.success === true) {
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

        function buynow(type, bookid) {

            if(type=='ebook') {
                bookid = bookid + 'e';
            }
            else if(type=='audio'){
                bookid = bookid + 'a';
            }
            $.ajax({
                method: "POST",
                url: "/addToBasket",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    type: type,
                    book_id: bookid,
                }
            }).done(function (msg) {

                if (msg.success === true) {
                    let count = parseInt($('#shoppingcart_count').text()) + 1;
                    $("#shoppingcart_count").html(count);
                    window.location.href = '/basket';
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
                        $("#heart").addClass('selected');
                        text = 'Успешно добавлен';
                    } else {
                        $("#heart").removeClass('selected');
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
        function readbook_clicked_on_browser() {
            console.log('hj');
            Swal.fire({
                title: '<strong>Электронды немесе аудио кітапты оқу, тыңдау үшін KITAPAL приложениесін жүктеп алыңыз</strong>',
                icon: 'info',
                html:
                    '<a href="https://apps.apple.com/kz/app/kitapal/id1510525545">'+
                            '<img src="/img/icons/btn-app.png">'+
                        '</a>'+
                        '<a href="https://play.google.com/store/apps/details?id=com.buginsoft.kitapal&amp;hl=ru">'+
                            '<img src="/img/icons/btn-and.png">'+
                        '</a>',

                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false,
                focusConfirm: false
            })
        }

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/singleBook.blade.php ENDPATH**/ ?>