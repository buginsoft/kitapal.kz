@extends('admin.layouts.table')

@section('add_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/promocodes/create" class="btn btn-success">Добавить</a>
    </div>
@endsection

@section('table_title','Промокоды')
@section('breadcrumb','Промокоды')

@section('table')
    <table class="table table-bordered mb-4">
        <thead>
        <tr>
            <th style="width: 30px">Название</th>
            <th>Код</th>
            <th>Процент</th>
            <th>Многоразовое</th>
            <th>Количество</th>
            <th>Статус</th>
            <th>Использовано</th>
            <th>Истечет</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach ($promos as $value)
            <tr>
                <td>{{ $value->title }}</td>
                <td>{{ $value->code }}</td>
                <td>{{ $value->percentage }}</td>
                <td>{{ $value->reuseable?'Да':'Нет' }}</td>
                <td>{{ $value->quantity }}</td>
                <td>{{ $value->status?'Активно':'Неактивно' }}</td>
                <td>{{ $value->used_quantity() }}</td>
                <td>{{ $value->expire }}</td>
                <td>
                    <a href="/admin/promocodes/{{$value->id}}/edit">Изменить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
