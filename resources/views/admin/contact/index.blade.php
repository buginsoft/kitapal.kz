@extends('admin.layouts.form')
@section('form_title','Контакты')
@section('breadcrumb','Контакты')
@section('page_level_css')
    <script src="/new_admin_design/assets/js/libs/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/ckeditor4/samples/css/samples.css">
@endsection
@section('form')
    <div class="widget-content widget-content-area simple-pills">
        <form action="/admin/contacts/{{ $contact->id }}" method="POST" id="createForm" >
            @csrf
            @method('put')
            <div class="form-group">
                <label>Ватсап</label>
                <input type="text" class="form-control" name="phone" value="{{$contact->phone}}" />
            </div>
            <div class="form-group">
                <label>Почта</label>
                <input type="text" class="form-control" name="email" value="{{$contact->email}}"/>
            </div>

            @include('form.textarea' , ['id'=>'editor1' , 'label'=>'Телефон','name'=>'contact2' , 'value'=>$contact->contact2 , ])
            @include('form.textarea' , ['id'=>'editor2' ,'label'=>'Адрес самовывоза(kz)','name'=>'pickup_address_ru' , 'value'=>$contact->pickup_address_ru])
            @include('form.textarea' , ['id'=>'editor3' , 'label'=>'Адрес самовывоза(ru)','name'=>'pickup_address_kz' , 'value'=>$contact->pickup_address_kz])

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Изменить</button>
            </div>
        </form>
    </div>
@endsection

@section('page_level_js')

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.replace("editor1");
        CKEDITOR.replace("editor2");
        CKEDITOR.replace("editor3");
        CKEDITOR.config.filebrowserUploadUrl = '{{route('ckeditor.upload', ['_token' => csrf_token() ])}}';
    </script>
@endsection
