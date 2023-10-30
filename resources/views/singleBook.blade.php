<?php
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Helpers;
$lang = app()->getLocale();
$name = 'name_' . $lang;

?>
@extends('layouts.main')
@section('meta')
    <meta property="og:title" content="{{$book->book_name}}"/>
    <meta property="og:description" content="{{ Str::limit(substr($book->book_description, 3,-4), 20)}}"/>
    <meta property="og:image" content="https://kitapal.kz{{$book->main_image()->path}}"/>
    <meta property="vk:image" content="https://kitapal.kz{{$book->main_image()->path}}"/>

@endsection
@push('styles')
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
@endpush
@section('title')
    {{$book->book_name}}
@endsection
@section('content')
    <div class="content">
        <div class="container">

            <div class="row">
                @include('includes.booksearch')
            </div>

            @include('includes.breadcrumb',['wrapper_class'=>'single_book crumbs__container','breadcrumb_link'=>$breadcrumb_link])

            <div class="section-row clearfix d-flex">
                <div class="img-in-book">
                    <div class="fotorama" style="box-shadow: 0px 20px 40px rgb(34 34 34 / 18%)"
                         data-nav="thumbs">
                        <a href="1.jpg"> <img src="{{$book->images->where('is_main',1)->first()->path}}"></a>
                        @foreach($book->images->where('is_main',0) as $image)
                            <a href="1.jpg"> <img src="{{$image->path}}"></a>
                        @endforeach
                    </div>
                </div>
                <div class="inf-in-book">
                    <div class='book-info-wrapper'>
                        <div class="">
                            <p class="fs-24"><b>{{$book->book_name}}</b></p>
                            <p>
                                <span class="d-block">Автор:
                                    @foreach($book->authors as $author)
                                        <span class="text-green">
                                            <a href="/author/{{$author->id}}">{{$author->$name}}</a>@if(!$loop->last),@endif
                                        </span>
                                    @endforeach
                                </span>
                                <span class="d-block">Издатель:
                                    <a target="_blank" href="/publisher/{{$book->publisher_id}}">
                                        {{$book->publisher?$book->publisher->$name:''}}
                                    </a>
                                </span>
                                @if($book->translators->count()>0)
                                    <span class="d-block">Аударған:
                                        @foreach($book->translators as $author)
                                            <span class="text-green">
                                                <a href="/author/{{$author->id}}">{{$author->$name}}</a>@if(!$loop->last),@endif
                                            </span>
                                        @endforeach
                                    </span>
                                @endif
                                <span class="d-block">@lang('book.serya'):
                                    @foreach($book->genres as $key=>$genres)
                                        <span class="text-green">
                                            <a href="/catalog/{{$genres->genre_id}}">{{$genres->$genre_name}}@if(!$loop->last),@endif</a>
                                        </span>
                                    @endforeach
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
                                            @for($i=1;$i<=5;$i++)
                                                @if($i<=floor($rating))<span class="fa fa-star checked"></span>
                                                @else<span class="fa fa-star"></span>
                                                @endif
                                            @endfor
                                        </span> {{number_format((float)$rating, 2, '.', '')}}
                                    </span>
                                    <span class="count-review text-green">
                                        <a href="#feedbacksection">@lang('book.otzyvov')({{$book->feedbacks->count()}})</a>
                                    </span>
                                </div>
                                @if(!is_null($book->fragment_path) && !empty($book->fragment_path))
                                    <div>
                                        <span>
                                             <a target="_blank" href="/readfragment/{{$book->book_id}}">
                                                 <i class="icons ic-frag"></i>@lang('book.fragment')
                                             </a>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs link-type-books nav-justified">
                        @if($book->paperbook_price)
                            <li class="active">
                                <a data-toggle="tab" href="#tabs1">
                                    @lang('book.bumajnaya_kniga') <br>
                                    {{ $book->paperbook_price?$book->paperbook_price.' ₸':'' }}
                                </a>
                            </li>
                        @endif
                        @if(!is_null($book->ebook_path) && !empty($book->ebook_path))
                            <li>
                                <a data-toggle="tab" href="#tabs2">
                                    @lang('book.elektronnaya') <br>
                                    {{ $book->ebook_price?$book->ebook_price.' ₸':'' }}
                                </a>
                            </li>
                        @endif
                        @if(!is_null($book->audio_file) && !empty($book->audio_file))
                            <li>
                                <a data-toggle="tab" href="#tabs3">
                                    @lang('book.audiokniga') <br>
                                    {{ $book->audio_price?$book->audio_price.' ₸':'' }}
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content tab-inf-books nav-prices">
                        @if($book->paperbook_price)
                            <div class="tab-pane fade in active" id="tabs1">
                                @include('includes.bookinfo',['price'=>$book->paperbook_price ,'sale_percentage'=>$book->sale_percentage,'type' => 'paper','available'=>$book->available,'book_id' => $book->book_id])
                            </div>
                        @endif
                        @if(!is_null($book->ebook_path))
                            <div class="tab-pane fade in" id="tabs2">
                                @include('includes.bookinfo',['price'=>$book->ebook_price ,'sale_percentage'=>$book->sale_percentage,'type' => 'ebook','available'=>$book->available,'book_id' => $book->book_id])
                            </div>
                        @endif
                        @if(!is_null($book->audio_file))
                            <div class="tab-pane fade in" id="tabs3">
                                @include('includes.bookinfo',['price'=>$book->audio_price ,'sale_percentage'=>$book->sale_percentage,'type' => 'audio','available'=>$book->available,'book_id' => $book->book_id])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="section-row">
                <p class="fs-24 mb-25 title-min"><b>@lang('book.annotasya')</b></p>
                {!! $book->book_description !!}
                <!-- uSocial -->
                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                <div class="uSocial-Share" data-pid="2bdc0bdde7a070f8d020683dac35a407" data-type="share" data-options="round-rect,style1,default,absolute,horizontal,size32,eachCounter0,counter0" data-social="vk,fb,mail,twi,ok,telegram" data-mobile="vi,wa,sms"></div>
                <!-- /uSocial -->
            </div>
            <div class="section-row">
                <p class="fs-24 mb-25 title-min"><b>@lang('book.informatsya')</b></p>
                <div class="row">
                    <div class="col-md-3 text-grey">
                        <p>@lang('book.page_quantity')<span class="text-black"> {{$book->page_quanity}}</span></p>
                        <p>ISBN: <span class="text-black">{{$book->isbn}}</span></p>
                        <p>@lang('book.god_vipuska')<span class="text-black"> {{$book->year.''.__('book.god')}}</span>
                        </p>
                    </div>
                    <div class="col-md-3 text-grey">
                        <p>
                            @lang('book.imeyetsya_label')
                            <span class="text-black">
                                @if($book->available){{__('book.imeyetsya')}} @else {{__('book.neimeyetsya')}} @endif
                            </span>
                        </p>
                        <p>@lang('book.dostavka')<span class="text-black"> @lang('book.dostavka_info')</span></p>
                        @if(!is_null($book->cover))
                            <p>@lang('book.oblojka')
                                <span class="text-black">
                                @if($book->cover == 'hard')
                                        @lang('book.tverdaya')
                                    @elseif($book->cover == 'soft')
                                        @lang('book.myagkaya')
                                    @elseif($book->cover == 'integral')
                                        @lang('book.integral')
                                    @endif
                            </span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="section-row">
                <p class="fs-24 mb-25"><b>@lang('book.s_etoi_knigoi_chitayut')</b></p>
                <div class="slid-books">
                    @php
                        $collection = collect([]);
                        foreach($book->genres as $genre){
                            foreach($genre->setimchitayut->take(4) as $item){
                                $collection->push($item);
                            }
                        }
                        $unique = $collection->unique('book_name');
                    @endphp
                    @foreach($unique->values()->all() as $item)
                        <a href="/book/{{$item->book_url}}">
                            <div class="item-books">
                                <div class="img-book"><img src="{{$item->main_image()->path}}">
                                    @if($item->show_badge)
                                        <div class="top-text-books"
                                             style='background: {{$item->collection["color"]}};color: #fff;'>
                                            <i style='background: url("{{$item->collection["icon"]}}") no-repeat center/11px;
                                                    width: 11px;
                                                    height: 11px;
                                                    margin-right: 3px;
                                                    vertical-align: text-top;' class="icons"></i>
                                            {{$item->collection["collection_name_".$lang]}}
                                        </div>
                                    @endif
                                </div>
                                <p class="text-grey fs-15">
                                    @include('includes.bookauthors',['authors'=>$item->authors])
                                </p>
                                <p>{{$item->book_name}}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="section-row" id="feedbacksection">
                <p class="fs-24 mb-25"><b>@lang('book.otzivy') ({{$book->feedbacks->count()}})</b></p>
                <div class="row">
                    <div class="col-md-7">
                        @auth
                            <div class="review-cover">
                                <div class="item-review clearfix">
                                    <div class="img-review">
                                        <img class="img-100" src="{{Auth::user()->avatar}}"></div>
                                </div>
                                <div class="text-review">
                                    <p class="fs-15 text-grey">
                                        <span>{{Auth::user()->user_name}}</span>
                                        <span class="ml-15 add-star-rev">
                                            <b class="text-black">@lang('book.vasha_otsenka')</b>
                                        <span id="star1" onclick="setRating(1)" class="fa fa-star"></span>
                                        <span id="star2" onclick="setRating(2)" class="fa fa-star"></span>
                                        <span id="star3" onclick="setRating(3)" class="fa fa-star"></span>
                                        <span id="star4" onclick="setRating(4)" class="fa fa-star"></span>
                                        <span id="star5" onclick="setRating(5)" class="fa fa-star"></span>
                                    </span>
                                    </p>
                                    @error('rating')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <form action="/leavefeedback" method="post">
                                        @csrf
                                        <div class="add-review">
                                            <input type="hidden" name="rating" value="">
                                            <input type="hidden" name="book_id" value="{{$book->book_id}}">
                                            <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
                                            <textarea class="form-control textConut" rows="4" placeholder="@lang('book.otzyv_placeholder')" name="text"></textarea>

                                            @error('text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <button id="feedbackbtn" class="btn btn-grey-b btn-lg" type="submit">
                                            @lang('book.opublikovat')
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else<p>@lang('book.voidite_shtobi_ostavit_otziv')</p>
                        @endauth
                        @foreach($book->feedbacks as $feedback)
                            <div class="review-cover">
                                <div class="item-review clearfix">
                                    <div class="img-review">
                                        <img class="img-100" src="{{$feedback->user["avatar"]}}"></div>
                                </div>
                                <div class="text-review">
                                    <p class="fs-15 text-grey"><span>{{$feedback->user["user_name"]}}</span>
                                        <span class="ml-15">
                                            @for($i=1;$i<=5;$i++)
                                                @if($i<=$feedback->rating)
                                                    <span class="fa fa-star checked"></span>
                                                @else
                                                    <span class="fa fa-star"></span>
                                                @endif
                                            @endfor
                                        </span>
                                        <span class="pull-right">
                                            {{Carbon::createFromFormat('Y-m-d H:i:s', $feedback->created_at)->format('j').' '.
                                            Helpers::getMonthName(Carbon::createFromFormat('Y-m-d H:i:s', $feedback->created_at)->format('n'))
                                            .', '.Carbon::createFromFormat('Y-m-d H:i:s', $feedback->created_at)->format('H:i')}}
                                        </span></p>
                                    <div class="word-break">
                                        {!! $feedback->text !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
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
                        heading: '{{__('status.success')}}',
                        text: '{{__('book.buysuccesstext')}}',
                        bgColor: '#8E2976',
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                } else {
                    Swal.fire({
                        title: '@lang('book.buyerrortitle')',
                        icon: 'info',
                        html: '@lang('book.buyerror')',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> @lang('basket.button')!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText:
                            '<i class="fa fa-thumbs-down"></i>@lang('book.continue')',
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
                        title: '@lang('book.buyerrortitle')',
                        icon: 'info',
                        html: '@lang('book.buyerror')',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> @lang('basket.button')!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText: '<i class="fa fa-thumbs-down"></i>@lang('book.continue')',
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
                        heading: '{{__('status.success')}}',
                        text: text,
                        bgColor: '#8E2976',
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                } else {
                    Swal.fire({
                        title: '@lang('book.buyerrortitle')',
                        icon: 'info',
                        html: '@lang('book.buyerror')',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> @lang('basket.button')!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText: '<i class="fa fa-thumbs-down"></i>@lang('book.continue')',
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
@endpush
