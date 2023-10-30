@extends('admin.layouts.form')
@section('breadcrumb','')
@section('form_title' ,'')
@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/subscription-information" class="btn btn-danger">Назад</a>
    </div>
@endsection
@section('form')
    <form  action="/admin/subscription-information/{{$item->id}}" method="POST">
        @method('PUT')
        @csrf
        <input type="text" name="title_ru" class="form-control" value="{{$item->title_ru}}">
        <input type="text" name="title_kz" class="form-control" value="{{$item->title_kz}}">
        <input type="number" name="sort" class="form-control" value="{{$item->sort}}">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection