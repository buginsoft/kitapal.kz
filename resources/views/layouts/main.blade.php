@php
    $genres = App\Models\Genre::where('showonheader',1)->get();
    $genresonsidemenu = App\Models\Genre::where('showonheader',0)->get();
    use Harimayco\Menu\Facades\Menu;
    //$lang=app()->getLocale();

    if($lang=='ru'){
        $menuList = Menu::getByName('Меню в футере');
        $topMenu = Menu::getByName('Меню в шапке');
    }
    else{
        $menuList = Menu::getByName('Меню в футере(kz)');
        $topMenu = Menu::getByName('Меню в шапке(kz)');
    }
@endphp
<!DOCTYPE html>
<html>
<head>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(73231075, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/73231075" style="position:absolute; left:-9999px;" alt="" /></div></noscript>


    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '681879809149022');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=681879809149022&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177390378-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-177390378-1');
    </script>



    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8098WYQG94"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8098WYQG94');
    </script>

    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="h1ohf4r0blp1eqiku211gbr149zw8k" />
    @yield('meta')
    <link rel="stylesheet" href="/css/libs.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <script src="/js/lib.min.js"></script>
    <link rel="stylesheet" href="/css/main.css?v=70">
    <link rel="icon" href="/favicon2.ico" type="image/x-icon">
    <style>
        /****** LOGIN MODAL ******/
        .loginmodal-container {
            padding: 30px;
            /*max-width: 350px;*/
            width: 100% !important;
            background-color: white;
            margin: 0 auto;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            font-family: "SFProDisplay-Regular";
            border-radius: 5px;
        }

        .loginmodal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .grecaptcha-badge {
            display: none;
        }

        .loginmodal-head .close {
            font-size: 34px;
            opacity: .8;
        }

        .modal-open .modal {
            padding-top: 150px;
        }

        .loginmodal-container h1 {
            margin-top: 0;
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            margin-bottom: 0;
            font-family: "SFProDisplay-Regular";
        }

        .loginmodal-container input[type=submit] {
            width: 100%;
            display: block;
            position: relative;
        }

        .loginmodal-container input[type=text], input[type=password], textarea {
            height: 44px;
            border: 1px solid #eee;
            font-size: 16px;
            width: 100%;
            margin-bottom: 10px;
            -webkit-appearance: none;
            background: #fff;
            /* border-radius: 2px; */
            padding: 5px 15px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            border-radius: 4px;
            font-family: "SFProDisplay-Regular";
        }

        .loginmodal-container input[type=text]:hover, input[type=password]:hover {
            border: 1px solid #eee;
            -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .loginmodal-container textarea {
            height: 100px;
        }

        .loginmodal {
            text-align: center;
            font-size: 14px;
            font-family: "SFProDisplay-Regular";
            font-weight: 700;
            height: 36px;
            padding: 0 8px;
            /* border-radius: 3px; */
            /* -webkit-user-select: none;
              user-select: none; */
        }

        .loginmodal-submit {
            /* border: 1px solid #3079ed; */
            border: none;
            color: white;
            text-shadow: 0 1px rgba(0, 0, 0, 0.1);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%), #8E2976;
            padding: 13px;
            font-family: "SFProDisplay-Regular";
            font-size: 14px;
            text-transform: uppercase;
            text-align: center;
            /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
        }

        .loginmodal-submit:hover {
            /* border: 1px solid #2f5bb7; */
            border: 0px;
            color: white;
            text-shadow: 0 1px rgba(0, 0, 0, 0.3);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%), #8E2976;
            /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
        }

        .loginmodal-container a {
            text-decoration: none;
            color: #666;
            font-weight: 400;
            text-align: center;
            display: inline-block;
            opacity: 0.6;
            transition: opacity ease 0.5s;
        }

        .icons.tel {
            width: 50px;
            height: 38px;
            border: 1px solid #EEEEEE;
            border-radius: 4px;
            margin-left: 10px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .icons.tel:hover {
            color: #8E2976;
        }

        .icons.tel button {
            border: unset;
            width: 100%;
            height: 100%;
            outline: none;
            background-color: unset;
            color: #8E2976;
        }

        .icons.tel button:focus {
            outline: none;
        }

        .icons.tel button:active {
            outline: none;
        }

        @media (max-width: 991px) {
            .icons.tel {
                width: 40px;
                height: 30px;
            }
        }


        .icons-top {
            display: flex;
            align-items: center;
        }

        .login-help {
            font-size: 12px;
        }

        /*MODAL*/
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 15; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            -ms-overflow-style: none;
        }

        .modal::-webkit-scrollbar {
            width: 0;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 5px 20px 20px 20px;
            border: 1px solid #888;
            width: 100%;
            max-width: 300px;
            display: flex;
            flex-direction: column;
        }

        .modal-content .close:hover {
            background-color: unset;

        }

        .modal-content .close {
            text-align: end;
            color: #646464 !important;
            margin-bottom: 3px;
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal__content {
            display: flex;
            flex-direction: column;
            color: #000;
            justify-content: center;

        }

        .modal__content span {
            color: #000000;
            margin-left: 5px;
        }

        .modal__content a i {
            margin-right: 10px;
            font-size: 15px;
        }

        .modal__content a {
            margin-bottom: 1px;
            font-size: 18px;

        }

        .modal__content a:hover {

        }

        .modal__content a:last-child {
            margin-bottom: 0;
        }
        .contact_modal p{
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
    <script src="/js/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <link rel="stylesheet" href="/css/sweetalert2.min.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166316185-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-166316185-1');
    </script>

    @stack('styles')
    {!! htmlScriptTagJsApi() !!}
</head>
<body>
<a href="https://kitapal.kz/buy-subscription" class="header-banner">
    <img src="/images/kitapal-head-banner-1360х60.png" alt="" class="img-header-banner_desktop">
    <img src="/images/kitapal-head-banner-360х60.png" alt="" class="img-header-banner_mobile">
</a>
<div class="header">
    <div class="container">
        <div class="clearfix top-header">
            <div class="left-header">
                <form action="/search" method="get">
                    <a href="/">
                        <img class="img-logo" src="/img/logo/kitapal-logo-NEW-PNG.png">
                    </a>
                    <input class="search-top hidden-sm hidden-xs" type="text" name="search"
                           placeholder="@lang('main.searchplaceholder')">
                </form>
            </div>
            <div class="right-header">
                <div class="lang-i hidden-sm hidden-xs">
                    <a {{ ($lang=='ru')?'class=active':'' }} href="{{ url('locale/ru') }}">рус</a>
                    <a {{ ($lang=='kz')?'class=active':'' }} href="{{ url('locale/kz') }}">қаз</a></div>
                <div class="icons-top">
                    <a href="/page/20"><i class="icons"><img src="/img/icons/map.svg" alt="" class="map-icon"></i></a>
                    <div class="icons tel">


                        <button id="myBtn">
                            <i class="fas fa-phone"> </i>
                        </button>

                        <!-- The Modal -->
                        <div id="myModal" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div class="modal__content contact_modal">
                                    {!! \DB::table('contact')->first()->contact2!!}
                                </div>
                            </div>

                        </div>
                    </div>

                    <a href="https://api.whatsapp.com/send?phone={{$contacts->phone}}"><i class="icons ic-whatsapp"></i></a>
                    <a href="mailto:{{$contacts->email}}"><i class="icons ic-message"></i></a>

                    <a href="/basket"><i class="icons ic-shops">
                            <span id="shoppingcart_count" class="ic-nof">
                                @auth
                                    {{\Cart::session(\Auth::user()->user_id)->getTotalQuantity()}}
                                @else
                                    {{\Cart::session(session()->getId())->getTotalQuantity()}}
                                @endauth
                            </span></i></a>
                    <a href="@auth /profile @else /login @endauth"><i class="icons ic-user"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="bottam-header">
        <nav class="navbar menu">
            <div class="container d-flex">
                <div class="navbar-header">
                    <div class="lang-i visible-xs visible-sm pull-right">
                        <a {{($lang=='ru')?'class=active':'' }} href="{{ url('locale/ru') }}">рус</a>
                        <a {{ ($lang=='kz')?'class=active':'' }} href="{{ url('locale/kz') }}">қаз</a>
                    </div>
                    <span class="dropdown navbar-brand">
                        <a class="dropdown dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="icons ic-menu"></i>@lang('main.menu')
                        </a>
                <ul class="dropdown-menu dropdownFull">

                  <div class="visible-xs in-menu-li">
                   @foreach($genres as $item)
                          <li class="active">
                              <a href="/catalog/{{$item->genre_id}}">
                                  {{ $item["genre_name_$lang"]}}
                              </a>
                          </li>
                      @endforeach
                  </div>
                    @if($topMenu)
                        @foreach($topMenu as $item)
                            <li><a href="{{$item['link'] }}">{{ $item['label'] }}</a></li>
                        @endforeach
                        @foreach($genresonsidemenu as $item)
                            <li>
                                    <a href="/catalog/{{$item->genre_id}}">
                                        {{ (app()->getLocale()=='ru')?$item->genre_name_ru:$item->genre_name_kz }}
                                    </a>
                                </li>
                        @endforeach
                    @endif
                </ul></span>
                </div>
                <div class="collapse navbar-collapse menu-li" id="alignment-example">
                    <ul class="nav navbar-nav">
                        @foreach($genres as $item)
                            <li class="active">
                                <a href="/catalog/{{$item->genre_id}}">
                                    {{ (app()->getLocale()=='ru')?$item->genre_name_ru:$item->genre_name_kz }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
@yield('content')
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <div class="loginmodal-head">
                <h1>@if($lang=='kz') Кері байланыс @else Обратная связь@endif </h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="error">
            </div>
            <form id="contact" method="post" action="/sendMessage">
                @csrf
                <input type="hidden" name="recaptcha" id="recaptcha" value="45">
                <input id="fio" type="text" name="name" placeholder="@lang('Profile.fio')"
                       value="{{(Auth::check())?\Auth::user()->user_name:''}}">
                <input id="email" type="text" name="email" placeholder="Email"
                       value="{{(Auth::check())?\Auth::user()->email:''}}">
                <input id="phone" type="text" name="phone" placeholder="@lang('Profile.phone')"
                       value="{{(Auth::check())?\Auth::user()->phone:''}}">
                <textarea id="text" name="problem_text"
                          placeholder="{{ (app()->getLocale()=='ru')?'Опишите вашу проблему...':'Мәселеңізді сипаттаңыз ...' }}"></textarea>
                <input type="submit" name="login" class="btn btn-border-blue login loginmodal-submit"
                       value="@lang('main.send')">
            </form>
        </div>
    </div>
</div>

<!-- Messenger Плагин чата Code -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml : true,
            version : 'v10.0'
        });
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/ru_RU/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Your Плагин чата code -->
<div class="fb-customerchat" attribution="page_inbox" page_id="596542790682234"></div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6"><a href=""><img class="logo-footer" src="/img/logo/kitapal-logo-NEW-PNG.png"></a>
                <div class="row visible-xs">
                    @if($menuList)
                        @foreach(array_chunk($menuList,5) as $key4=>$menu)
                            <div class="col-xs-6">
                                <ul>
                                    @foreach($menu as $key3=>$item)
                                        <li><a href="{{$item['link'] }}">{{ $item['label'] }}</a></li>
                                        @if($key4==1 && $key3==(count($menu)-1))
                                            <li><a href="#" data-toggle="modal" data-target="#login-modal">
                                                    @if($lang=='kz') Кері байланыс @else Обратная связь@endif
                                                </a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
                <p>@lang('main.internet_duken')<span class="d-block">@lang('main.copyright')</span></p>
                <p>@lang('main.download_app_title')</p>
                <div class="btn-mob">
                    <a href="https://apps.apple.com/kz/app/kitapal/id1510525545">
                        <img src="/img/icons/btn-app.png">
                    </a>
                    <a href="https://play.google.com/store/apps/details?id=com.buginsoft.kitapal&hl=ru">
                        <img src="/img/icons/btn-and.png">
                    </a>
                </div>
            </div>
            <div class="col-md-5 col-sm-6">
                <div class="row hidden-xs">
                    @if($menuList)
                        @foreach(array_chunk($menuList,5) as $key=>$menu)
                            <div class="col-xs-6">
                                <ul>
                                    @foreach($menu as $key2=>$item)
                                        <li><a href="{{$item['link'] }}">{{ $item['label'] }}</a></li>
                                        @if($key==1 && $key2==(count($menu)-1))
                                            <li><a href="#" data-toggle="modal" data-target="#login-modal">
                                                    @if($lang=='kz') Кері байланыс @else Обратная связь@endif
                                                </a></li>
                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="row" style="margin-bottom: 20px;">
                    <a href="https://www.instagram.com/kitapal.kz/" class="" style="margin-left: 10px"><img src="/img/icons/ic-footer-ig.svg" alt=""></a>
                    <a href="https://www.facebook.com/kitapal.kz" class="" style="margin-left: 10px"><img src="/img/icons/ic-footer-fb.svg" alt=""></a>
                    <a href="https://t.me/kitapall" class="" style="margin-left: 10px"><img src="/img/icons/ic-footer-tg.svg" alt=""></a>

                </div>
                <!-- Yandex.Metrika informer -->
                <a href="https://metrika.yandex.kz/stat/?id=73231075&amp;from=informer"
                   target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/73231075/3_1_FFFFFFFF_FFFFFFFF_0_pageviews"
                                                       style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="73231075" data-lang="ru" /></a>
                <!-- /Yandex.Metrika informer -->
            </div>
        </div>
        <div class="clearfix">
            <p class="pull-right bg-box">
                {{ (app()->getLocale()=='ru')?'Разработка книжного интернет-магазина':'Кітап интернет-дүкенін әзірлеу' }}
                - <a title="Создание книжного интернет магазина" href="http://buginsoft.kz/"><img
                            src="/img/logo/logo-bg.svg"></a>

            </p>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('{{ config('services.recaptcha.sitekey') }}', {action: 'contact'}).then(function (token) {
            if (token) {
                document.getElementById('recaptcha').value = token;
            }
        });
    });
</script>

<script src="/js/common.js?v=4"></script>
<script src="/js/masking-input.js" data-autoinit="true"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->


<script>

    $("#phonemain").inputmask({"mask": "9(999) 999-9999"});

    $("form#contact").submit(function (event) {
        event.preventDefault();
        var fio = $("#fio").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var text = $("#text").val();
        var recaptcha = $("#recaptcha").val();


        $.ajax({
            type: "POST",
            url: "/sendMessage",
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: "name=" + fio + "&phone=" + phone + "&email=" + email + "&problem_text=" + text + "&recaptcha=" + recaptcha,
            success: function (msg) {
                console.log(msg);
                if (msg.success) {
                    Swal.fire(
                        'Успешно',
                        '{!! \Session::get('success') !!}',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            document.getElementById('login-modal').click();
                        }
                    });
                } else {
                    $('#error').html('<div id="error" class="alert alert-danger">' + msg.errors + '</div>');
                }
            }
        });
    });

    /*Modal*/

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>
<!-- /Yandex.Metrika counter -->
@stack("scripts")
@include('includes.notify')
</body>
</html>
