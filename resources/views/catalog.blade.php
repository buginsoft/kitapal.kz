@extends('layouts.main')
@php
    $lang=App::getLocale();
    $name='name_'.$lang;
@endphp
@push('styles')
    <link rel="stylesheet" href="/css/bootstrap_select/bootstrap-select.min.css">
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/filter.css?v=33">
    <style>
    </style>
@endpush
@section('title',$genre['genre_name_'.$lang])
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                @include('includes.booksearch')
            </div>
            <div class="section-row">
                @include('includes.breadcrumb',['wrapper_class'=>'crumbs__container','breadcrumb_link'=>$genre['genre_name_'.$lang]])

                <h1 class="big-title filter">{{$genre['genre_name_'.$lang]}}</h1>

                <section class="catalog__filter">
                    <div class="container">
                        <div class="back">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form method="get" action="" id="filter">
                                            <div class="fiter_box d-flex justify-content-center aling-items-center">
                                                <div class="input_select_box d-flex">
                                                    <div class="sort__box d-flex align-items-center">
                                                        <p class="sort__text">Сортировка:</p>
                                                        <div class="select__box sort">
                                                            <select name="sort" id="" class="selectpicker">
                                                                <option {{isset($_GET['sort']) && $_GET['sort']=='best'?'selected':''}} value="best">Бестселлер</option>
                                                                <option {{isset($_GET['sort']) && $_GET['sort']=='new'?'selected':''}} value="new" {{!isset($_GET['sort'])?'selected':''}}>Новинки</option>
                                                                <option {{isset($_GET['sort']) && $_GET['sort']=='min'?'selected':''}} value="min">Цена ↑</option>
                                                                <option {{isset($_GET['sort']) && $_GET['sort']=='max'?'selected':''}} value="max">Цена ↓</option>
                                                                <option {{isset($_GET['sort']) && $_GET['sort']=='alphabet'?'selected':''}} value="alphabet">А-я A-z</option>
                                                            </select>
                                                            <div class="custom_arrow"></div>
                                                        </div>
                                                    </div>
                                                    <div class="input_box">
                                                        <p class="price">Цена:</p>
                                                        <div class="input_item">
                                                            <input type="number" name="min_price" placeholder="0 ₸"
                                                                   value="{{isset($_GET['min_price'])?$_GET['min_price']:''}}">
                                                            <p class="line">-</p>
                                                            <input type="number" name="max_price" placeholder="20 000 ₸"
                                                                   value="{{isset($_GET['max_price'])?$_GET['max_price']:''}}">
                                                        </div>
                                                    </div>

                                                    <div class="select_box">
                                                        <div class="select_item">
                                                            <div class="select__box">
                                                                <select name="language" class="selectpicker">
                                                                    <option value="">@lang('book.lang_filter')</option>
                                                                    <option {{isset($_GET['language']) && $_GET['language']=='kz' ?'selected':''}} value="kz">
                                                                        Қазақ
                                                                    </option>
                                                                    <option {{isset($_GET['language']) && $_GET['language']=='ru' ?'selected':''}} value="ru">
                                                                        Русский
                                                                    </option>
                                                                </select>
                                                                <div class="custom_arrow"></div>
                                                            </div>

                                                            <div class="select__box">
                                                                <select name="cover" class="selectpicker">
                                                                    <option value="">@lang('book.oblojka')</option>
                                                                    <option {{isset($_GET['cover']) && $_GET['cover']=='soft'?'selected':''}} value="soft">
                                                                        @lang('book.myagkaya')
                                                                    </option>
                                                                    <option {{isset($_GET['cover']) && $_GET['cover']=='hard'?'selected':''}} value="hard">
                                                                        @lang('book.tverdaya')
                                                                    </option>
                                                                    <option {{isset($_GET['cover']) && $_GET['cover']=='integral'?'selected':''}} value="integral">
                                                                        @lang('book.integral')
                                                                    </option>
                                                                </select>
                                                                <div class="custom_arrow"></div>
                                                            </div>

                                                            <div class="select__box">
                                                                <select name="publisher" class="selectpicker">
                                                                    <option value="">@lang('book.publisher_filter')</option>
                                                                    @foreach($publishers as $item)
                                                                        <option {{isset($_GET['publisher']) && $_GET['publisher']==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name_ru}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="custom_arrow"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="press d-flex aling-items-center">
                                                    <button type="submit" class="touch">@lang('book.apply_btn')</button>
                                                </div>
                                                <div class="press d-flex aling-items-center">
                                                    <a href="{{Request::url()}}" class="touch cancel">@lang('book.clear_btn')</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!------------------------------- START Мобильный фильтр ---------------------------------------------->
                <div class="adaptive__filter d-flex">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <form method="get" action="">
                            <div class="sort">
                                <div class="sort__box d-flex align-items-center">
                                    <p class="sort__text__adatp"><i class="fas fa-sort"></i></p>
                                    <div class="select__box sort">
                                        <select name="sort" class="selectpicker">
                                            <option {{isset($_GET['sort']) && $_GET['sort']=='best'?'selected':''}} value="best">Бестселлер</option>
                                            <option {{isset($_GET['sort']) && $_GET['sort']=='new'?'selected':''}} value="new">Новинки</option>
                                            <option {{isset($_GET['sort']) && $_GET['sort']=='min'?'selected':''}} value="min">Цена ↑</option>
                                            <option {{isset($_GET['sort']) && $_GET['sort']=='max'?'selected':''}} value="max">Цена ↓</option>
                                            <option {{isset($_GET['sort']) && $_GET['sort']=='alphabet'?'selected':''}} value="alphabet">А-я A-z</option>
                                        </select>
                                        <div class="custom_arrow"></div>
                                    </div>
                                </div>
                            </div>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon d-flex">
                                <i class="fas fa-filter"></i>
                                <p>Фильтр</p>
                            </span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item pricing d-flex">
                                        <input type="number" name="min_price" placeholder="0 ₸"
                                               value="{{isset($_GET['min_price'])?$_GET['min_price']:''}}">
                                        <p class="line">-</p>
                                        <input type="number" name="max_price" placeholder="20 000 ₸"
                                               value="{{isset($_GET['max_price'])?$_GET['max_price']:''}}">
                                    </li>
                                    <li class="nav-item language">
                                        <select name="language" class="selectpicker">
                                            <option value="">Язык</option>
                                            <option {{isset($_GET['language']) && $_GET['language']=='kz' ?'selected':''}} value="kz">
                                                Қазақ
                                            </option>
                                            <option {{isset($_GET['language']) && $_GET['language']=='ru' ?'selected':''}} value="ru">
                                                Русский
                                            </option>
                                        </select>
                                        <div class="adapted_cstm_arrow">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <select name="cover" class="selectpicker">
                                            <option value="">Обложка</option>
                                            <option {{isset($_GET['cover']) && $_GET['cover']=='soft'?'selected':''}} value="soft">
                                                Мягкая
                                            </option>
                                            <option {{isset($_GET['cover']) && $_GET['cover']=='hard'?'selected':''}} value="hard">
                                                Твердая
                                            </option>
                                            <option {{isset($_GET['cover']) && $_GET['cover']=='integral'?'selected':''}} value="integral">
                                                Интеграл
                                            </option>
                                        </select>
                                        <div class="adapted_cstm_arrow">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <select name="publisher_id" class="selectpicker">
                                            <option value="">Издательство</option>
                                            @foreach($publishers as $item)
                                                <option {{isset($_GET['publisher_id']) && $_GET['publisher_id']==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name_ru}}</option>
                                            @endforeach
                                        </select>
                                        <div class="adapted_cstm_arrow">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </li>
                                    <li class="adapted__btn d-flex">
                                        <button type="submit" class="sbmt">Применить</button>
                                        <a href="{{Request::url()}}" class="adcancel">Очистить</a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </nav>
                </div>
                <!--------------------------------- END Мобильный фильтр ---------------------------------------------->

                <div class="row catalog">
                    @foreach($books as $item)
                        <div class="col-md-2 col-sm-3 col-xs-6 adapt_catalog__slide">
                            <div class="slide-main-books" style="width: 180px;position:relative;">
                                <a href="/book/{{$item->book_url}}">
                                    <div class="item-books">
                                        <div class="img-book">
                                            @if($item->main_image3)
                                                <img src="{{$item->main_image3->thumbnail180_250?$item->main_image3->thumbnail180_250:$item->main_image3->path}}">
                                            @endif
                                            <div class="opacity-img"></div>
                                        </div>

                                        @if($genre->paper_price)
                                            @if($item->sale_percentage>0)
                                                <span>
                                                    {{$item->paperbook_price*((100-$item->sale_percentage)/100)}} тг
                                                </span>
                                            @endif
                                            <span @if($item->sale_percentage>0) class="old-price" @endif style="z-index: 999;">
                                                {{$item->paperbook_price}} ₸
                                            </span>
                                        @elseif($genre->ebook_price)
                                            @if($item->sale_percentage>0)
                                                <span>
                                                    {{$item->ebook_price*((100-$item->sale_percentage)/100)}} тг
                                                </span>
                                            @endif
                                            <span @if($item->sale_percentage>0) class="old-price" @endif style="z-index: 999;">
                                                {{$item->ebook_price}} ₸
                                            </span>
                                        @elseif($genre->audio_price)
                                            @if($item->sale_percentage>0)
                                                <span>
                                                    {{$item->audio_price*((100-$item->sale_percentage)/100)}} тг
                                                </span>
                                            @endif
                                            <span @if($item->sale_percentage>0) class="old-price" @endif style="z-index: 999;">
                                                {{$item->audio_price}} ₸
                                            </span>
                                        @endif

                                        <p class="text-grey fs-15">
                                            @include('includes.bookauthors',['authors'=>$item->authors])
                                        </p>
                                        <p>{{$item->book_name}}</p>
                                        @if($genre->genre_id!=45)
                                            @if($item->subscribable)
                                                <h4 class="text-pro-purple">Подписка</h4>
                                            @else
                                                <h4 class="text-pro-green">Покупка</h4>
                                            @endif
                                        @endif
                                    </div>
                                </a>
                                @if($item->available)
                                    <span onclick="buy('paper',{{$item->book_id}})" class="item-bag">+ Добавить в корзину</span>
                                @endif
                                <span class="item-bag chosen" onclick="addToSelected({{$item->book_id}})">
                                    <i id="heart{{$item->book_id}}"

                                       class="@if(\Auth::user() && $item->selected->where('user_id',\Auth::user()->user_id)->first())selected @endif fas fa-heart"></i>
                                </span>
                                <span class="item-bag text">
                                     <p>Добавить в избранное</p>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <nav>
                    {{$books->appends(request()->input())->links('vendor.pagination.custom')}}
                </nav>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/js/plugins/jquery/3.5/jquery-3.5.1.min.js"></script>
    <script src="/js/bootstrap_select/bootstrap-select.min.js"></script>
    <script src="/js/jquery.toast.min.js"></script>
    <script>
        $(function () {
            $('.selectpicker').selectpicker();
        });

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
                    callToast('{{__('status.success')}}','{{__('book.buysuccesstext')}}');
                }
                else {
                    swalAlert('@lang('book.buyerrortitle')','@lang('book.buyerror')');
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
                    callToast('{{__('status.success')}}',text);
                } else {
                    swalAlert('@lang('book.buyerrortitle')','@lang('book.buyerror')');
                }
            });
        }
    </script>
@endpush
