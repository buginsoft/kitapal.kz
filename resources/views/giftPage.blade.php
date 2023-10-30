@php
    $lang=App::getLocale();
    $name='name_'.$lang;
@endphp
@section('title' ,__('gift.header'))
@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="container">
            <div class="section-row">
                <div class="max-w-670">
                    <h1 class="big-title">
                        @lang('gift.header')
                    </h1>
                    <p>@lang('gift.info')</p>
                    <div class="right-block d-flex-page border-block mt-40">
                        <div>
                            <img src="{{$item->main_image()->path}}">
                        </div>
                        <div>
                            <p>
                                <b>{{$item->book_name}}</b>
                                <span class="text-grey d-block">
                                    @include('includes.bookauthors',['authors'=>$item->authors])
                                </span>
                            </p>
                            <p>{{$item->getPrice('ebook')}} ₸</p>
                        </div>
                    </div>
                    <div class="bottom-itog">
                        <p class="clearfix">@lang('basket.total')
                            <b class="pull-right">{{$item->getPrice('ebook')}} @lang('basket.tenge')</b>
                        </p>
                    </div>
                    <div class="input-prof mt-40">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="/paymentInit">
                            @csrf
                            <div class="mb-25">
                                <p class="mb-25 line-title">
                                    <b>@lang('basket.personalinfo')</b>
                                </p>
                                <div class="row">
                                    <input  type="hidden"  name="book[]" value="{{$item->book_id}}">
                                    <input  type="hidden"  name="booktypes[]" value="ebook">
                                    <input  type="hidden"  name="order_id" value="{{$order->order_id}}">
                                    <input  type="hidden"  name="bookquantity[]" value="1">
                                    <input  type="hidden"  name="is_gift" value="1">
                                    <input  type="hidden" name="price" value="{{$item->getPrice('ebook')}}">
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" placeholder="@lang('gift.recipient_name')" name="recipient_name">
                                        @error('recipient_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="email" placeholder="@lang('gift.recipient_email')"
                                               name="recipient_email">
                                        @error('recipient_email')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea  rows="30" class="form-control" name="gift_comment" placeholder="Хабарлама"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-25">
                                <p class="fs-15 text-grey">@lang('basket.errorinfo')</p>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-blue btn-lg" type="submit">@lang('basket.pay')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
