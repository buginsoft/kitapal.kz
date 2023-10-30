@extends('admin.layouts.table')

@section('table_title','Автор')
@section('breadcrumb','Автор')
@section('add_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/author/create" class="btn btn-success">Добавить</a>
    </div>
@endsection
@section('table')
    @include('admin.includes.search',['base_url'=>'/admin/author'])

    <table class="table table-bordered mb-4">
        <thead>
        <tr>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th>Название РУ</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($author as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name_kz }}</td>
                <td>
                    <a href="javascript:void(0)"
                       onclick="remove(this,'{{ $value->id }}','author')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </td>
                <td>
                    <a href="/admin/author/{{ $value->id }}/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$author->links()}}
@endsection

