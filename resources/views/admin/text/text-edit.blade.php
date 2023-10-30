@extends('admin.layouts.layout')

@section('css')
<style>
    .active-top-show {
        background-color: #fff !important;
    }

    #nav-tabContent {
        padding-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">
                    Добавить текст
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/text" class="btn btn-danger">Назад</a>
            </div>
        </div>
        <div class="row">
            @if(empty($text))
            <form class="col-lg-12 col-md-12 row" action="/admin/text" method="POST">
                @else
                <form class="col-lg-12 col-md-12 row" action="/admin/text/{{ $text->text_id }}" method="POST">
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-block">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Название(ru)</label>
                                        <input type="text" class="form-control" name="title_ru" value="{{ !empty($text) ? $text->title_ru : old('title_ru') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Название(kz)</label>
                                        <input type="text" class="form-control" name="title_kz" value="{{ !empty($text) ? $text->title_kz : old('title_kz') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Название(en)</label>
                                        <input type="text" class="form-control" name="title_en" value="{{ !empty($text) ? $text->title_en : old('title_en') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Текст(ru)</label>
                                        <textarea name="text_ru"
                                                  class="ckeditor form-control">{{ !empty($text) ? $text->text_ru : old('text_ru') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Текст(kz)</label>
                                        <textarea name="text_kz"
                                                  class="ckeditor form-control">{{ !empty($text) ? $text->text_kz : old('text_kz') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Текст(en)</label>
                                        <textarea name="text_en"
                                                  class="ckeditor form-control">{{ !empty($text) ? $text->text_en : old('text_en') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Место</label>
                                        <select name="text_place" class="form-control">
                                            <option value="1" {{ !empty($text) && $text->text_place == 1 ? 'selected':'' }}>Подписка(ваша подписка ак...)</option>
                                            <option value="2" {{ !empty($text) && $text->text_place == 2 ? 'selected':'' }}>Подписка(скачивайте и слуш...)</option>
                                            <option value="3" {{ !empty($text) && $text->text_place == 3 ? 'selected':'' }}>О приложении</option>
                                            <option value="4" {{ !empty($text) && $text->text_place == 4 ? 'selected':'' }}>Бесплатная подписка</option>
                                        </select>
                                    </div>
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
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection