@extends('admin.layouts.table')

@section('table_title','Пользователи')
@section('breadcrumb','Пользователи')
@section('add_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/users/create" class="btn btn-success">Добавить</a>
    </div>
    <div class="col-3 text-right">

        <form  action="/admin/export/users"  method="get"  style="display:flex;">
            <select name="range" class="form-control" style="max-width: 150px;display:flex;">
                @for($i=0; $i<\App\Models\User::count(); $i=$i+15000)
                    @if($i==0)
                        <option value="15000">0-15000</option>
                    @else
                        <option value="{{$i+15000}}">{{$i}}-{{$i+15000}}</option>
                    @endif
                @endfor
            </select>
            <button  type="submit" class="btn btn-primary">Экспорт</button>
        </form>
    </div>
@endsection

@section('table')
    @include('admin.includes.search',['base_url'=>'/admin/users'])

    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th>Фото</th>
            <th>Логин</th>
            <th>Телефон</th>
            <th>Эл книги пользователя</th>
            <th>Добавить подписку</th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach ($users as $value)
            <tr>
                <td>{{ $value->user_id }}</td>
                <td>{{ $value->user_name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->phone }}</td>
                <td><a href="/admin/userEbooks?user_id={{$value->user_id}}">Посмотреть</a></td>
                <td>

                    @if(is_null($value->subscription))
                        <form action="/buy-subscription" method="post">
                            @csrf
                            <input type="hidden" name="manually" value="1">
                            <input type="hidden" name="to_user" value="{{$value->user_id}}">
                            <select name="subscription_id">
                                @foreach(\App\Models\Subscription::orderBy('sort_num')->get() as $subscription)
                                    <option value="{{$subscription->id}}">{{$subscription->name_ru}}</option>
                                @endforeach
                            </select>
                            <button type="submit">Добавить</button>
                        </form>
                    @endif
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="remove(this,'{{ $value->user_id }}','users')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </td>
                <td>
                    <a href="/admin/users/{{ $value->user_id }}/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection
