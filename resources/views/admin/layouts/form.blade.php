@extends('admin.layouts.layout')

@section('css')
    <link href="/new_admin_design/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/new_admin_design/assets/css/forms/theme-checkbox-radio.css">
    <link href="/new_admin_design/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    @yield('page_level_css')
@endsection

<style>
    .form__button{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn{
        box-shadow:unset !important;
    }
</style>

@section('content')
    <div class="container" style="justify-content:center; margin:0; max-width:unset !important;">
        <div class="container">
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-10">
                                    <div class="form__button">
                                        <h4>@yield('form_title')</h4>
                                        @yield('previews_button')
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/new_admin_design/assets/js/scrollspyNav.js"></script>
    <script src="/new_admin_design/plugins/file-upload/file-upload-with-preview.min.js?v=2"></script>
    @yield('page_level_js')
@endsection
