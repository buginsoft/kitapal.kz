@extends('admin.layouts.table')


@section('table_title','Подборка')
@section('breadcrumb','Подборка')

@section('add_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/collection/create" class="btn btn-success">Добавить</a>
    </div>
@endsection

@section('table')

    <table class="table table-bordered mb-4">
        <thead>
        <tr>
            <th style="width: 30px">№</th>
            <th>Название(ru)</th>
            <th>Название(kz)</th>
            <th>Место</th>
            <th>Иконка</th>
            <th>Цвет</th>
            <th>Показать значок</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($collection as $value)
            <tr>
                <td>{{ $value->collection_id }}</td>
                <td>{{ $value->collection_name_ru }}</td>
                <td>{{ $value->collection_name_kz }}</td>
                <td>{{ $value->sort_num }}</td>
                <td><img  style="width:90px;height:90px" src="{{ $value->icon }}"></td>
                <td>{{ $value->color }}</td>
                <td>@if($value->show_badge )Да @else Нет @endif</td>
                <td>
                   @include('includes.delete_form',['action'=>"/admin/collection/$value->collection_id"])
                </td>
                <td>
                    <a href="/admin/collection/{{ $value->collection_id }}/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
