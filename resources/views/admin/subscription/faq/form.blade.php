@extends('admin.layouts.form')
@section('breadcrumb','')
@section('form_title' ,'')
@section('page_level_css')
    <script src="/new_admin_design/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/ckeditor4/ckeditor.js?v=7"></script>
    <script src="/ckeditor4/samples/js/sample.js?v=5"></script>
    <link rel="stylesheet" href="/ckeditor4/samples/css/samples.css">
@endsection
@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/subscription-faq" class="btn btn-danger">Назад</a>
    </div>
@endsection
@section('form')
    <form  action="{{$action}}" method="post">
        @csrf
        @if(isset($item))
        @method('PUT')
        @endif
        <input type="text" name="name" class="form-control mb-2"  @if(isset($item)) value="{{$item->content->title_ru}}" @endif placeholder="название">
        <input type="text" name="title_ru" class="form-control mb-2" @if(isset($item)) value="{{$item->content->title_ru}}" @endif placeholder="заголовок(ру)">
        <input type="text" name="title_kz" class="form-control mb-2" @if(isset($item)) value="{{$item->content->title_kz}}" @endif placeholder="заголовок(кз)">

            @include('form.textarea' , ['label'=>'текст(ру)','name'=>'content_ru' , 'class'=>'ckeditor4','value'=>isset($item)?$item->content->content_ru:null ])
            @include('form.textarea' , ['label'=>'текст(кз)','name'=>'content_kz' , 'class'=>'ckeditor4','value'=>isset($item)?$item->content->content_kz:null ])

        <input type="number" name="order" class="form-control" @if(isset($item)) value="{{$item->order}}" @endif placeholder="порядок">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
@section('page_level_js')
    <script>
        initSample();
    </script>
@endsection
