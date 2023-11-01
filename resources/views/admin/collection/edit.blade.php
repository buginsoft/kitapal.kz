@extends('admin.layouts.form')

@section('form_title','Изменить подборку')
@section('breadcrumb','Изменить подборку')

@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/collection" class="btn btn-danger">Назад</a>
    </div>
@endsection

@section('form')
    @if(empty($collection))
        <form action="/admin/collection" method="POST" enctype="multipart/form-data">
            @else
                <form  action="/admin/collection/{{ $collection->collection_id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @endif
                    @csrf

                    <div class="widget-content widget-content-area simple-pills">

                        <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-russian-tab" data-toggle="pill" href="#pills-russian" role="tab" aria-controls="pills-russian" aria-selected="true">Русский</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-kz-tab" data-toggle="pill" href="#pills-kz" role="tab" aria-controls="pills-kz" aria-selected="false">Казахский</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-russian" role="tabpanel" aria-labelledby="pills-russian-tab">
                                <div class="form-group">
                                    <label>Название</label>
                                    <input type="text" class="form-control" name="collection_name_ru"
                                           value="{{ !empty($collection) ? $collection->collection_name_ru : old('collection_name_ru') }}" />
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-kz" role="tabpanel" aria-labelledby="pills-kz-tab">
                                <div class="form-group">
                                    <label>Название</label>
                                    <input type="text" class="form-control" name="collection_name_kz"
                                           value="{{ !empty($collection) ? $collection->collection_name_kz : old('collection_name_kz') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="custom-file-container" data-upload-id="BannerImage">
                            <label>Баннер
                                <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">
                                    x
                                </a>
                            </label>
                            <label class="custom-file-container__custom-file" >
                                <input name="banner_image" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="banner-file custom-file-container__image-preview"></div>
                        </div>

                        <div class="form-group">
                            <label>Ссылка Баннера</label>
                            <input type="text" class="form-control" name="banner_url"
                                   value="{{ !empty($collection) ? $collection->banner_url : old('banner_url') }}" />
                        </div>
                        <div class="form-group">
                            <label>Место</label>
                            <input type="text" class="form-control" name="sort_num"
                                   value="{{ !empty($collection) ? $collection->sort_num : old('sort_num') }}" />
                        </div>
                        <div class="form-group">
                            <label>Цвет</label>
                            <input type="text" class="form-control" name="color"
                                   value="{{ !empty($collection) ? $collection->color : old('color') }}" required/>
                        </div>
                        <div class="form-group">
                            <label class="new-control new-checkbox checkbox-primary">
                                <input name="show_badge" type="checkbox" class="new-control-input"  @if(!empty($collection) && ($collection->show_badge)) checked @endif value="1">
                                <span class="new-control-indicator"></span>Показать значок
                            </label>
                        </div>


                        @include('admin.includes.fileupload', ['name' => 'book_image'])

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
                    @if(!empty($collection))
                    $(".custom-file-container__image-preview").css({
                        "background-image": "url({{'https://kitapal.kz'.$collection->icon}})"
                    });
                    @endif
                </script>
                    <script>
                    let upload_file_banner = new FileUploadWithPreview('BannerImage');
                    @if(!empty($collection))
                    $(".banner-file").css({
                        "background-image": "url({{'https://kitapal.kz'.$collection->icon}})"
                    });
                    @endif
                </script>
@endsection

