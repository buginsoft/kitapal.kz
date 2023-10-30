@extends('admin.layouts.form')

@section('form_title','Изменить автора')
@section('breadcrumb','Изменить автора')

@section('add_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/author" class="btn btn-danger">Назад</a>
    </div>
@endsection

@section('form')
    <form  action="{{$action}}" method="POST" enctype="multipart/form-data">
        @if(!empty($author))
            @method('put')
        @endif
        @csrf
        <div class="widget-content widget-content-area simple-pills">
            <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-russian-tab" data-toggle="pill" href="#pills-russian"
                       role="tab" aria-controls="pills-russian" aria-selected="true">Русский</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-kz-tab" data-toggle="pill" href="#pills-kz"
                       role="tab" aria-controls="pills-kz" aria-selected="false">Казахский</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-russian" role="tabpanel" aria-labelledby="pills-russian-tab">
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" class="form-control" name="name_ru" value="{{!empty($author)?$author->name_ru:''}}"/>
                    </div>
                    <div class="form-group">
                        <label>Биография</label>
                        <textarea name="description_ru"  id="editor1" class="form-control">{{!empty($author)?$author->description_ru:''}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Дереккөз</label>
                        <textarea name="source_ru" id="editor2" class="form-control">{{!empty($author)?$author->source_ru:''}}</textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-kz" role="tabpanel" aria-labelledby="pills-kz-tab">
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" class="form-control" name="name_kz" value="{{!empty($author)?$author->name_kz:''}}" />
                    </div>
                    <div class="form-group">
                        <label>Биография</label>
                        <textarea name="description_kz" id="editor3" class="form-control">{{!empty($author)?$author->description_kz:''}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Дереккөз</label>
                        <textarea name="source_kz" id="editor4" class="form-control">{{!empty($author)?$author->source_kz:''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Facebook</label>
                <input type="text" class="form-control" name="facebook" value="{{!empty($author)?$author->facebook:''}}"/>
            </div>
            <div class="form-group">
                <label>Instagram</label>
                <input type="text" class="form-control" name="instagram" value="{{!empty($author)?$author->instagram:''}}"/>
            </div>
            <div class="form-group">
                <label>VK</label>
                <input type="text" class="form-control" name="vk" value="{{!empty($author)?$author->vk:''}}"/>
            </div>
            <div class="form-group">
                <label>Telegram</label>
                <input type="text" class="form-control" name="telegram" value="{{!empty($author)?$author->telegram:''}}"/>
            </div>
            <div class="form-group">
                <label>Twitter</label>
                <input type="text" class="form-control" name="twitter" value="{{!empty($author)?$author->twitter:''}}"/>
            </div>

            @include('admin.includes.fileupload', ['name' => 'author_photo'])

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
        let upload_file_poster = new FileUploadWithPreview('myFirstImage');
        @if(!empty($author))
        $(".custom-file-container__image-preview").css("background-image", "url({{$author->author_photo}})");
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

