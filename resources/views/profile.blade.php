@php
    use App\Models\Book;
    use App\Models\OrderProducts;
    $text='text_'.App::getLocale();
    $lang=App::getLocale();
    $name='name_'.$lang;
@endphp
@extends('layouts.main')
@push('styles')
    <style>
        .error-message {
            color: #cc0033;
            display: inline-block;
            font-size: 12px;
            line-height: 15px;
            margin: 5px 0 0;
        }

        .table-paument td {
            min-width: unset;
        }

        .section-row {
            padding: 30px 0;
        }
    </style>
@endpush
@section('title')
    @lang('Profile.main_header')
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title">@lang('Profile.main_header')</h1>
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <ul class="nav nav-tabs tab-li-prof">
                            <li class="active">
                                <a data-toggle="tab" href="#tabs1">
                                    <i class="icons ic-user"></i>@lang('Profile.menu_label1')</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabs2">
                                    <i class="icons ic-book"></i>@lang('Profile.menu_label2')</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabs5">
                                    <i class="icons "></i>@lang('Profile.my_subscriptions')</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabs3"><i class="icons ic-paument"></i>@lang('Profile.menu_label3')</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabs4">
                                    <i class="icons ic-book"></i>@lang('Profile.selecteds')</a>
                            </li>
                            <li>
                                <a href="/basket"><i class="icons ic-bask"></i>@lang('Profile.menu_label4')
                                    <span class="ic-nof">{{\Cart::getTotalQuantity()}}</span></a>
                            </li>
                            @if($user->user_role_id)
                                <li>
                                    <a href="/admin/dashboard"><i class="icons ic-star"></i>Админка</a>
                                </li>
                            @endif
                            <li>
                                <a href="/logout"><i class="icons ic-out-user"></i>@lang('Profile.menu_label5')</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-8 input-prof">
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="tabs1">
                                <form method="post" action="updateProfile">
                                    @csrf
                                    <div class="formBox">
                                        <div class="profileForm-head">
                                            <div class="profImg">
                                                <img id="userphoto" src="{{$user->avatar}}" alt="">
                                                <input id="avatar" name="avatar" type="file">
                                                <span>@lang('Profile.changephoto')</span>
                                            </div>
                                        </div>
                                        <div class="formBox_caption">
                                            <p class="line-title"><b>@lang('Profile.menu_label1_header1')</b></p>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <input class="form-control" name="email" type="email"
                                                           value='{{$user->email}}'
                                                           placeholder="Email" readonly="readonly">
                                                    @error('email')
                                                    <div class="error-message">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control" name="name" type="text"
                                                           value='{{$user->user_name}}'
                                                           placeholder="@lang('Profile.fio')">
                                                    @error('name')
                                                    <div class="error-message">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control" name="phone" type="text"
                                                           placeholder="@lang('Profile.phone')"
                                                           value="{{$user->phone}}">
                                                </div>
                                            </div>
                                            <p class="line-title"><b>@lang('Profile.menu_label1_header2')</b></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select class="form-control" name="city">
                                                <option selected="true"
                                                        disabled="disabled">@lang('Profile.notchosen')</option>
                                                @foreach($cities as $item)
                                                    <option @if(!empty($address)&& ($address->city == $item->id)) {{'selected'}} @endif  value="{{$item->id}}">{{$item->$text}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="naselenny_punkt"
                                                   placeholder="@lang('Profile.naselenny_punkt')"
                                                   value="{{(!empty($address))?$address->naselenny_punkt:''}}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="street"
                                                   placeholder="@lang('Profile.street')"
                                                   value="{{(!empty($address))?$address->street:''}}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="home"
                                                   placeholder="@lang('Profile.home')"
                                                   value="{{(!empty($address))?$address->home:''}}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="podezd"
                                                   placeholder="@lang('Profile.podezd')"
                                                   value="{{(!empty($address))?$address->podezd:''}}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="kvartira"
                                                   placeholder="@lang('Profile.kvartira')"
                                                   value="{{(!empty($address))?$address->kvartira:''}}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="post_index"
                                                   placeholder="@lang('Profile.post_index')"
                                                   value="{{(!empty($address))?$address->post_index:''}}">
                                        </div>
                                    </div>


                                    <button class="btn btn-blue btn-lg" type="submit">@lang('Profile.save')</button>
                                </form>
                                <div class="change__password">
                                    <p class="line-title"><b>@lang('auth.changepass')</b></p>
                                    @if (\Session::has('change_pass_success'))
                                        <div class="alert alert-success">
                                            <ul>
                                                <li>{!! \Session::get('change_pass_success') !!}</li>
                                            </ul>
                                        </div>
                                    @endif

                                    @if (\Session::has('change_pass_error'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li>{!! \Session::get('change_pass_error') !!}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" action="/changepass">
                                        @csrf
                                        <div class="change__password__body">
                                            <input name="current_password" class="form-control input-lg "
                                                   type="password" placeholder="@lang('auth.current_pass')" required="">
                                            <input name="new_password" class="form-control input-lg " type="password"
                                                   placeholder="@lang('auth.new_pass')" required="">
                                            <input name="confirm_password" class="form-control input-lg "
                                                   type="password" placeholder="@lang('auth.confirm_pass')" required="">
                                        </div>

                                        <button class="btn btn-blue btn-lg" type="submit">@lang('auth.changepass')</button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs2">
                                <ul class="nav nav-tabs tabs-li">
                                    <li class="active">
                                        <a data-toggle="tab" href="#tab1">@lang('Profile.menu_label2_tab1')</a></li>
                                    <li>
                                        <a data-toggle="tab" href="#tab2">@lang('Profile.menu_label2_tab2')</a></li>
                                    <li>
                                        <a data-toggle="tab" href="#tab3">@lang('Profile.menu_label2_tab3')</a></li>
                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane fade in active" id="tab1">
                                        <div class="row catalog">
                                            @foreach($user->orders as $item)
                                                @foreach($item->books as $book)
                                                    @if($book->pivot->type =='paper')
                                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                                            <div class="item-books">
                                                                <div class="img-book">
                                                                    @if($book->main_image() && $item->status)
                                                                        <img src="{{$book->main_image()->path}}">
                                                                        <div class="top-text-books bg-white">
                                                                            <i class="icons icon-make"></i>
                                                                            {{$item->status[$text]}}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <p class="text-grey fs-15"></p>
                                                                <p>
                                                                    {{$book->book_name}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2">
                                        <div class="top-catalog">
                                            <p class="text-green">
                                                <i class="icons ic-tel"></i>@lang('Profile.menu_label2_tab2_info')</p>
                                        </div>
                                        <div class="row catalog">
                                            @foreach($user->books as $item)
                                                @if($item->pivot->type =='ebook')
                                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                                        <div class="item-books">
                                                            <a target="_blank" href="#" style="pointer-events: none;" title="Тек мобильді қосымшада оқи аласыздар">
                                                                @if($item->main_image())
                                                                    <div class="img-book">
                                                                        <img src="{{$item->main_image()->path}}">
                                                                    </div>
                                                                @endif
                                                                <p class="text-grey fs-15">
                                                                    @include('includes.bookauthors',['authors'=>$item->authors])
                                                                </p>
                                                                <p>
                                                                    {{$item->book_name}}
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab3">
                                        <div class="top-catalog">
                                            <p class="text-green">
                                                <i class="icons ic-audio"></i>@lang('Profile.menu_label2_tab3_info')
                                            </p>
                                        </div>
                                        <div class="row catalog">
                                            @foreach($user->books as $item)
                                                @if($item->pivot->type=='audio')
                                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                                        <div class="item-books">
                                                            <div class="img-book">
                                                                <img src="{{$item->main_image()->path}}">
                                                            </div>
                                                            <p class="text-grey fs-15">@include('includes.bookauthors',['authors'=>$item->authors])</p>
                                                            <p>{{$item->book_name}}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!---------------------------------История заказов------------------------------------------>
                            <div class="tab-pane fade" id="tabs3">
                                <div class="table-responsive">
                                    <table class="table table-paument">
                                        <tr>
                                            <th>@lang('Profile.order_number')</th>
                                            <th>@lang('Profile.time')</th>
                                            <th>@lang('Profile.books')</th>
                                            <th>@lang('basket.deliverytitle')</th>
                                            <th>@lang('Profile.bookssum')</th>
                                            <th>@lang('basket.deliveryprice')</th>
                                            <th>Жалпы</th>
                                            <th>Статус</th>
                                        </tr>
                                        @foreach($orders as $order)
                                            @php $deliveryprice =$order->deliveryprice?$order->deliveryprice:0; @endphp
                                            <tr>
                                                <td class="text-nowrap">{{$order->order_id}}</td>
                                                <td class="text-nowrap">
                                                    {{$order->updated_at->format('d/m/Y')}}<br>
                                                    {{$order->updated_at->format('H:i:s')}}
                                                </td>
                                                <td class="text-green">
                                                    <?php
                                                    $books = OrderProducts::where('order_id', $order->order_id)->get()
                                                    ?>

                                                    @foreach($books as $key=>$book)

                                                        <a href="/book/{{$book->product_id}}">
                                                            @if(Book::where('book_id',$book->product_id)->first())
                                                                {{Book::where('book_id',$book->product_id)->first()->book_name}}
                                                            @else

                                                            @endif
                                                        </a>
                                                        ( <span style="color:#000">@lang('Profile.'.$book->type)
                                                            @if($book->type=='paper')
                                                                x {{$book->quantity}}
                                                            @endif
                                                            </span>)
                                                        @if($key!=count($books)-1),<br>@endif
                                                    @endforeach
                                                </td>
                                                <td class="text-nowrap">
                                                    @if($order->delivery_type)@lang('basket.'.$order->delivery_type)@endif
                                                </td>
                                                <td class="text-nowrap"><b>{{$order->total}} ₸</b></td>
                                                <td class="text-nowrap">
                                                    {{$deliveryprice}} ₸
                                                </td>
                                                <td class="text-nowrap">
                                                    {{$deliveryprice+$order->total}} ₸
                                                </td>

                                                <td class="text-nowrap">
                                                    @if($order->status)
                                                        @if($order->status_id==1)
                                                            @lang('order.paid')
                                                        @elseif($order->status_id==2)
                                                            @if($order->delivery_type == 'pickup')
                                                                @lang('order.waiting_pickup')
                                                            @else
                                                                @lang('order.waiting_delivery')
                                                            @endif
                                                        @elseif($order->status_id==3)
                                                            @lang('order.delivered')
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <!---END------------------------------------История заказов--------- ---------------------->
                            <!--------------------------------------Избранные------------------------------------------>
                            <div class="tab-pane fade" id="tabs4">
                                <div class="row catalog">
                                    @foreach($selected as $item)
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item-books">
                                                @if($item->book)
                                                    <a target="_blank" href="/book/{{$item->book["book_url"]}}">
                                                        <div class="img-book">
                                                            <img src="{{$item->book->main_image()->path}}">
                                                        </div>
                                                        <p class="text-grey fs-15"></p>
                                                        <p>{{$item->book->book_name}}</p>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!---END-------------------------------------------------- Избранные ---------------------->

                            <!--Подписки-->
                            <div class="tab-pane fade" id="tabs5">
                                <div class="row">
                                    @if($user->subscription)
                                        <div class="col-md-6">
                                            <div class="profile-subscr-block">
                                                <h3 class="profile-subscr-block-title">{{$user->subscription->subscription["title_$lang"]}}</h3>
                                                <p class="profile-subscr-block-text"><span class="text-pro-green">@lang('Profile.active')</span></p>
                                                <div class="profile-subscr-block-card">
                                                    <div class="profile-subscr-block-count">
                                                        <h3 class="profile-subscr-block-coin">{{$user->subscription->subscription->price}} ₸</h3>
                                                        <p class="profile-subscr-block-date">Активен до : {{$user->subscription->final_date}}</p>
                                                        @if($user->subscription->debiting_date > '0000-00-00' )
                                                            <p class="profile-subscr-block-date">Следующие списание: {{$user->subscription->debiting_date}}</p>
                                                        @endif
                                                    </div>
                                                    <img src="/img/icons/credit-card 1.png" alt="">
                                                </div>
                                            </div>
                                            <div class="profile-subscr-btns">
                                                <a href="/buy-subscription" class="view-btn">@lang('Profile.other_tarifs')</a>
                                                <a href="{{ route('unsubscribe',$user->user_id) }}" class="cancel-btn">Отменить подписку</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profile-subscr-block">
                                                <h3 class="profile-subscr-block-title">В вашу ежемесячную подписку входит:</h3>
                                                @if($user->subscription)
                                                    <ul class="profile-subscr-list">
                                                        @foreach(\App\Models\SubscriptionInformation::orderBy('sort')->get() as $key=>$value)
                                                            @if(array_key_exists($value->id, json_decode($user->subscription->subscription["description"],true)))
                                                                <li @if(json_decode($user->subscription->subscription["description"],true)[$value->id]) class="subscr-li-done" @else class="subscr-li-error" @endif><span>{{$value["title_$lang"]}}</span></li>
                                                            @else
                                                                <li  class="subscr-li-error"><span>{{$value["title_$lang"]}}</span></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        @if($user->last_subscription)
                                            <div class="col-md-6">
                                                <div class="profile-subscr-block">
                                                    <h3 class="profile-subscr-block-title">{{$user->last_subscription->subscription["title_$lang"]}}</h3>
                                                    <p class="profile-subscr-block-text">
                                                        @if($user->last_subscription->active)
                                                            <span class="text-pro-green">@lang('Profile.active')   </span>
                                                        @else
                                                            <span style="color:red">@lang('subscription.nonactive') </span>
                                                        @endif
                                                    </p>
                                                    <div class="profile-subscr-block-card">
                                                        <div class="profile-subscr-block-count">
                                                            <h3 class="profile-subscr-block-coin">{{$user->last_subscription->subscription->price}} ₸</h3>
                                                            <p class="profile-subscr-block-date">
                                                                Закончился {{date("d-m-Y", strtotime($user->last_subscription->final_date))}}
                                                            </p>
                                                        </div>
                                                        <img src="/img/icons/credit-card 1.png" alt="">
                                                    </div>
                                                </div>

                                                <div class="profile-subscr-btns">
                                                    <a href="/buy-subscription" class="view-btn">@lang('subscription.buy_again')</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile-subscr-block">
                                                    <h3 class="profile-subscr-block-title">@lang('subscription.contains')</h3>
                                                    <ul class="profile-subscr-list">
                                                        @foreach(\App\Models\SubscriptionInformation::orderBy('sort')->get() as $key=>$value)
                                                            @if(array_key_exists($value->id, json_decode($user->last_subscription->subscription["description"],true)))
                                                                <li @if(json_decode($user->last_subscription->subscription["description"],true)[$value->id]) class="subscr-li-done" @else class="subscr-li-error" @endif><span>{{$value["title_$lang"]}}</span></li>
                                                            @else
                                                                <li  class="subscr-li-error"><span>{{$value["title_$lang"]}}</span></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @else
                                            <div class="profile-subscr-btns">
                                                <a href="/buy-subscription" class="view-btn">@lang('Profile.see_tarifs')</a>
                                            </div>
                                        @endif
                                    @endif
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
    <script>
        //Изменить аватар
        $('#avatar').change(function () {
            formdata = new FormData();
            if ($(this).prop('files').length > 0) {
                file = $(this).prop('files')[0];
                formdata.append("avatar", file);
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '/uploadavatar',
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (result) {
                    $('#userphoto').attr("src", result);
                }
            });
        });
    </script>
@endpush
