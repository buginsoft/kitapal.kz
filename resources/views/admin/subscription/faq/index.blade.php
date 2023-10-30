@extends('admin.layouts.table')

@section('table_title','Подписки FAQ')
@section('breadcrumb','Подписки FAQ')

@section('table')
    <a class="btn btn-primary mb-2" href="/admin/subscription-faq/create">Добавить</a>
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th>Название</th>
            <th>Порядок</th>
            <th>Изменить</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($list as $value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->order}}</td>
                <td class="d-flex">
                    <a  class="btn btn-primary" href="/admin/subscription-faq/{{$value->id}}/edit">Изменить</a>
                    <form action="/admin/subscription-faq/{{$value->id}}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
