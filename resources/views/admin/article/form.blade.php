@extends('admin.layouts.form')

@section('form_title','Добавить статью')
@section('breadcrumb','Добавить статью')

@section('preview_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/article" class="btn btn-danger">Назад</a>
    </div>
@endsection

@section('css')
    <link href="/new_admin_design/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('form')
    <form  action="{{$action}}" method="POST" enctype="multipart/form-data">
        @if(!empty($article))
            @method('PUT')
        @endif
        @csrf
        <div class="widget-content widget-content-area simple-pills">

            <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-russian-tab" data-toggle="pill" href="#pills-russian" role="tab"
                       aria-controls="pills-russian" aria-selected="true">Русский</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-kz-tab" data-toggle="pill" href="#pills-kz" role="tab"
                       aria-controls="pills-kz" aria-selected="false">Казахский</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-russian" role="tabpanel" aria-labelledby="pills-russian-tab">
                    @include('form.input' , ['label'=>'Название','type'=>'text','name'=>'title_ru' ,'value'=>!empty($article)?$article->title_ru:old('title_ru') ])
                    @include('form.textarea' , ['label'=>'Текст','name'=>'text_ru' , 'id'=>'editor1' , 'class'=>'ckeditor','value'=>!empty($article)?$article->text_ru:old('text_ru') ])
                    @include('form.textarea' , ['label'=>'Краткий текст','name'=>'short_text_ru' , 'id'=>'editor2' , 'class'=>'ckeditor','value'=>!empty($article)?$article->short_text_ru:old('short_text_ru') ])
                </div>

                <div class="tab-pane fade" id="pills-kz" role="tabpanel" aria-labelledby="pills-kz-tab">
                    @include('form.input' , ['label'=>'Название','type'=>'text','name'=>'title_kz' ,'value'=>!empty($article)?$article->title_kz:old('title_kz') ])
                    @include('form.textarea' , ['label'=>'Текст','name'=>'text_kz' , 'id'=>'editor3' , 'class'=>'ckeditor','value'=>!empty($article)?$article->text_kz:old('text_kz') ])
                    @include('form.textarea' , ['label'=>'Краткий текст','name'=>'short_text_kz' , 'id'=>'editor4' , 'class'=>'ckeditor','value'=>!empty($article)?$article->short_text_kz:old('short_text_kz') ])
                </div>

            </div>
            @include('admin.includes.fileupload', ['name' => 'book_image'])
        </div>

            <div class="form-group">
                <label class="new-control new-checkbox checkbox-primary">
                    <input type="checkbox" class="new-control-input" value="1" name="send_push">
                    <span class="new-control-indicator"></span>Отправить уведомление
                </label>
            </div>
        <div class="col-lg-8 col-md-12 text-right">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@endsection


@section('page_level_js')
    <script>
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        @if(!empty($article))
        $(".custom-file-container__image-preview").css("background-image", "url({{$article->image}})");
        @endif
    </script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.replace("editor1");
        CKEDITOR.replace("editor2");
        CKEDITOR.replace("editor3");
        CKEDITOR.replace("editor4");
        CKEDITOR.config.filebrowserUploadUrl = '{{route('ckeditor.upload', ['_token' => csrf_token() ])}}';
    </script>
@endsection
