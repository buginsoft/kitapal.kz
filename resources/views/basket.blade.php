@php
    use App\Models\Book;
    //$lang=App::getLocale();
    $name='name_'.$lang;
@endphp
@extends('layouts.main')
@push('styles')
    <style>
        .row-eq-height {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
        }
    </style>
@endpush
@section('title') @lang('book.title') @endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title clearfix">
                    @if(App::getLocale()=='ru')
                        Корзина,<span class="text-grey">
                            <span id="totalcount">{{\Cart::getTotalQuantity()}}</span>
                        товара на сумму
                            <span id="pricetotal">{{\Cart::getTotal()}}</span> ₸</span>
                    @else
                        Себетте, <span class="text-grey">
                            <span id="pricetotal">{{\Cart::getTotal()}}</span>
                            ₸ тұратын
                            <span id="totalcount">{{\Cart::getTotalQuantity()}}</span> тауар </span>
                    @endif

                    @if(\Cart::getTotalQuantity()!=0)



                            <a href="/checkout" class="hidden-xs pull-right btn btn-blue btn-lg btn-auto">@lang('basket.checkout')</a>


                    @endif
                </h1>

                <div class="row-eq-height">
                    @foreach ($items as $item)
                        @php
                            $book = Book::find($item->attributes->book_id);
                        @endphp
                        <div class="col-md-6">
                            <div class="i-basket">
                                <i class="icons ic-x delete-card" onclick="deleteProduct('{{$item->id}}')"></i>
                                <div class="item-basket clearfix">
                                    <div class="img-basket-book">
                                        <img src="{{$book->main_image()->path}}">
                                    </div>
                                    <div class="inf-basket">
                                        <p class="fs-24">{{$book["book_name"]}}
                                            <span class="d-block text-grey fs-15">
                                               @foreach($book->authors as $key=>$author)
                                                    @if($key==count($book->authors)-1)
                                                        {{$author->$name}}
                                                    @else
                                                        {{$author->$name}},
                                                    @endif
                                                @endforeach
                                            </span>
                                        </p>
                                        <div>

                                            @if($item->attributes->type =='paper')
                                                <span class="tag-type text-red">
                                                    <i class="icons ic-book-red"></i>@lang('basket.paper')
                                                </span>
                                            @elseif($item->attributes->type =='ebook')
                                                <span class="tag-type text-green">
                                                    <i class="icons ic-tel"></i>@lang('basket.ebook')
                                                </span>
                                            @else
                                                <span class="tag-type text-green">
                                                    <i class="icons ic-audio"></i>Аудио
                                                </span>
                                            @endif
                                        </div>
                                        <p class="fs-15">
                                            <span class="d-block">@lang('book.page_quantity'): {{$book["page_quanity"]}}</span>
                                            <span class="d-block">ISBN: {{$book["isbn"]}}</span>
                                            <span class="d-block">@lang('book.god_vipuska') {{$book["year"]}} @lang('book.god')</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="item-basket clearfix bottom-bask">
                                    <div class="img-basket-book">
                                        <div class="main">
                                            <button onclick="reducecount({{($item->id)}})" class="down_count">-</button>
                                            <input id="{{$item->id}}quantity" class="counter" type="text" value="{{$item->quantity}}">
                                            <button onclick="increasecount({{$item->id}})" class="up_count">+</button>
                                        </div>
                                    </div>
                                    <div class="inf-basket">
                                        <span class="itog-prod">
                                            <span id="price{{$item->id}}">{{$item->price}}</span> ₸</span>
                                            <a href="/checkout" class="btn-prod">@lang('basket.buy')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(\Cart::getTotalQuantity()!=0)
                        <a href="/checkout" class="btn btn-blue btn-lg btn-block visible-xs">@lang('basket.oformit')</a>

                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let totalcount = $("#totalcount");
        let pricetotal  =$("#pricetotal");


        //Уменшает на одну количество товара
        function reducecount($rowId) {
            if(parseInt($("#"+$rowId + "quantity").val())!=1) {
                $.ajax({
                    method: "POST",
                    url: "/decreaseItemQuantity",
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        row_id: $rowId
                    }
                }).done(function (msg) {
                    //Уменшаем количество товаров
                    var count = parseInt($('#shoppingcart_count').text()) - 1;
                    $("#shoppingcart_count").html(count);
                    $("#" + $rowId + "quantity").val(msg["quantity"]);
                    pricetotal.text(parseInt(pricetotal.text()) - parseInt($("#price" + $rowId).text()));
                    totalcount.text(parseInt(totalcount.text()) - 1);
                });
            }
        }

        function increasecount($rowId) {
            $.ajax({
                method: "POST",
                url: "/increaseItemQuantity",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    row_id: $rowId
                }
            }).done(function (msg) {

                //Уменшаем количество товаров
                var count = parseInt($('#shoppingcart_count').text()) + 1;
                $("#shoppingcart_count").html(count);
                $("#" + $rowId + "quantity").val(msg["quantity"]);
                pricetotal.text(parseInt(pricetotal.text()) + parseInt($("#price" + $rowId).text()));
                totalcount.text(parseInt(totalcount.text()) + 1);
            });

        }

        $('.delete-card').on('click', function () {
            $(this).closest('.i-basket').fadeOut('slow');
        });

        //Удаляет продукт полностю
        function deleteProduct( $id) {
            $.ajax({
                method: "POST",
                url: "/deletefrombasket/" + $id,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            }).done(function (msq) {
                $("#shoppingcart_count").html(msq.shoppingcartcount);
                $("#totalcount").html(msq.shoppingcartcount);
                $("#pricetotal").html(msq.totalprice);
            });
        }
    </script>
@endpush
