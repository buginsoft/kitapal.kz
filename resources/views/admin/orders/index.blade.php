@extends('admin.layouts.layout')

@section('css')
    <style>
        .citystrong{
            font-weight: bold;
        }
        thead tr th{
            font-size:14px;
        }
    </style>
@endsection

@section('breadcrumb','Заказы')
@section('content')
    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Заказы</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <form class="form-inline" action="/admin/orders" method="get">
                            <div class="form-group">
                                <select name="delivery_type" class="form-control">
                                    <option value="all">Все</option>
                                    <option {{(isset($_GET['delivery_type']) && $_GET['delivery_type']=='courier')?'selected':''}} value="courier">Курьер</option>
                                    <option {{(isset($_GET['delivery_type']) && $_GET['delivery_type']=='pickup')?'selected':''}} value="pickup">Самовывоз</option>
                                    <option {{(isset($_GET['delivery_type']) && $_GET['delivery_type']=='post')?'selected':''}} value="post">Почта</option>
                                    <option {{(isset($_GET['delivery_type']) && $_GET['delivery_type']=='null')?'selected':''}} value="null">Электронная книга</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control btn btn-primary ml-2" type="submit" value="Показать">
                            </div>
                        </form>

                        <form class="form-inline" action="/admin/orders" method="get">
                            <div class="form-group">
                                <input class="form-control" type="number" name="order_id" value="{{(isset($_GET['order_id'])?$_GET['order_id']:'')}}" placeholder="Поиск по номеру заказа">
                            </div>
                            <div class="form-group">
                                <input class="form-control btn btn-primary ml-2" type="submit" value="Показать">
                            </div>

                            <a  class="form-control btn btn-primary ml-2" href="/admin/orders">Очистить</a>
                        </form>
                    </div>


                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4" >
                                <thead>
                                <tr>
                                    <th>Номер</th>
                                    <th>Имя</th>
                                    <th>Способ доставки</th>
                                    <th>Книги</th>
                                    <th>Цена книги</th>
                                    <th>Доставка</th>
                                    <th>Итог</th>
                                    <th>Дата</th>
                                    <th>Телефон</th>
                                    <th>Статус</th>
                                    <th>Адрес</th>
                                    <th>Промокод</th>
                                    <th>Действие</th>
                                    <th>Комментарий</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $value)
                                    <tr>
                                        <td style="padding:0px">{{ $value->order_id }}</td>
                                        <td>
                                            @if($value->user_id && $value->user)
                                                {{ $value->user["user_name"] }}
                                            @else
                                                {{ $value->user_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->delivery_type=='pickup')
                                                самовывоз
                                            @elseif($value->delivery_type=='courier')
                                                курьер
                                            @elseif($value->delivery_type=='post')
                                                почта
                                            @else
                                                электронная книга
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($value->books as $book)

                                                {{$book->book_name.' - '.$value->order_product($book)->quantity.' шт ('.__('book.'.$book->pivot->type).') -'.$value->order_product($book)->unitprice.' тг'}}

                                                {!!  $loop->last ? '' : ',<br>' !!}
                                            @endforeach
                                        </td>
                                        <td>{{ $value->total }}тг</td>
                                        <td>{{ ($value->deliveryprice)?$value->deliveryprice:0 }}тг</td>
                                        <td>
                                            {{ $value->total+$value->deliveryprice }}тг
                                            @if($value->promocode_id)
                                                Итог с промокодом
                                                {{ $value->price_with_promocode+$value->deliveryprice }}тг
                                            @endif
                                        </td>
                                        <td>{{ $value->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td>
                                            @if($value->user_id && $value->user)
                                                {{ $value->user["phone"] }}
                                            @else
                                                {{ $value->user_phone }}
                                            @endif
                                        </td>
                                        <td>{{ $value->status?$value->status['text']:''}}</td>
                                        <td>
                                            @if($value->delivery_type && $value->delivery_type!='pickup')
                                                @if($value->user)
                                                    @if($value->address_id)

                                                        <span class="citystrong">Город:</span>
                                                        @if($value->address->citytitle)
                                                            {{ $value->address->citytitle['text_ru'] }}
                                                        @endif
                                                        <br>
                                                        @if($value->address["street"])
                                                            <span class="citystrong">Улица:</span>{{ $value->address["street"] }}<br>
                                                        @endif
                                                        <span class="citystrong">Дом:</span>{{ $value->address["home"] }}<br>
                                                        <span class="citystrong">Подезд:</span>{{ $value->address["podezd"] }}<br>
                                                        <span class="citystrong">Квартира:</span>{{ $value->address["kvartira"] }}<br>
                                                        <span class="citystrong">Нас пункт:</span>{{ $value->address["naselenny_punkt"] }}<br>
                                                        <span class="citystrong">Индекс:</span>{{ $value->address["post_index"] }}

                                                    @else
                                                        <span class="citystrong">Город:</span>
                                                        @if($value->user && $value->user->address && $value->user->address->citytitle)
                                                            {{ $value->user->address->citytitle['text_ru'] }}
                                                        @endif
                                                        <br>
                                                        @if($value->user && $value->user->address["street"])
                                                            <span class="citystrong">Улица:</span>{{ $value->user->address["street"] }}<br>
                                                        @endif
                                                        <span class="citystrong">Дом:</span>{{ $value->user->address["home"] }}<br>
                                                        <span class="citystrong">Подезд:</span>{{ $value->user->address["podezd"] }}<br>
                                                        <span class="citystrong">Квартира:</span>{{ $value->user->address["kvartira"] }}<br>
                                                        <span class="citystrong">Нас пункт:</span>{{ $value->user->address["naselenny_punkt"] }}<br>
                                                        <span class="citystrong">Индекс:</span>{{ $value->user->address["post_index"] }}
                                                    @endif
                                                @else
                                                    <span class="citystrong">Город:</span>
                                                    @if($value->address && $value->address->citytitle)
                                                        {{ $value->address->citytitle['text_ru'] }}
                                                    @endif
                                                    <br>
                                                    @if(isset($value->address["street"]))
                                                        <span class="citystrong">Улица:</span>{{ $value->address["street"] }}<br>
                                                    @endif
                                                    @if(isset($value->address["home"]))
                                                        <span class="citystrong">Дом:</span>{{ $value->address["home"] }}<br>
                                                    @endif
                                                    @if(isset($value->address["podezd"]))
                                                        <span class="citystrong">Подезд:</span>{{ $value->address["podezd"] }}<br>
                                                    @endif
                                                    @if(isset($value->address["kvartira"]))
                                                        <span class="citystrong">Квартира:</span>{{ $value->address["kvartira"] }}<br>
                                                    @endif
                                                    @if(isset($value->address["naselenny_punkt"]))
                                                        <span class="citystrong">Нас пункт:</span>{{ $value->address["naselenny_punkt"] }}<br>
                                                    @endif
                                                    @if(isset($value->address["post_index"]))
                                                        <span class="citystrong">Индекс:</span>{{ $value->address["post_index"] }}
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->promocode_id)
                                                {{$value->promocode->code}}-{{$value->promocode->percentage.'%'}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->status && $value->status['id']===1)
                                                <a class="btn btn-info" href="/admin/acceptOrder/{{$value->order_id}}">Принять</a>
                                            @elseif($value->status && $value->status['id']===2)
                                                @if($value->delivery_type=='pickup')
                                                    <a class="btn btn-info" href="/admin/delivered/{{$value->order_id}}">Забрали</a>
                                                @else
                                                    <a class="btn btn-info" href="/admin/delivered/{{$value->order_id}}">Доставить</a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $value->order_comment}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function mySubmit(theForm) {
            $.ajax({ // create an AJAX call...
                data: $(theForm).serialize(), // get the form data
                type: $(theForm).attr('method'), // GET or POST
                url: $(theForm).attr('action'), // the file to call
                success: function (response) { // on success..
                    if(response=='true'){
                        alert('Успешно');
                    }
                    else{
                        alert('Что то не так');
                    }
                }
            });
        }
    </script>
@endsection
