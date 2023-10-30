@extends('admin.layouts.form')

@section('form_title','Изменить переводчика')
@section('breadcrumb','Изменить переводчика')

@section('previews_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/translator" class="btn btn-danger">Назад</a>
    </div>
@endsection

@section('form')
    <div class="widget-content widget-content-area simple-pills">
        <form  action="/admin/translator/{{ $translator->id }}" method="POST" >
            @method('put')
            @csrf
            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label>ФИО КЗ</label>
                    <input type="text" class="form-control" name="name_kz"
                           value="{{ $translator->name_kz }}" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label>ФИО РУ</label>
                    <input type="text" class="form-control" name="name_ru" value="{{ $translator->name_ru  }}" />
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
