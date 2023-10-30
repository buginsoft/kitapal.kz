@php
    $text='text_'.App::getLocale();
    $lang=App::getLocale();
    $name='name_'.$lang;
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
    <style>
        #deliver_block {
            display: none;
        }
        .promocode__box {
            margin: 0px 0px 11px -2px;
        }
        .promocode__box .promocode__item {
            min-width: 235px;
            margin-right: 12px;
        }
        .promocode__box .promocode__item .invalid-feedback strong{
            line-height: 1.1;
        }
        .promocode__box .promocode__item .invalid-feedback {
            font-size: 15px;
            color: #f02b2b;
        }
        .form-control.promo{
            width: 90%;
        }
        .promocode__box .promo__button {
            position: relative;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%), #8E2976;
            color: #fff;
            border-radius: 4px;
            padding: 4px 13px 0px 13px;
            max-height: 34px;
            transition: all 0.8s;
            margin-left: -25px;
        }
        .promocode__box .promo__button:hover {
            background: #80256b;
        }
        .promocode__box .promo__button:active {
            top: 2px;
        }
        @media (max-width: 1200px) {
            .promocode__box .promocode__item {
                min-width: 242px;
                margin-right: 8px;
            }
            .promocode__box .promo__button {
                font-size: 13px;
                padding: 7px 5px 6px 5px;
                margin-left: -56px;
            }
            .form-control.promo {
                width: 78%;
                padding: 6px 7px;
            }
        }
    </style>
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
                        <form id="form" action="/paymentInit" method="post">
                            <input type="hidden" value="{{\Cart::getTotal()}}" name="price">
                            <input id="delivery_price" type="hidden" value="" name="delivery_price">
                            <input id="price_with_promocode" type="hidden" value="0" name="price_with_promocode">
                            @csrf
                            <div class="mb-25">
                                <p class="mb-25 line-title"><b>@lang('basket.personalinfo')</b></p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="formItem @if($errors->has('fio')) errorBox @endif">
                                            <input class="form-control" type="text"
                                                   placeholder="@lang('Profile.fio')"
                                                   name="fio" value="{{$user->user_name}}">
                                            @error('fio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>* {{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="email" placeholder="Email"
                                               value="{{$user->email}}"
                                               readonly="readonly">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="formItem @if($errors->has('phone')) errorBox @endif">
                                            <input class="form-control" type="text" name="phone"
                                                   placeholder="@lang('Profile.phone')"
                                                   value="{{$user->phone}}">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>* {{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($count>0)
                                <div class="mb-25">
                                    <p class="mb-25 line-title"><b>@lang('basket.deliverytitle')</b></p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="container-radio">@lang('basket.courier')
                                                <input type="radio"
                                                       {{(isset($_GET['delivery_type'])&&$_GET['delivery_type']=='courier')?'checked':''}} id="courier"
                                                       value="courier" checked="checked"
                                                       name="delivery_type"><span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="container-radio">@lang('basket.pickup')
                                                <input type="radio"
                                                       {{(!isset($_GET['delivery_type']))?'checked':''}}  id="samovivoz"
                                                       value="pickup"
                                                       name="delivery_type"><span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="container-radio">@lang('basket.post')
                                                <input type="radio"
                                                       {{(isset($_GET['delivery_type'])&&$_GET['delivery_type']=='post')?'checked':''}} id="post"
                                                       value="post"
                                                       name="delivery_type"><span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="fs-15 text-grey">@lang('basket.info')</p>
                                </div>
                                <div class="mb-25" id="deliver_block">
                                    <p class="mb-25 line-title"><b>@lang('Profile.menu_label1_header2')</b></p>
                                    @if(empty($address) || $errors->has('city'))
                                        <div id="addressyerror" class="alert alert-danger" role="alert"
                                             style="text-align:center;">
                                            Для отправки курьером надо обязательно зполнить адрес в профиле
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a class="btn btn-blue btn-lg" href="/profile">Толтыру</a>
                                            </div>
                                        </div>
                                    @else
                                        <div id="address" class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive" id="addressTable">
                                                    <table class="table cart">
                                                        <tbody>
                                                        <tr class="cart_item">
                                                            <td class="cart-product-name">
                                                                <strong>Город</strong>
                                                            </td>

                                                            <td class="cart-product-name">
                                                                <span id="citytitle" class="amount">
                                                                    {{($address)?$address->citytitle['text_'.\App::getLocale()]:''}}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <td class="cart-product-name">
                                                                <strong>@lang('Profile.naselenny_punkt')</strong>
                                                            </td>

                                                            <td class="cart-product-name">
                                                                <span class="amount">{{($address)?$address->naselenny_punkt:''}}</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <td class="cart-product-name">
                                                                <strong>@lang('Profile.street')</strong>
                                                            </td>

                                                            <td class="cart-product-name">
                                                                <span id="streettitle"
                                                                      class="amount">{{($address)?$address->street:''}}</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <td class="cart-product-name">
                                                                <strong>@lang('Profile.home')</strong>
                                                            </td>

                                                            <td class="cart-product-name">
                                                                <span id="hometitle"
                                                                      class="amount">{{($address)?$address->home:''}}</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <td class="cart-product-name">
                                                                <strong>@lang('Profile.podezd')</strong>
                                                            </td>

                                                            <td class="cart-product-name">
                                                                <span class="amount">{{($address)?$address->podezd:''}}</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <td class="cart-product-name">
                                                                <strong>@lang('Profile.kvartira')</strong>
                                                            </td>

                                                            <td class="cart-product-name">
                                                                <span class="amount">{{($address)?$address->kvartira:''}}</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <td class="cart-product-name">
                                                                <strong>@lang('Profile.post_index')</strong>
                                                            </td>

                                                            <td class="cart-product-name">
                                                                <span class="amount">{{($address)?$address->post_index:''}}</span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="address_change" class="row" style="display:none">
                                            <div id="city_wrapper" class="col-sm-6">
                                                <select id="city" class="form-control" name="city">
                                                    <option selected="true" disabled="disabled">
                                                        @lang('Profile.notchosen')
                                                    </option>
                                                    @foreach($cities as $item)
                                                        <option @if(!empty($address)&& ($address->city == $item->id))
                                                                selected
                                                                @endif  value="{{$item->id}}">
                                                            {{$item->$text}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="formItem">
                                                    <input id="naselenny_punkt" class="form-control" type="text"
                                                           name="naselenny_punkt"
                                                           placeholder="@lang('Profile.naselenny_punkt')"
                                                           value="{{(!empty($address))?$address->naselenny_punkt:''}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div id="street_wrapper" class="formItem">
                                                    <input class="form-control" type="text" id="street" name="street"
                                                           placeholder="@lang('Profile.street')"
                                                           value="{{(!empty($address))?$address->street:''}}">
                                                    @error('street')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>* {{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div id="home_wrapper" class="formItem">
                                                    <input class="form-control" type="text" id="home" name="home"
                                                           placeholder="@lang('Profile.home')"
                                                           value="{{(!empty($address))?$address->home:''}}">
                                                    @error('home')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>* {{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="formItem">
                                                    <input id="podezd" class="form-control" type="text" name="podezd"
                                                           placeholder="@lang('Profile.podezd')"
                                                           value="{{(!empty($address))?$address->podezd:''}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="formItem">
                                                    <input id="kvartira" class="form-control" type="text"
                                                           name="kvartira"
                                                           placeholder="@lang('Profile.kvartira')"
                                                           value="{{(!empty($address))?$address->kvartira:''}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="formItem">
                                                    <input id="post_index" class="form-control" type="text"
                                                           name="post_index"
                                                           placeholder="@lang('Profile.post_index')"
                                                           value="{{(!empty($address))?$address->post_index:''}}">
                                                    @error('post_index')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>* {{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <button id="addressChangeButton" onclick="changeAddress()"
                                                        class="btn btn-blue btn-lg" type="button">
                                                    Өзгерту
                                                </button>
                                                <button id="addressSaveButton" onclick="saveAddress()"
                                                        style="display:none"
                                                        class="btn btn-blue btn-lg" type="button">Сохранить
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <textarea class="form-control" placeholder="Хабарлама" name="order_comment" cols="20"
                                          rows="20"></textarea>
                            @endif
                            <div class="mb-25">
                                <p class="fs-15 text-grey">@lang('basket.errorinfo')</p>
                            </div>
                            <span id="pickup_addres">Мақатаев 128А (Сейфуллин қиылысы, нөлінші этаж). Жұмыс уақыты: дс-сн 9:00-18:00</span>
                            <div class="text-right hidden-xs">
                                <div id="deliveryerror" class="alert alert-danger" role="alert"
                                     style="text-align:center;display:none;">
                                    По данному адресу не доставляем
                                </div>
                                <div id="carantineerror" class="alert alert-danger" role="alert"
                                     style="text-align:center;display:none;">
                                    Во время карантина не доставляем курьером в города кроме Алматы
                                </div>
                                <button id="sbmBtn1" class="btn btn-blue btn-lg"
                                        type="submit">@lang('basket.pay')</button>
                            </div>

                    </div>
                    <div class="col-md-offset-1 col-md-4">
                        <div class="border-right-b">
                            @foreach ($items as $ite)
                                <?php $item = \App\Models\Book::find($ite->attributes->book_id)?>
                                <script>
                                    $('#form').append("<input type='hidden' name=book[] value='{{$ite->attributes->book_id}}'/>");
                                    $('#form').append("<input type='hidden' name=booktypes[] value='{{$ite->attributes->type}}'/>");
                                    $('#form').append("<input type='hidden' name=bookquantity[] value='{{$ite->quantity}}'/>");
                                    $('#form').append("<input type='hidden' name=on_sale[] value='{{$ite->attributes->on_sale}}'/>");
                                    $('#form').append("<input type='hidden' name=prices[] value='{{$ite->price}}'/>");
                                </script>
                                <div class="right-block d-flex">
                                    <div><img src="{{$item["book_image"]}}"></div>
                                    <div>
                                        <p>
                                            <b>{{$item["book_name"]}}</b>
                                            <span class="text-grey d-block">
                                                 @include('includes.bookauthors')
                                            </span>
                                        </p>
                                        <p>{{$ite->quantity}} х {{$ite->price}} ₸</p>
                                    </div>
                                </div>
                            @endforeach

                            <div class="bottom-itog">
                                <div class="promocode__box d-flex">
                                    <div class="promocode__item">
                                        <input id="promo" class="form-control promo" type="text" name="promo"
                                               placeholder="Промокод(Не обязательно)">
                                        <span id="promocode_error" class="invalid-feedback" role="alert">
                                </span>
                                    </div>
                                    <a class="promo__button" href="#" onclick="checkpromo()">Проверить</a>
                                </div>
                                <p class="clearfix">@lang('basket.delivery')
                                    <b class="pull-right"><span id="price">0</span> @lang('basket.tenge')</b>
                                </p>
                                <p class="clearfix">@lang('basket.total')
                                    <b class="pull-right"><span
                                            id="totalprice">{{\Cart::getTotal()}}</span> @lang('basket.tenge')</b>
                                </p>
                                <p class="clearfix">С промокодом
                                    <b class="pull-right"><span id="promocodeprice">0%</span> @lang('basket.tenge')</b>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-------------Promo-------------------------------------------------------------->
                <!--Ajaxpen jiberu-->

                <div class="formItem @if($errors->has('promo')) errorBox @endif">


                    <!---------------------------------------------------------------------------------->

                    <div class="text-center mt-40 visible-xs">
                        <div id="deliveryerrormobile" class="alert alert-danger" role="alert"
                             style="text-align:center;display:none;">
                            По данному адресу не доставляем
                        </div>
                        <div id="coviserrormobile" class="alert alert-danger" role="alert"
                             style="text-align:center;display:none;">
                            Во время карантина не доставляем курьером в города кроме Алматы
                        </div>
                        <button id="sbmBtn2" class="btn btn-blue btn-lg" type="submit">@lang('basket.pay')</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div id="map" style="display: none"></div>
@endsection
@push('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=1c5b5a65-31ff-4dbd-89e5-d2ceaed5453c"
            type="text/javascript"></script>

    <script>
        var x = document.getElementById("address_change");
        var y = document.getElementById("address");
        var z = document.getElementById("addressChangeButton");
        var m = document.getElementById("addressSaveButton");
        var postCheckBox = document.getElementById("post");
        var courierCheckBox = document.getElementById('courier');
        var pickupCheckBox = document.getElementById('samovivoz');

        function changeAddress() {
            x.style.display = "block";
            y.style.display = "none";
            z.style.display = "none";
            m.style.display = "block";
        }

        function checkpromo() {
            $.ajax({
                method: "POST",
                url: "/checkpromo",
                data: {
                    'promocode': $("#promo").val()
                },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            }).done(function (msq) {
                if (msq.success == 'true') {
                    $("#promocodeprice").html({{\Cart::getTotal()}}* (100 - msq.percentage) / 100);
                    $("#price_with_promocode").val({{\Cart::getTotal()}}* (100 - msq.percentage) / 100);
                } else {
                    $("#promocode_error").html('<strong>* ' + msq.error + '</strong>');
                }
            });
        }

        function saveAddress() {
            let dtype;
            if ($('#courier').is(':checked')) {
                dtype = 'courier';
            } else {
                dtype = 'post';
            }
            $.ajax({
                method: "POST",
                url: "/saveAddress",
                data: {
                    'city': $("#city").val(),
                    'naselenny_punkt': $("#naselenny_punkt").val(),
                    'street': $("#street").val(),
                    'home': $("#home").val(),
                    'podezd': $("#podezd").val(),
                    'kvartira': $("#kvartira").val(),
                    'post_index': $("#post_index").val(),
                    'delivery_type': dtype
                },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            }).done(function (msq) {
                if (msq.status == false) {
                    $('div').removeClass('errorBox');
                    if (msq.error.home) {
                        $('#home_wrapper').addClass('errorBox');
                    }
                    if (msq.error.city) {
                        $('#city_wrapper').addClass('errorBox');
                    }
                    if (msq.error.street) {
                        $('#street_wrapper').addClass('errorBox');
                    }

                } else {
                    if (msq.delivery_type ) {
                        window.location.replace('http://kitapal.kz/checkout?delivery_type=' + respond.delivery_type);
                    }
                    else {
                        window.location.replace('https://kitapal.kz/checkout');
                    }
                    $("#addressTable").html(text);
                    x.style.display = "none";
                    y.style.display = "block";
                    z.style.display = "block";
                    m.style.display = "none";

                    if (document.getElementById('courier').checked) {
                        if ($('#citytitle').text().trim() == 'Алматы') {
                            ymaps.ready(init);
                            covid2019errorhide();
                        } else {
                            covid2019error();
                        }
                    }
                }
            });
        }

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [43.223342794696485, 76.95543649999995],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            });
            var Polygon1 = new ymaps.GeoObject({
                geometry: {
                    type: "Polygon",
                    coordinates: [
                        [
                            [43.28096028597733, 76.91173166074293],
                            [43.28221443254844, 76.91542238034764],
                            [43.28647833613404, 76.9211730364756],
                            [43.29067924087404, 76.92735284604588],
                            [43.292278015909, 76.93198770322343],
                            [43.293688664613086, 76.9370517138436],
                            [43.294879853387364, 76.95112794675389],
                            [43.29437830307338, 76.95361703671945],
                            [43.26482678303403, 76.95811032193656],
                            [43.264585753696586, 76.95409589570448],
                            [43.25072194491856, 76.95594125550633],
                            [43.23638793982004, 76.9577093392848],
                            [43.228559414148066, 76.9606087096755],
                            [43.22771703191939, 76.94422193976884],
                            [43.207378332382696, 76.91422411414645],
                            [43.20405067266317, 76.91345163794979],
                            [43.20116236697494, 76.90976091834534],
                            [43.200848412406444, 76.9058985373641],
                            [43.19463177690143, 76.89508387061565],
                            [43.19462519047127, 76.87882920397638],
                            [43.19531595934886, 76.87475224627362],
                            [43.197451013289665, 76.87084694994822],
                            [43.19914644370561, 76.86917325152297],
                            [43.20106159506878, 76.86801453722835],
                            [43.205613761042166, 76.86535378588557],
                            [43.20790541168497, 76.86295052660863],
                            [43.19826790459326, 76.84205122668362],
                            [43.20043425027252, 76.83999129016011],
                            [43.20307143610853, 76.83810301501325],
                            [43.20869077055232, 76.8353135176382],
                            [43.210825353138326, 76.8340260573107],
                            [43.23268054402241, 76.82530677006422],
                            [43.242208155507925, 76.82194089471623],
                            [43.24361997329939, 76.82760572015582],
                            [43.254160504753244, 76.82288503228953],
                            [43.25949726629967, 76.84925343953553],
                            [43.27724732173191, 76.89783360921327],
                            [43.27957493090634, 76.90547984171543],
                            [43.28096028597733, 76.91173166074293]
                        ]
                    ]
                }
            });

            var Polygon2 = new ymaps.GeoObject({
                geometry: {
                    type: "Polygon",
                    coordinates: [
                        [
                            [43.21275631332884, 76.9689061610217],
                            [43.21226977619743, 76.9664599864001],
                            [43.21032813923686, 76.95484478797084],
                            [43.18175471886071, 76.9104511758446],
                            [43.18000401237177, 76.89715668700637],
                            [43.181986979870324, 76.87104873071242],
                            [43.191419837745165, 76.85527917017549],
                            [43.18306190162184, 76.83642192386027],
                            [43.1998727329973, 76.8190415824934],
                            [43.23587921682672, 76.80498139735045],
                            [43.23953654339877, 76.80957008009287],
                            [43.26436146043744, 76.80026779469682],
                            [43.27168635778994, 76.84271287850736],
                            [43.28985445964523, 76.89955259311442],
                            [43.30701075558935, 76.92325994361269],
                            [43.30913595108665, 76.95517923153675],
                            [43.31238515574286, 76.98102309850269],
                            [43.22560205032136, 76.98742009769913],
                            [43.21275631332884, 76.9689061610217]
                        ],
                        [
                            [43.28096028597733, 76.91173166074293],
                            [43.28221443254844, 76.91542238034764],
                            [43.28647833613404, 76.9211730364756],
                            [43.29067924087404, 76.92735284604588],
                            [43.292278015909, 76.93198770322343],
                            [43.293688664613086, 76.9370517138436],
                            [43.294879853387364, 76.95112794675389],
                            [43.29437830307338, 76.95361703671945],
                            [43.26482678303403, 76.95811032193656],
                            [43.264585753696586, 76.95409589570448],
                            [43.25072194491856, 76.95594125550633],
                            [43.23638793982004, 76.9577093392848],
                            [43.228559414148066, 76.9606087096755],
                            [43.22771703191939, 76.94422193976884],
                            [43.207378332382696, 76.91422411414645],
                            [43.20405067266317, 76.91345163794979],
                            [43.20116236697494, 76.90976091834534],
                            [43.200848412406444, 76.9058985373641],
                            [43.19463177690143, 76.89508387061565],
                            [43.19462519047127, 76.87882920397638],
                            [43.19531595934886, 76.87475224627362],
                            [43.197451013289665, 76.87084694994822],
                            [43.19914644370561, 76.86917325152297],
                            [43.20106159506878, 76.86801453722835],
                            [43.205613761042166, 76.86535378588557],
                            [43.20790541168497, 76.86295052660863],
                            [43.19826790459326, 76.84205122668362],
                            [43.20043425027252, 76.83999129016011],
                            [43.20307143610853, 76.83810301501325],
                            [43.20869077055232, 76.8353135176382],
                            [43.210825353138326, 76.8340260573107],
                            [43.23268054402241, 76.82530677006422],
                            [43.242208155507925, 76.82194089471623],
                            [43.24361997329939, 76.82760572015582],
                            [43.254160504753244, 76.82288503228953],
                            [43.25949726629967, 76.84925343953553],
                            [43.27724732173191, 76.89783360921327],
                            [43.27957493090634, 76.90547984171543],
                            [43.28096028597733, 76.91173166074293]
                        ]
                    ]
                }
            });

            var Polygon3 = new ymaps.GeoObject({
                geometry: {
                    type: "Polygon",
                    coordinates: [
                        [
                            [43.29458841400743, 76.87012956830027],
                            [43.31993425076197, 76.91240291688122],
                            [43.324975295650034, 76.99433479348258],
                            [43.21965568186784, 77.00434130747826],
                            [43.201140191806665, 76.97726785618818],
                            [43.19732773794628, 76.95442653517539],
                            [43.16989573295001, 76.91249480189859],
                            [43.16921950493439, 76.89211323658766],
                            [43.17077902229939, 76.86185034416597],
                            [43.176604911908974, 76.84476331020554],
                            [43.16838010293925, 76.82744401946644],
                            [43.194513276058395, 76.80295414486321],
                            [43.23851007528382, 76.78629781725498],
                            [43.244776499155485, 76.79550658010747],
                            [43.271238945287685, 76.78459755272712],
                            [43.29458841400743, 76.87012956830027]
                        ],
                        [
                            [43.21275631332884, 76.9689061610217],
                            [43.21226977619743, 76.9664599864001],
                            [43.21032813923686, 76.95484478797084],
                            [43.18175471886071, 76.9104511758446],
                            [43.18000401237177, 76.89715668700637],
                            [43.181986979870324, 76.87104873071242],
                            [43.191419837745165, 76.85527917017549],
                            [43.18306190162184, 76.83642192386027],
                            [43.1998727329973, 76.8190415824934],
                            [43.23587921682672, 76.80498139735045],
                            [43.23953654339877, 76.80957008009287],
                            [43.26436146043744, 76.80026779469682],
                            [43.27168635778994, 76.84271287850736],
                            [43.28985445964523, 76.89955259311442],
                            [43.30701075558935, 76.92325994361269],
                            [43.30913595108665, 76.95517923153675],
                            [43.31238515574286, 76.98102309850269],
                            [43.22560205032136, 76.98742009769913],
                            [43.21275631332884, 76.9689061610217]
                        ]
                    ]
                }
            });
            myMap.geoObjects.add(Polygon1);
            myMap.geoObjects.add(Polygon2);
            myMap.geoObjects.add(Polygon3);
            let street = $('#streettitle').text().trim();
            let home = $('#hometitle').text().trim();
            var myGeocoder = ymaps.geocode('Алматы,' + street + ',' + home);
            myGeocoder.then(
                function (res) {
                    var firstGeoObject = res.geoObjects.get(0);
                    coords = firstGeoObject.geometry.getCoordinates();

                    if (Polygon1.geometry.contains(coords)) {
                        $("#price").html('{{$almatycourier[0]->price}}');
                        $("#delivery_price").val({{$almatycourier[0]->price}});
                        hideDeliveryErrorMsg()
                    } else if (Polygon2.geometry.contains(coords)) {
                        $("#price").html('{{$almatycourier[1]->price}}');
                        $("#delivery_price").val({{$almatycourier[1]->price}});
                        hideDeliveryErrorMsg()
                    } else if (Polygon3.geometry.contains(coords)) {
                        $("#price").html('{{$almatycourier[2]->price}}');
                        $("#delivery_price").val({{$almatycourier[2]->price}});
                        hideDeliveryErrorMsg()
                    } else {
                        showDeliveryErrorMsg()
                    }
                }
            );
        }

        $("#samovivoz").change(function () {
            if (this.checked) {
                covid2019errorhide();
                hideDeliveryErrorMsg();
                hideDeliveryBlock();
                $("#price").html('0');
                $("#delivery_price").val(0);
                $('#pickup_addres').show();
            }
        });
        $("#courier").change(function () {
            if (this.checked) {
                showDeliveryBlock();
                $('#pickup_addres').hide();
                if ($('#citytitle').text().trim() == '') {
                    showSetAddress();
                } else {
                    if ($('#citytitle').text().trim() == 'Алматы') {
                        if (parseInt($("#totalprice").text()) >={{$free->price}}) {
                            $("#price").html("0");
                            $("#delivery_price").val(0);
                        } else {
                            ymaps.ready(init);
                        }
                    } else {
                        covid2019error();
                    }
                }
            }
        });

        function covid2019error() {
            $("#carantineerror").show();
            $("#coviserrormobile").show();
            $('.bottom-itog').hide();
            $('#sbmBtn1').hide();

        }

        function covid2019errorhide() {
            $("#carantineerror").hide();
            $("#coviserrormobile").hide();
            $('.bottom-itog').show();
            $('#sbmBtn1').show();

        }

        $("#post").change(function () {
            if (this.checked) {
                covid2019errorhide();
                showDeliveryBlock();
                hideDeliveryErrorMsg();
                $('#pickup_addres').hide();
                if (parseInt($("#totalprice").text()) >={{$free->price}}) {
                    $("#price").html("0");
                    $("#delivery_price").val(0);
                } else {
                    $.ajax({
                        method: "GET",
                        url: "/getPostPrice",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    }).done(function (msq) {
                        $("#price").html(msq);
                        $("#delivery_price").val(msq);
                    });
                }
            }
        });


        window.onload = function () {
            if (postCheckBox.checked == true) {
                showDeliveryBlock();
                hideDeliveryErrorMsg();
                if (parseInt($("#totalprice").text()) >={{$free->price}}) {
                    $("#price").html("0");
                    $("#delivery_price").val(0);
                } else {
                    $.ajax({
                        method: "GET",
                        url: "/getPostPrice",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    }).done(function (msq) {
                        $("#price").html(msq);
                        $("#delivery_price").val(msq);
                    });
                }
            } else if (courierCheckBox.checked == true) {
                showDeliveryBlock();
                if ($('#citytitle').text().trim() == '') {
                    showSetAddress();
                } else {
                    if ($('#citytitle').text().trim() == 'Алматы') {

                        if (parseInt($("#totalprice").text()) >={{$free->price}}) {
                            $("#price").html("0");
                            $("#delivery_price").val(0);
                        } else {
                            ymaps.ready(init);
                        }

                    } else {
                        covid2019error();
                    }
                }
            }


            if (pickupCheckBox.checked == true) {
                $('#pickup_addres').show();
            } else {
                $('#pickup_addres').hide();
            }
        };
    </script>
@endpush
