@extends('admin.layouts.table')
@section('table_title','Сообщений')
@section('breadcrumb','Сообщений')
@section('table')
    <table id="showed" class="table table-bordered table-striped">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th>Email</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Проблема</th>
            <th>Дата подачи</th>
            <th>Удалить</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($problem as $key => $value)
            <tr>
                <td>{{ $value->problem_id }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->phone }}</td>
                <td>{{ $value->problem_text }}</td>
                <td>{{ $value->created_at }}</td>
                <td>
                    <a href="javascript:void(0)"
                       onclick="remove(this,'{{ $value->problem_id }}','user_problem')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$problem->links()}}
@endsection
