@extends('admin.layouts.layout')

@section('css')
@endsection
@section('breadcrumb','Меню')

@section('content')
    <div class="page-wrapper" style="min-height: 319px;">
    {!! Menu::render() !!}
    </div>
@endsection

@section('js')
    {!! Menu::scripts() !!}
    <script>
        $("#menu-item-url-wrap").append( '<p>' +
            '<label class="howto" >'+
            '<span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp'+
            '<select id="pageid" class="menu-item-textbox "><option  value="nothing" selected="selected">Выберите страницу</option>@foreach($pages as $page)<option value="page/{{$page->id}}">{{$page->page_name_ru}}</option>@endforeach</select>'+
            '</label></p>');

        let selectmenu=document.getElementById("pageid");
        selectmenu.onchange=function(){
            var value=$("#pageid").val();
            var url='{{url("/")}}';
            $("#custom-menu-item-url").val(url+'/'+value);
        };
    </script>
@endsection