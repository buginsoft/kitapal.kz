@extends('admin.layouts.form')

@section('form_title','Добавить пользователя')
@section('breadcrumb','Добавить пользователя')

@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/users" class="btn btn-danger">Назад</a>
    </div>
@endsection

@section('form')
    @if(empty($user))
        <form  action="/admin/users" method="POST" enctype="multipart/form-data">
            @else
                <form action="/admin/users/{{ $user->user_id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="widget-content widget-content-area simple-pills">
                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text" class="form-control" name="user_name" value="{{ (!empty($user)) ? $user->user_name : old('user_name')  }}"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ (!empty($user)) ? $user->email : old('email')  }}"/>
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="tel" class="form-control" name="phone" id="phone" value="{{ (!empty($user)) ? $user->phone : old('phone')  }}"/>
                        </div>
                        <div class="form-group">
                            <label>Дата рождения</label>
                            <input type="date" class="form-control" name="date_of_birth" max="2999-12-31" value="{{ (!empty($user)) ? $user->date_of_birth : old('date_of_birth')  }}"/>
                        </div>
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" class="form-control" name="password"/>
                        </div>

                        @include('admin.includes.fileupload', ['name' => 'avatar'])

                    </div>
                    <div class="col-lg-8 col-md-12 text-right">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
                @endsection

            @section('page_level_js')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#phone').mask('8 (000) 000-00-00');
                    });

                    let upload_file_poster = new FileUploadWithPreview('myFirstImage');
                    @if(!empty($user))
                    $(".custom-file-container__image-preview").css("background-image", "url({{$user->avatar}})");
                    @endif

                </script>
@endsection
