@extends('admin.layouts.layout')

@section('css')

@endsection

@section('content')
    <div class="page-wrapper" style="min-height: 319px;">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-8 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">
                        Редактировать
                    </h3>
                </div>
                <div class="col-md-4 col-4 align-self-center text-right">
                    <a href="/admin/user_subscriptions" class="btn btn-danger">Назад</a>
                </div>
            </div>
            <div class="row">
                <form class="col-lg-12 col-md-12 row" action="/admin/user_subscriptions/{{ $user_subscription->us_id }}" method="POST">
                    @method('PUT')
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
                                        <label>Активный</label><br>
                                        <input type="radio" class="form-check-input" name="us_active" value="1"
                                               id="us_active_yes" {{ ($user_subscription->us_active == 1) ? "checked" : "" }}>
                                        <label class="form-check-label" for="$us_active_yes">
                                            Да
                                        </label>
                                        <input type="radio" class="form-check-input" name="us_active" value="0"
                                               id="us_active_no" {{ ($user_subscription->us_active == 0) ? "checked" : "" }}>
                                        <label class="form-check-label" for="$us_active_no">
                                            Нет
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Действителен до:</label>
                                        <input type="date" class="form-control" name="us_final_date" value="{{ $user_subscription->us_final_date }}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $(document).ready(function () {
            $('#phone').mask('8 (000) 000-00-00');
        });
    </script>
@endsection