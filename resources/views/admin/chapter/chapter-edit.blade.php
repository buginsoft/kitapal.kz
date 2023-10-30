@extends('admin.layouts.form')

@section('form_title','Добавить содержание')
@section('breadcrumb','Добавить содержание')

@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/chapter" class="btn btn-danger">Назад</a>
    </div>
@endsection
@section('form')
    @if(empty($chapter))
        <form class="col-lg-12 col-md-12 row" action="/admin/chapter" method="POST">
            @else
                <form class="col-lg-12 col-md-12 row" action="/admin/chapter/{{ $chapter->chapter_id }}" method="POST">
                    @method('PUT')
                    @endif
                    @csrf

                    <div class="widget-content widget-content-area simple-pills">
                        <div class="form-group">
                            <label>К книге</label>
                            <select name="ch_book_id" class="form-control">
                                @include('admin.layouts.book')
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" class="form-control" name="chapter_name"
                                   value="{{ !empty($chapter) ? $chapter->chapter_name : old('chapter_name') }}" />
                        </div>
                        <div class="form-group">
                            <label>Время</label>
                            <input id="time" type="text" class="form-control"  name="chapter_time"
                                   value="{{ !empty($chapter) ? $chapter->chapter_time : old('chapter_time') }}" />
                        </div>
                        <div class="form-group">
                            <label>Сортировка</label>
                            <input type="number" class="form-control" name="sort_num"
                                   value="{{ !empty($chapter) ? $chapter->sort_num : old('sort_num') }}" />
                        </div>

                        <div class="col-lg-8 col-md-12 text-right">
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </form>
@endsection
@section('page_level_js')
                    <script src="/js/masking-input.js"></script>
    <script>
        var selector = document.getElementById("time");

        var im = new Inputmask("99:99:99");
        im.mask(selector);
    </script>
    @endsection
