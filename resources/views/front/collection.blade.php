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
@section('title',$page_title)
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                @include('includes.booksearch')
            </div>
            <div class="section-row">
                @include('includes.breadcrumb',['wrapper_class'=>'crumbs__container','breadcrumb_link'=>$page_title])

                <h1 class="big-title filter">{{$page_title}}</h1>



                <div class="row catalog">
                    @foreach($books as $item)
                        <div class="col-md-2 col-sm-3 col-xs-6 adapt_catalog__slide">
                            <div class="slide-main-books" style="width: 180px;position:relative;">
                                <a href="/book/{{$item->book_url}}">
                                    <div class="item-books">
                                        <div class="img-book">
                                            <img src="{{$item->main_image()->thumbnail180_250?$item->main_image()->thumbnail180_250:$item->main_image()->path}}">
                                            <div class="opacity-img"></div>
                                        </div>
                                        <span>{{$item->paperbook_price*((100-$item->sale_percentage)/100)}} тг</span>
                                        <span class="old-price" style="z-index: 999;">{{$item->paperbook_price}} ₸</span>
                                        <p class="text-grey fs-15">
                                            @include('includes.bookauthors',['authors'=>$item->authors])
                                        </p>
                                        <p>{{$item->book_name}}</p>
                                    </div>
                                </a>
                                @if($item->available)
                                    <span onclick="buy('paper',{{$item->book_id}})" class="item-bag">+ Добавить в корзину</span>
                                @endif
                                <span class="item-bag chosen" onclick="addToSelected({{$item->book_id}})">
                                    <i id="heart{{$item->book_id}}"

                                       class="@if(\Auth::user() && \App\Models\UserSelected::where([['user_id',\Auth::user()->user_id],['book_id',$item->book_id]])->first())selected @endif fas fa-heart"></i>
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
