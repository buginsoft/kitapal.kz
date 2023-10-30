@extends('admin.layouts.table')

@section('table_title','Жанр')
@section('breadcrumb','Жанр')

@section('add_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/genre/create" class="btn btn-success">Добавить</a>
    </div>
@endsection

@section('table')
    <table class="table table-bordered mb-4">
        <thead>
        <tr>
            <th style="width: 30px">№</th>
            <th>Название РУ</th>
            <th>Название КЗ</th>
            <th>Показать в шапке</th>
            <th>Первая книга</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($genre as $value)
            <tr>
                <td>{{ $value->genre_id }}</td>
                <td>{{ $value->genre_name_ru }}</td>
                <td>{{ $value->genre_name_kz }}</td>
                <td>@if($value->showonheader )Да @else Нет @endif</td>
                <td>
                    <form id="top_book_id{{$value->genre_id}}" action="/admin/genre/{{$value->genre_id}}" method="post">
                        @csrf
                        @method('put')
                        <select name="top_book_id" class="form-control" onchange="$('#top_book_id{{$value->genre_id}}').submit()">
                            <option value="0">Не выбран</option>
                            @foreach($value->books as $book)
                                <option value="{{$book->book_id}}" @if( \App\Models\BookGenre::where([['bg_genre_id',$value->genre_id],['is_first_book',1]])->first() && \App\Models\BookGenre::where([['bg_genre_id',$value->genre_id],['is_first_book',1]])->first()->bg_book_id==$book->book_id) selected @endif>{{$book->book_name}}</option>
                            @endforeach
                        </select>
                    </form>
                </td>
                <td>
                    <a href="javascript:void(0)"
                       onclick="remove(this,'{{ $value->genre_id }}','genre')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </td>
                <td>
                    <a href="/admin/genre/{{ $value->genre_id }}/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
