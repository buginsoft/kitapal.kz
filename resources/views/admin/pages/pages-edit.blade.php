@extends('admin.layouts.form')

@section('form_title' ,'Добавить страницу')
@section('breadcrumb' ,'Добавить страницу')

@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/pages" class="btn btn-danger">Назад</a>
    </div>
@endsection

@section('form')
    <form  action="{{$action}}" method="POST" >
        @if($method=='PUT') @method('PUT') @endif
        @csrf
        <div class="widget-content widget-content-area simple-pills">
            <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-russian-tab" data-toggle="pill"
                       href="#pills-russian" role="tab" aria-controls="pills-russian" aria-selected="true">Русский</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-kz-tab" data-toggle="pill" href="#pills-kz"
                       role="tab" aria-controls="pills-kz" aria-selected="false">Казахский</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-russian" role="tabpanel" aria-labelledby="pills-russian-tab">

                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" name="page_name_ru"
                               value="{{ !empty($page) ? $page->page_name_ru : old('page_name_ru') }}"/>
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea  id="editor1" class="form-control" name="page_content_ru">
                            {{ !empty($page) ? $page->page_content_ru : old('page_content_ru') }}
                        </textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-kz" role="tabpanel" aria-labelledby="pills-kz-tab">

                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" name="page_name_kz"
                               value="{{ !empty($page) ? $page->page_name_kz : old('page_name_kz') }}"/>
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea id="editor2" class="form-control" name="page_content_kz">
                            {{ !empty($page) ? $page->page_content_kz : old('page_content_kz') }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 text-right">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@endsection
@section('page_level_js')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.extraPlugins = 'uploadimage';
        CKEDITOR.replace("editor1");
        CKEDITOR.replace("editor2");
        CKEDITOR.config.filebrowserUploadUrl = '{{route('ckeditor.upload', ['_token' => csrf_token() ])}}';
    </script>
@endsection
