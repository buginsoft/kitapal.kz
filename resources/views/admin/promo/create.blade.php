@extends('admin.layouts.form')

@section('form_title','Добавить')
@section('breadcrumb','Добавить промокод')

@section('preview_button')
    <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/promocodes" class="btn btn-danger">Назад</a>
    </div>
@endsection
@section('form')
    <form  action="{{$action}}" method="POST" >
        @csrf
        @if(isset($promocodes))
            @method('put')
            @endif
        <div class="widget-content widget-content-area simple-pills">
            <div class="form-group">
                <label>Название</label>
                <input type="text" class="form-control" name="title" value="{{isset($promocodes)?$promocodes->title:''}}" />
            </div>
            <div class="form-group">
                <label>Код</label>
                <input type="text" class="form-control" name="code" value="{{isset($promocodes)?$promocodes->code:''}}" />
            </div>
            <button class="btn btn-success generate" >Генерировать</button>
            <div class="form-group">
                <label>Процент</label>
                <input type="number" class="form-control" name="percentage" value="{{isset($promocodes)?$promocodes->percentage:''}}" />
            </div>
            <div class="form-group">
                <label>Время истечения</label>
                <input type="date" class="form-control" name="expire" value="{{isset($promocodes)?$promocodes->expire:''}}" />
            </div>


            @if(isset($promocodes))
                @if($promocodes->reuseable)
                    <div class="form-group">

                        <input style="position:unset;left:unset;opacity:unset;" type="checkbox"  name="reuseable" value="1" checked>
                        <label for="is_show_yes">Многоразовое</label>

                    </div>
                @else
                    <div class="form-group">
                        <input style="position:unset;left:unset;opacity:unset;" type="checkbox"  name="reuseable" value="1">
                        <label for="is_show_yes">Многоразовое</label>
                    </div>
                @endif
            @else
                <div class="form-group">
                    <input style="position:unset;left:unset;opacity:unset;" type="checkbox"  name="reuseable" value="1" checked>
                    <label for="is_show_yes">Многоразовое</label>
                </div>
            @endif
            <div class="form-group">
                <label>Количество</label>
                <input type="number" class="form-control" name="quantity" value="{{isset($promocodes)?$promocodes->quantity:'1'}}" />
            </div>
            @if(isset($promocodes))
                @if($promocodes->status)
                    <div class="form-group">
                        <input style="position:unset;left:unset;opacity:unset;" type="checkbox" name="status" value="1" checked>
                        <label  for="is_show_yes">Активный</label>
                    </div>
                @else
                    <div class="form-group">
                        <input style="position:unset;left:unset;opacity:unset;" type="checkbox" name="status" value="1">
                        <label  for="is_show_yes">Активный</label>
                    </div>
                @endif
            @else
                <div class="form-group">
                    <input style="position:unset;left:unset;opacity:unset;" type="checkbox" name="status" value="1" checked>
                    <label  for="is_show_yes">Активный</label>
                </div>
            @endif
        </div>
        <div class="col-lg-8 col-md-12 text-right">
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(".generate").on("click", function(e) {
            var len = 10;
            generateCode(len);
            return false;
        });
        function generateCode(length) {
            $.ajax({
                method: "POST",
                url: "/admin/generate-promocode",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    length: length,
                }
            }).done(function (msg) {
                $("input[name='code']").val(msg.code);
            });
        }
    </script>
@endsection
