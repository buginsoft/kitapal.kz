@extends('admin.layouts.form')

@section('form_title',$title)
@section('breadcrumb',$title)

@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/genre" class="btn btn-danger">Назад</a>
    </div>
@endsection

@section('form')
    <form  action="{{$action}}" method="POST" enctype="multipart/form-data">
        <input name="showonheader" type="hidden"  value="0">
        @if(!empty($genre))
            @method('PUT')
        @endif
        @csrf
        <div class="widget-content widget-content-area simple-pills">
            <div class="form-group">
                <label>Название(ru)</label>
                <input type="text" class="form-control" name="genre_name_ru" value="{{ !empty($genre) ? $genre->genre_name_ru : old('genre_name_ru') }}" />
            </div>
            <div class="form-group">
                <label>Название(kz)</label>
                <input type="text" class="form-control" name="genre_name_kz" value="{{ !empty($genre) ? $genre->genre_name_kz : old('genre_name_kz') }}" />
            </div>
            <div class="form-group">
                <label class="new-control new-checkbox checkbox-primary">
                    <input name="showonheader" type="checkbox" class="new-control-input" value="1"  @if(!empty($genre) && ($genre->showonheader)) checked @endif>
                    <span class="new-control-indicator"></span>Показать в шапке
                </label>
            </div>
            <div class="form-group">
                <label>Сортировка</label>
                <input type="number" class="form-control" name="sort_num"
                       value="{{ !empty($genre) ? $genre->sort_num : old('sort_num') }}" />
            </div>
            @include('admin.includes.fileupload', ['name' => 'genre_image'])
            <div class="col-lg-8 col-md-12 text-right">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('page_level_js')
    <script>
        let upload_file_poster = new FileUploadWithPreview('myFirstImage');
        @if(!empty($genre))
        $(".custom-file-container__image-preview").css("background-image", "url({{$genre->genre_image}})");
        @endif
    </script>
@endsection



