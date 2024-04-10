@push('styles')
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        .selected {
            color: red;
        }

        .popup {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 100;
        }
        .popup-bg {
            background: rgba(0, 0, 0, 0.8);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
        .popup-dialog {
            position: relative;
            width: auto;
            margin: .5rem;
            pointer-events: none;
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }
        .popup-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 0.5rem;
            outline: 0;
            padding: 1rem;
        }
        .popup-header, .popup-body {
            padding: 1rem;
        }
        .popup-header {
            display: flex;
            justify-content: flex-end;
        }
        .popup-close {
            background: transparent;
            border: transparent;
            margin: 0;
            display: flex;
        }
        .popup-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 1rem;
        }
        .popup-text p {
            font-size: 1.75rem;
            font-weight: 400;
            line-height: 135%;
        }


        @media (min-width: 576px) {
            .popup-dialog {
                min-height: calc(100% - 3.5rem);
                max-width: 500px;
                margin: 1.75rem auto;
            }
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
@endpush
@extends('layouts.main')
@section('title',__('main.title'))
@section('content')
    @if(\Session::has('success'))
        <script>
            Swal.fire(
                '@lang('status.success')',
                '{{ \Session::get('success') }}',
                'success'
            );
        </script>
    @endif
    @if(\Session::has('error'))
        <script>
            Swal.fire(
                '@lang('status.error')',
                '{{ \Session::get('error') }}',
                'warning'
            );
        </script>
    @endif
    @if (session('status'))
        <script>
            Swal.fire(
                '@lang('status.success')',
                '{{ session('status') }}',
                'success'
            );
        </script>
    @endif
    @if (isset($_GET['paymentstatus']))
        @if($_GET['paymentstatus']==1)
        <script>
            Swal.fire(
                'Успешно оплачен',
                '{{ session('status') }}',
                'success'
            );
        </script>
            @elseif($_GET['paymentstatus']==0)
            <script>
                Swal.fire(
                    'С сожалением сообщаем вам, что ваш  платеж не прошел. Убедитесь, что предоставленная вами платежная информация является точной и актуальной. Если вы по-прежнему испытываете трудности, пожалуйста, не стесняйтесь обращаться к нам за помощью.',
                    '{{ session('status') }}',
                    'error'
                );
            </script>
            @endif
    @endif

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('includes.booksearch')
                <div class="popup" id="work-popup">
                    <div class="popup-bg"></div>
                    <div class="popup-dialog">
                        <div class="popup-content">
                            <div class="popup-header">
                                <button class="popup-close"
                                        onclick="document.getElementById('work-popup').style.display='none'; return false;">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.33398 9.33398L22.6673 22.6673M9.33398 22.6673L22.6673 9.33398" stroke="#A0A0A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="popup-body">
                                <div class="popup-img">
                                    <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M53.5882 7.89419L4.83816 105.394C3.01941 109.163 4.59441 113.691 8.35379 115.51C9.36629 115.997 10.4632 116.26 11.5882 116.269H109.088C113.269 116.232 116.635 112.81 116.598 108.629C116.586 107.508 116.326 106.403 115.838 105.394L67.0882 7.89419C66.4572 6.64549 65.4922 5.59629 64.3005 4.86328C63.1089 4.13027 61.7372 3.74219 60.3382 3.74219C58.9391 3.74219 57.5675 4.13027 56.3758 4.86328C55.1841 5.59629 54.2191 6.64549 53.5882 7.89419Z" fill="#F2A600"/>
                                        <path d="M50.2124 14.7383L4.46243 106.051C2.74681 109.585 4.22806 113.841 7.76243 115.557C8.69056 116.007 9.71243 116.251 10.7437 116.27H102.15C103.079 116.261 103.998 116.069 104.854 115.706C105.709 115.342 106.485 114.813 107.136 114.15C107.787 113.487 108.301 112.702 108.649 111.839C108.997 110.977 109.171 110.055 109.162 109.126C109.152 108.059 108.902 107.008 108.431 106.051L62.7749 14.7383C61.9709 13.0733 60.5388 11.7955 58.7933 11.1855C57.0479 10.5756 55.1317 10.6833 53.4656 11.4852C52.0464 12.1731 50.9004 13.3191 50.2124 14.7383Z" fill="#FFCC32"/>
                                        <path opacity="0.2" d="M60.3382 31.8945C64.6507 31.8945 68.1195 35.3633 67.8382 39.3945L64.6507 84.3945C64.2945 86.7758 62.082 88.4258 59.7007 88.0695C58.7746 87.9332 57.917 87.5022 57.2551 86.8402C56.5931 86.1783 56.162 85.3207 56.0257 84.3945L52.8382 39.3945C52.557 35.3633 56.0257 31.8945 60.3382 31.8945ZM60.3382 91.8945C63.4414 91.8945 65.9632 94.4164 65.9632 97.5195C65.9632 100.623 63.4414 103.145 60.3382 103.145C57.2351 103.145 54.7132 100.623 54.7132 97.5195C54.7132 94.4164 57.2351 91.8945 60.3382 91.8945Z" fill="#424242"/>
                                        <path d="M60.3382 31.8945C64.6507 31.8945 68.1195 35.3633 67.8382 39.3945L64.6507 84.3945C64.2945 86.7758 62.082 88.4258 59.7007 88.0695C58.7746 87.9332 57.917 87.5022 57.2551 86.8402C56.5931 86.1783 56.162 85.3207 56.0257 84.3945L52.8382 39.3945C52.557 35.3633 56.0257 31.8945 60.3382 31.8945Z" fill="url(#paint0_linear_629_3)"/>
                                        <path d="M60.3379 103.145C63.4445 103.145 65.9629 100.626 65.9629 97.5195C65.9629 94.4129 63.4445 91.8945 60.3379 91.8945C57.2313 91.8945 54.7129 94.4129 54.7129 97.5195C54.7129 100.626 57.2313 103.145 60.3379 103.145Z" fill="url(#paint1_linear_629_3)"/>
                                        <path d="M50.2127 21.5815C49.0877 22.9878 30.1502 60.019 30.1502 60.019C30.1502 60.019 28.4627 62.8316 30.8065 64.4253C32.9627 65.9253 34.9315 64.1441 35.7752 62.7378C36.619 61.3316 53.7752 28.144 54.4315 26.5503C54.994 24.7972 54.6002 22.8847 53.4002 21.4878C52.1815 20.3628 50.9627 20.5503 50.2127 21.5815Z" fill="#FFF170"/>
                                        <path d="M29.4004 73.7148C31.109 73.7148 32.4941 72.3297 32.4941 70.6211C32.4941 68.9125 31.109 67.5273 29.4004 67.5273C27.6918 67.5273 26.3066 68.9125 26.3066 70.6211C26.3066 72.3297 27.6918 73.7148 29.4004 73.7148Z" fill="#FFF170"/>
                                        <defs>
                                            <linearGradient id="paint0_linear_629_3" x1="60.3382" y1="30.2539" x2="60.3382" y2="104.026" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#424242"/>
                                                <stop offset="1" stop-color="#212121"/>
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_629_3" x1="60.3379" y1="33.9852" x2="60.3379" y2="107.757" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#424242"/>
                                                <stop offset="1" stop-color="#212121"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="popup-text">
                                    @lang('book.book_warning')
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        setTimeout("document.getElementById('work-popup').style.display='block'", 1000)
                    </script>
                </div>
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

                            {{--                            <h1>--}}
                            {{--                                Сайтта техникалық жұмыстар жүргізілуде. Уақытша қолайсыздықтар үшін кешірім сұраймыз--}}
                            {{--                            </h1>--}}
                            {{--                            <a class="wpp_btn" target="_blank" href="https://wa.me/message/2MZKB4IP5QG2F1"><i--}}
                            {{--                                        class="fab fa-whatsapp"></i>--}}
                            {{--                                <p>Менеджерға жазу</p></a>--}}
                            {{--                            <style>--}}

                            {{--                                .wpp_btn {--}}
                            {{--                                    display: flex;--}}
                            {{--                                    background: #43d854;--}}
                            {{--                                    border-radius: 30px;--}}
                            {{--                                    text-align: center;--}}
                            {{--                                    letter-spacing: 0.01em;--}}
                            {{--                                    color: #ffffff;--}}
                            {{--                                    font-weight: normal;--}}
                            {{--                                    font-size: 21px;--}}
                            {{--                                    line-height: 100%;--}}
                            {{--                                    padding: 15px 25px;--}}
                            {{--                                    -webkit-transition: all ease 0.3s;--}}
                            {{--                                    -o-transition: all ease 0.3s;--}}
                            {{--                                    transition: all ease 0.3s;--}}
                            {{--                                    display: flex;--}}
                            {{--                                    align-items: center;--}}
                            {{--                                    max-width: 345px;--}}
                            {{--                                    margin-top: 10px;--}}
                            {{--                                }--}}
                            {{--                                .wpp_btn:focus,.wpp_btn:active,--}}
                            {{--                                .wpp_btn:hover {--}}
                            {{--                                    color: #ffffff !important;--}}
                            {{--                                    background: #2f9e3f;--}}
                            {{--                                }--}}

                            {{--                                .wpp_btn p {--}}
                            {{--                                    margin: 0 !important;--}}
                            {{--                                }--}}

                            {{--                                .popup__box .fa-whatsapp {--}}
                            {{--                                    color: white;--}}
                            {{--                                    font-size: 28px;--}}
                            {{--                                    margin-right: 10px;--}}
                            {{--                                }--}}

                            {{--                                .popup__box h1 {--}}
                            {{--                                    font-size: 21px !important;--}}
                            {{--                                    line-height: 116% !important;--}}
                            {{--                                }--}}


                            {{--                            </style>--}}
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
                    @foreach($sliders  as $item)
                        @if($item->type == 'book')
                            <a href="/book/{{\App\Models\Book::find($item->book_id)->book_url}}" class="bg-green">
                        @elseif($item->type == 'catalog')
                                    <a href="/catalog/{{$item->catalog_id}}" class="bg-green">
                                        @else
                                            <a href="/collection/{{$item->collection_id}}" class="bg-green">
                        @endif


                            <div class="container">
                                <div class="top-slid">
                                    <div class="main-image">
                                        <img src="{{$item->slider_image}}" alt="">
                                    </div>
                                    <div class="main-image-adap">
                                        <img src="{{$item->adaptive_image}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="container">
                    @foreach($collections as $collection )
                        @if($collection->books->count())


                            <!--Нижний слайдер с книгами-->
                            @if($loop->iteration==2)
                                @if($bottom_sliders)
                                    @foreach($bottom_sliders as $slider)
                                        <div class="section-row">
                                            <div class="bg-white-pink">
                                                <div class="offer__book">
                                                    <div class="offer__book_img">
                                                        <img src="{{$slider->book->main_image()->path}}" alt="">
                                                    </div>
                                                    <div class="offer__book_text">
                                                        <h2>{{$slider->book->book_name}}</h2>
                                                        <div class="offer__book_author_category">
                                                            <p>Автор:
                                                                @foreach($slider->book->authors as $author)
                                                                    <span class="text-green">
                                                                        <a href="/author/{{$author->id}}">{{$author["name_$lang"]}}</a>@if(!$loop->last),@endif
                                                                    </span>
                                                                @endforeach
                                                            </p>

                                                            <p>@lang('book.serya'):
                                                                @foreach($slider->book->genres as $genres)
                                                                    <span class="text-green">
                                                                        <a href="/catalog/{{$genres->genre_id}}">{{$genres["genre_name_$lang"]}}@if(!$loop->last),@endif</a>
                                                                    </span>
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                        <div class="offer__book_annotation">
                                                            <h3>@lang('book.annotasya')</h3>
                                                            <hr>
                                                            {!! $slider->book->book_description !!}
                                                        </div>
                                                        <div class="offer__book_price">
                                                            <h2>
                                                                {{($slider->book->sale_percentage>0)?number_format(round($slider->book->paperbook_price*(100-$slider->book->sale_percentage)/100), 0, '', ' '):number_format($slider->book->paperbook_price, 0, '', ' ')}}₸
                                                            </h2>
                                                            <div class="offer__book_price_btns">
                                                                <button class="offer__book_buy_btn" onclick="buynow('paper',{{$slider->book->book_id}})">
                                                                    @lang('book.buy_now')
                                                                </button>
                                                                <button class="offer__book_addToCart_btn" onclick="buy('paper',{{$slider->book->book_id}})">
                                                                    <img src="../img/icons/addToCart-icon.svg" alt="">
                                                                    @lang('book.to_cart')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                            <!----------------------------------------------------------------------------------------->
                            @if(isset($collection->banner_url))
                                <div class="section-row">
                                    <a href="{{ $collection->banner_url }}">
                                        <img style="max-height: 100px;width: 100%;object-fit: cover;"
                                             src="{{$collection->banner_image}}" alt="Изображение">
                                    </a>
                                </div>
                            @endif

                            <div class="section-row">
                                <p class="big-title">
                                    <a style="color:unset" href="/collection/{{$collection->collection_id}}">{{$collection["collection_name_$lang"]}}</a>
                                </p>
                                <div class="slid-books">
                                    @php
                                        if($collection->collection_id==12){
                                            $collection_books=$collection->books()->with(['authors','main_image2'])->orderBy('created_at','desc')->take(15)->get();
                                        }
                                        else{
                                            $collection_books=$collection->books()->with(['authors','main_image2'])->inRandomOrder()->take(15)->get();
                                        }
                                    @endphp
                                    @foreach($collection_books as $item)
                                        <div class="slide-main-books" style="z-index: -111;width: 194px;position:relative;">
                                            <a href="/book/{{$item->book_url}}" style="z-index: -111;">
                                                <div class="item-books">
                                                    <div class="img-book">
                                                        @if($item->main_image2->first())
                                                            <img src="{{$item->main_image2->first()->thumbnail180_250?$item->main_image2->first()->thumbnail180_250:$item->main_image2->first()->path}}">
                                                        @endif
                                                        @if($collection->show_badge)
                                                            <div style='background: {{$collection->color}};color: #fff;' class="top-text-books">
                                                                <i style='background: url("{{$collection->icon}}") no-repeat center/11px;
                                                                        width: 11px;
                                                                        height: 11px;
                                                                        margin-right: 3px;
                                                                        vertical-align: text-top;' class="icons"></i>{{$collection["collection_name_$lang"]}}
                                                            </div>
                                                        @endif
                                                        <div class="opacity-img"></div>
                                                    </div>
                                                    <span>{{$item->paperbook_price*((100-$item->sale_percentage)/100)}} тг</span>
                                                    @if($item->sale_percentage>0)
                                                        <span class="old-price" style="z-index: 999;">{{$item->paperbook_price}} ₸</span>
                                                    @endif
                                                    <p class="text-grey fs-15">
                                                        @include('includes.bookauthors',['authors'=>$item->authors])
                                                    </p>
                                                    <p class="description__text">{{$item->book_name}}</p>
                                                    @if($item->subscribable)
                                                        <h4 class="text-pro-purple">@lang('main.subscribe')</h4>
                                                    @else
                                                        <h4 class="text-pro-green">@lang('main.buy')</h4>
                                                    @endif
                                                </div>
                                            </a>
                                            @if($item->available)
                                                <span onclick="buy('paper',{{$item->book_id}})" class="item-bag">+ Добавить в корзину</span>
                                            @endif

                                            <span class="item-bag chosen" onclick="addToSelected({{$item->book_id}})">
                                                <i id="heart{{$item->book_id}}"
                                                   class="@if(\Auth::user() && $item->selected->where('user_id',\Auth::user()->user_id)->first()) selected @endif fas fa-heart"></i>
                                            </span>
                                            <span class="item-bag text">
                                                 <p id="heart_text{{$item->book_id}}">
                                                     {{(\Auth::user() && $item->selected->where('user_id',\Auth::user()->user_id)->first())?'Удалить из избранного':' Добавить в избранное'}}
                                                 </p>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="section-row">
                        <p class="big-title">@lang('main.articles_title')
                            <span class="pull-right">
                                <a class="text-green" href="/articles">@lang('main.all_articles')
                                    <i class="icons ic-arrow-r"></i></a>
                            </span>
                        </p>
                        <div class="row">
                            @foreach($articles as $article)
                                <div class="col-md-3 col-sm-6">
                                    <a href="/article/{{$article['id']}}">
                                        <div class="item-article">
                                            <img src="{{$article['image']}}">
                                            <div class="text-article">
                                                <p class="block__title">{{$article["title_$lang"]}}</p>
                                                <p class="fs-15 text-grey">{!! $article["short_text_$lang"] !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="section-row">
                        <div class="bg-black-grey">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="big-title">@lang('main.prilozhenie_kokzhiek')</p>
                                    <p class="max-w-420">@lang('main.teper_u_vas_est_vozm')</p>
                                    <button class="btn btn-grey"
                                            onclick="window.location.href='https://apps.apple.com/kz/app/kitapal/id1510525545'">
                                        <i class="icons ic-app"></i>
                                        @lang('main.appstore')
                                    </button>
                                    <button class="btn btn-grey"
                                            onclick="window.location.href='https://play.google.com/store/apps/details?id=com.buginsoft.kitapal&hl=ru'">
                                        <i class="icons ic-and"></i>
                                        @lang('main.playmarket')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
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
                        heading: '{{__('status.success')}}',
                        text: text,
                        bgColor: '#8E2976',
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                    $("#heart_text" + bookid).text(hinttext);
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
    </script>

@endpush
