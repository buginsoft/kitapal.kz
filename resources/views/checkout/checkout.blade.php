@php
    $count=0;
@endphp
@foreach ($items as $item)
    @if($item->attributes->type=='paper')
        @php $count++; @endphp
    @endif
@endforeach
@extends('layouts.main')
@section('title')
    @lang('basket.checkoutheader')
@endsection
@push('styles')
    <link rel="stylesheet" href="/css/promocode.css">
@endpush
@section('content')
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title">@lang('basket.checkoutheader')</h1>
                <div class="row">
                    <div class="col-md-7 input-prof">
                        @if(isset($errors) && $errors->has('price'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ $errors->first('price') }}</li>
                                </ul>
                            </div>
                        @endif
                        <form id="form" action="/checkout-delivery" method="post">
                            <input type="hidden" value="{{\Cart::getTotal()}}" name="price">
                            <input type="hidden" value="{{$order->order_id}}" name="order_id">
                        @csrf

                        <!-------------------------------Personal info-------------------------------------------->
                            <div class="mb-25">
                                <p class="mb-25 line-title"><b>@lang('basket.personalinfo')</b></p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="formItem @if($errors->has('fio')) errorBox @endif">
                                            <input class="form-control" type="text" placeholder="@lang('Profile.fio')" name="fio" value="{{$user->user_name}}" required>
                                            @error('fio')
                                            @include('checkout.includes.error' ,['message'=>$message])
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="email" placeholder="Email" value="{{$user->email}}" readonly="readonly">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="formItem @if($errors->has('phone')) errorBox @endif">
                                            <input class="form-control" type="text" name="phone" placeholder="@lang('Profile.phone')" value="{{$user->phone}}" required>
                                            @error('phone')
                                            @include('checkout.includes.error' ,['message'=>$message])
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----------------------------------------------------------------------------------------->

                            <!---------------------------------Delivery methods select-------------------------------->
                            @if($count>0)
                                <div class="mb-25">
                                    <p class="mb-25 line-title"><b>@lang('basket.deliverytitle')</b></p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="container-radio">@lang('basket.courier')
                                                <input type="radio"  id="courier" value="courier" checked="checked" name="delivery_type">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="container-radio">@lang('basket.pickup')
                                                <input type="radio" id="samovivoz" value="pickup" name="delivery_type"><span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="container-radio">@lang('basket.post')
                                                <input type="radio" id="post" value="post" name="delivery_type"><span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="fs-15 text-grey">@lang('basket.info')</p>
                                </div>
                                <textarea class="form-control" placeholder="@lang('basket.comment')" name="order_comment" cols="20" rows="20"></textarea>
                        @endif
                        <!----------------------------------------------------------------------------------------->

                            <div class="mb-25">
                                <p class="fs-15 text-grey">@lang('basket.errorinfo')</p>
                            </div>
                            <span id="pickup_addres">
                                {!! \App\Models\Contact::first()['pickup_address_'.app()->getLocale()] !!}
                            </span>
                            <div class="text-right hidden-xs">
                                <button id="sbmBtn1" class="btn btn-blue btn-lg" type="submit"> @lang('basket.filladdress')</button>
                            </div>
                    </div>
                    <!---------------------------------------Right sidebar--------------------------------------------->
                    <div class="col-md-offset-1 col-md-4">
                        <div class="border-right-b">
                            @foreach ($items as $item)
                                <div class="right-block d-flex">
                                    <div><img src="{{\App\Models\Book::find($item->attributes->book_id)->main_image()->path}}"></div>
                                    <div>
                                        <p>
                                            <b>{{\App\Models\Book::find($item->attributes->book_id)->book_name}}</b>
                                            <span class="text-grey d-block">
                                                 @include('includes.bookauthors',['authors'=>\App\Models\Book::find($item->attributes->book_id)->authors])
                                            </span>
                                        </p>
                                        <p>{{$item->quantity}} х {{$item->price}} ₸</p>
                                    </div>
                                </div>
                            @endforeach


                            <div class="bottom-itog">
                                <div class="promocode__box d-flex">
                                    <div class="promocode__item">
                                        <input id="promo" class="form-control promo" type="text" name="promo" placeholder="Промокод(Не обязательно)">
                                        <span id="promocode_error" class="invalid-feedback" role="alert"></span>
                                    </div>
                                    <a class="promo__button" href="#" onclick="checkpromo()">Проверить</a>
                                </div>
                                <p class="clearfix">@lang('basket.total')
                                    <b class="pull-right">
                                        <span id="totalprice">{{\Cart::session(\Auth::user()->user_id)->getTotal()}}</span> @lang('basket.tenge')
                                    </b>
                                </p>
                                <p id="promo_wrapper"  class="clearfix" style="display: none">С промокодом
                                    <b class="pull-right"><span id="promocodeprice"></span> @lang('basket.tenge')</b>
                                </p>
                            </div>

                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                </div>

                <!-------------Promo-------------------------------------------------------------->
                <!--Ajaxpen jiberu-->

                <div class="formItem @if($errors->has('promo')) errorBox @endif">


                    <!---------------------------------------------------------------------------------->

                    <div class="text-center mt-40 visible-xs">
                        <button id="sbmBtn2" class="btn btn-blue btn-lg" type="submit">@lang('basket.filladdress')</button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function checkpromo() {
            $.ajax({
                method: "POST",
                url: "/checkpromo",
                data: {
                    'promocode': $("#promo").val(),
                    'order_id': {{$order->order_id}}
                },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            }).done(function (msq) {
                if (msq.success == 'true') {
                    $("#promo_wrapper").css('display','block');
                    $("#promo_wrapper").children().children().html({{\Cart::session(\Auth::user()->user_id)->getTotal()}}* (100 - msq.percentage) / 100);
                } else {
                    $("#promocode_error").html('<strong>* ' + msq.error + '</strong>');
                }
            });
        }

        window.onload = function() {
            @if($count==0)
            document.getElementById('form').action = "/paymentInit";
            document.getElementById('sbmBtn1').innerText  = "@lang('basket.pay')";
            document.getElementById('sbmBtn2').innerText  = "@lang('basket.pay')";
            @endif
        };

        $("#samovivoz").change(function () {
            if (this.checked) {
                $('#pickup_addres').show();
                let form = document.getElementById('form');
                let button1 = document.getElementById('sbmBtn1');
                let button2 = document.getElementById('sbmBtn2');

                button1.innerText  = "@lang('basket.pay')";
                button2.innerText  = "@lang('basket.pay')";
                form.action = "/paymentInit";

                //форманы повторно жибермей ушин
                form.addEventListener('submit', function() {
                    button1.disabled = true;
                    button2.disabled = true;
                });
            }
        });
        $("#courier").change(function () {
            if (this.checked) {
                $('#pickup_addres').hide();
                document.getElementById('sbmBtn1').innerText  = "@lang('basket.filladdress')";
                document.getElementById('sbmBtn2').innerText  = "@lang('basket.filladdress')";
                document.getElementById('form').action = "/checkout-delivery";
            }
        });

        $("#post").change(function () {
            if (this.checked) {
                $('#pickup_addres').hide();
                document.getElementById('sbmBtn1').innerText  = "@lang('basket.filladdress')";
                document.getElementById('sbmBtn2').innerText  = "@lang('basket.filladdress')";
                document.getElementById('form').action = "/checkout-delivery";
            }
        });
    </script>
@endpush
