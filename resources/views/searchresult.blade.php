@extends('layouts.main')
@php
    $lang=app()->getLocale();
    $name = 'name_'.$lang;
@endphp
@section('title')
    @lang('words.search_result_header')
@endsection
@push('styles')
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/main.css?v=24">
    <style>
        @media (max-width: 1200px) {
            .slide-main-books .item-bag.search {
                right: 19%;
            }

            .slide-main-books .item-bag.text.search {
                top: 4%;
                right: 32%;
                padding: 0px 3px;
            }

        }

        @media (max-width: 767px) {
            span.item-bag {
                left: 9%;
            }

            .slide-main-books .item-bag.search {
                right: 18%;
            }

            .slide-main-books .item-bag.text.search {
                right: 31%;
            }
        }
    </style>
@endpush
@section('content')
    <div class="content">
        <div class="container">
            <div class="section-row">
                @if(empty($search_word))
                @else
                    <h1 class="big-title">@lang('words.search_result_header'): {{$search_word}}</h1>
                @endif
                <div class="row catalog">
                    @foreach($books as $item)
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <div class="slide-main-books" style="width: 180px;position:relative;">
                                <a href="/book/{{$item->book_url}}">
                                    <div class="item-books">
                                        <div class="img-book">
                                            <img src="{{$item->main_image()?$item->main_image()->path:''}}">
                                            <div class="opacity-img"></div>
                                        </div>
                                        @if($item->paperbook_price)
                                            <span>{{$item->paperbook_price*((100-$item->sale_percentage)/100)}} тг</span>
                                        <span class="old-price" style="z-index: 999;">{{$item->paperbook_price}} ₸</span>
                                        @endif
                                        <p class="text-grey fs-15">
                                            @foreach($item->authors as $key=>$author)
                                                @if($key==count($item->authors)-1)
                                                    {{$author->$name}}
                                                @else
                                                    {{$author->$name}},
                                                @endif
                                            @endforeach
                                        </p>
                                        <p>{{$item->book_name}}</p>
                                        @if($item->subscribable)
                                        <h4 class="text-pro-purple">Подписка</h4>
                                        @else
                                        <h4 class="text-pro-green">Покупка</h4>
                                        @endif
                                    </div>
                                </a>
                                @if($item->available)
                                    <span onclick="buy('paper',{{$item->book_id}})" class="item-bag">+ Добавить в корзину</span>
                                @endif
                                <span class="item-bag chosen search" onclick="addToSelected({{$item->book_id}})">
                                                <i id="heart{{$item->book_id}}"
                                                   class="@if(\Auth::user() && \App\Models\UserSelected::where([['user_id',\Auth::user()->user_id],['book_id',$item->book_id]])->first())selected @endif fas fa-heart"></i>
                                            </span>
                                <span class="item-bag text search">
                                                 <p>Добавить в избранное</p>
                                            </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <nav>
                    {{ $books->appends(request()->input())->links('vendor.pagination.custom') }}
                </nav>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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
                if (msg.success == true) {

                    let count = parseInt($('#shoppingcart_count').text()) + 1;
                    $("#shoppingcart_count").html(count);
                    $.toast({
                        heading: '{{__('status.success')}}',
                        text: '{{__('book.buysuccesstext')}}',
                        bgColor: '#8E2976',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'bottom-left'
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
    </script>
@endpush
