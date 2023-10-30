@extends('admin.layouts.table')

@section('table_title','Подписки')
@section('breadcrumb','Подписки')

@section('table')
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th>Название ру</th>
            <th>Название кз</th>
            <th>Продолжительность ру</th>
            <th>Продолжительность кз</th>
            <th>Цена</th>
            <th>Изменить описание</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($list as $value)
            <tr>
                <td>
                    <form id="title_ru" action="/admin/subscription/{{$value->id}}" method="post">
                        @csrf
                        @method('put')
                        <input class="form-control" name="title_ru" type="text" value="{{ $value->title_ru }}" onkeyup="$('#title_ru').submit();">
                    </form>
                </td>
                <td>
                    <form id="title_kz" action="/admin/subscription/{{$value->id}}" method="post">
                        @csrf
                        @method('put')
                        <input class="form-control" name="title_kz" type="text" value="{{ $value->title_kz }}" onkeyup="$('#title_kz').submit();">
                    </form>
                </td>
                <td>{{ $value->name_ru }}</td>
                <td>{{ $value->name_kz }}</td>
                <td>
                    <form  action="/admin/subscription/{{$value->id}}" method="post">
                        @csrf
                        @method('put')
                        <input class="form-control" name="price" type="number" value="{{ $value->price }}">
                        <input type="submit" value="Изменить">
                    </form>
                </td>
                <td>
                    <a  class="btn btn-primary" href="/admin/subscription/{{$value->id}}/edit">Изменить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
