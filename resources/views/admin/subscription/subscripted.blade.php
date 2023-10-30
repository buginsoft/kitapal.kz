@extends('admin.layouts.table')

@section('table_title','Подписчики')
@section('breadcrumb','Подписчики')

@section('table')
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th>Логин</th>
            <th>Тип</th>
            <th>Статус</th>
            <th>Дата начало</th>
            <th>Дата окончания</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>
                <form action="" method="get">
                    <input type="text" name="user_name">
                    <button type="submit">Искать</button>
                </form>
            </td>
            <td></td>
            <td>
                <form action="" method="get"  id="filter-form">
                    <select name="type" id="type-select">
                        <option value="2" @if(request()->has('type') && request()->type==2) selected @endif>Все</option>
                        <option value="1" @if(request()->has('type') && request()->type==1) selected @endif>Активные</option>
                        <option value="0" @if(request()->has('type') && request()->type==0) selected @endif>Неактивные</option>
                    </select>
                </form>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        @foreach ($list as $value)
            <tr>
                <td title="{{$value->id}}">{{ $value->user?$value->user->user_name:'' }}</td>
                <td>{{ $value->subscription->name_ru }}</td>
                <td>{{ $value->active?'Активный':'Неактивный' }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->final_date }}</td>
                <td>
                    @if($value->active)
                        <form action="/admin/user_subscription/{{$value->id}}" method="post">
                            @csrf
                            @method('put')
                            <select name="subscription_id" >
                                @foreach(\App\Models\Subscription::all() as $subscription)
                                    <option value="{{$subscription->id}}">{{$subscription->title_kz}}</option>
                                @endforeach
                            </select>
                            <button type="submit">Изменить</button>
                        </form>
                    @endif
                </td>
                <td>
                    @if($value->active)
                        <form action="/admin/user_subscription/{{$value->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Удалить</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$list->appends(request()->input())->links()}}

@endsection
@section('page_level_js')
    <script>
        $(document).ready(function () {
            $('#type-select').on('change', function () {
                $('#filter-form').submit();
            });
        });
    </script>
@endsection