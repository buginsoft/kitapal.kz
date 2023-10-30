@extends('admin.layouts.form')
@section('breadcrumb',$title)
@section('form_title' ,$title)
@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/subscription" class="btn btn-danger">Назад</a>
    </div>
@endsection
@section('form')
    <form  action="/admin/subscription/{{$subscription->id}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @foreach(\App\Models\SubscriptionInformation::orderBy('sort')->get() as $key=>$information)
            <div class="n-chk">
                <label class="new-control new-checkbox checkbox-primary">
                    <input type="checkbox" class="new-control-input" name="information[{{$information->id}}]" value="1"   @if(array_key_exists($information->id, json_decode($subscription["description"],true))) @if(json_decode($subscription["description"],true)[$information->id]) checked @endif  @endif>
                    <span class="new-control-indicator"></span>{{$information->title_ru}}
                </label>

{{--                    <div class="form-group">--}}
{{--                        <label>Text colour:</label>--}}
{{--                        <input type="color" class="form-control" name="text_colour" value="#053eeb"/>--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <label>Card_colour:</label>
                        <input type="color" class="form-control" name="card_colour" value="#ECF9FF"/>
                    </div>

                    <div class="form-group">
                        <label>Button colour:</label>
                        <input type="color" class="form-control" name="button_colour" value="#ECF9FF"/>
                    </div>

                @include('admin.includes.fileupload', ['name' => 'post_image'])

            </div>

        @endforeach

        <div class="col-lg-8 col-md-12 text-right">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@endsection
@section('page_level_js')
    <!--Page level js-->
    <script>
        let upload_file_poster = new FileUploadWithPreview('myFirstImage');
        @if(!empty($information))
        $(".custom-file-container__image-preview").css("background-image", "url({{$subscription->post_image}})");
        @endif
    </script>
@endsection
