@extends('admin.layouts.form')

@section('form_title',$title)
@section('breadcrumb',$title)

@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/slider" class="btn btn-danger">Назад</a>
    </div>
@endsection

@section('page_level_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2{
            width: 100% !important;
        }
    </style>
@endsection
@section('form')
    <form action="{{$action}}" method="POST" enctype="multipart/form-data">
        @if(!empty($slider))
            @method('PUT')
        @endif
        @csrf
        <div class="widget-content widget-content-area simple-pills">




            <div class="form-group">
                <label>Тип</label>
                <select  class="form-control" name="slider_type">
                    <option value="upper">Верхний слайдер</option>
                    <option value="bottom">Нижний слайдер</option>
                </select>
            </div>

            <div class="form-group">
                <label>Тип</label>
                <select  class="form-control" name="type" required>
                    <option value="book" {{ !empty($slider) && $slider->type=='book' ? 'selected'  : '' }}>Книга</option>
                    <option value="catalog" {{ !empty($slider) && $slider->type=='catalog' ? 'selected'  : '' }}>Каталог</option>
                    <option value="collection" {{ !empty($slider) && $slider->type=='collection' ? 'selected'  : '' }}>Подборка</option>
                </select>
            </div>

            <div id="books_list" class="form-group">
                <label>Книги</label>
                <select id="ebook" class="js-example-basic-single" name="book_id" >
                    @foreach($books as $item)
                        <option  value="{{$item->book_id}}" {{ !empty($slider) && $slider->book_id==$item->book_id ? 'selected'  : '' }}>{{$item->book_name}}</option>
                    @endforeach
                </select>
            </div>


            <label>Каталоги</label>
            <select name="catalog_id" >
                @foreach(\App\Models\Genre::all() as $genre)
                    <option  value="{{$genre->genre_id}}" {{ !empty($slider) && $slider->catalog_id==$genre->genre_id ? 'selected'  : '' }}>
                        {{$genre->genre_name_kz}}
                    </option>
                @endforeach
            </select>

            <label>Подборки</label>
            <select name="collection_id" >
                @foreach(\App\Models\Collection::all() as $collection)
                    <option  value="{{$collection->collection_id}}" {{ !empty($slider) && $slider->collection_id==$collection->collection_id ? 'selected'  : '' }}>
                        {{$collection->collection_name_ru}}
                    </option>
                @endforeach
            </select>



            <div class="form-group">
                <label>Название слайда</label><i style="color:red" class="mdi mdi-asterisk"></i>
                <input type="text" class="form-control" name="slider_name" value="{{ !empty($slider) ? $slider->slider_name : old('slider_name') }}" />
                @error('slider_name')
                @include('admin.includes.form_error',['message'=>$message]);
                @enderror
            </div>

            <div class="form-group">
                <label>Сортировка</label>
                <input type="number" class="form-control" name="sort_num"
                       value="{{ !empty($slider) ? $slider->sort_num : old('sort_num') }}" />
                @error('sort_num')
                @include('admin.includes.form_error',['message'=>$message]);
                @enderror
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>Для сайта
                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a>
                        </label>
                        <label class="custom-file-container__custom-file" >
                            <input name="slider_image" type="file"   class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div id="leftPhoto" class="custom-file-container__image-preview"></div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                    <div class="custom-file-container" data-upload-id="myFirstImage2">
                        <label>Для мобилки
                            <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a>
                        </label>
                        <label class="custom-file-container__custom-file" >
                            <input name="adaptive_image" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div id="rightPhoto" class="custom-file-container__image-preview"></div>
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
    <script>
        var upload_file_poster = new FileUploadWithPreview('myFirstImage');
        var upload_file_poster2 = new FileUploadWithPreview('myFirstImage2');
        @if(!empty($slider))

        $("#leftPhoto").css({
            "background-image": "url({{'https://kitapal.kz'.$slider->slider_image}})"
        })
        $("#rightPhoto").css({
            "background-image": "url({{'https://kitapal.kz'.$slider->adaptive_image}})"
        })
        @endif




        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
