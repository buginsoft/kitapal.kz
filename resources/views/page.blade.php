@extends('layouts.main')
@php
    $content = 'page_content_'.app()->getLocale();
    $name = 'page_name_'.app()->getLocale();
@endphp
@section('title')
    {{$page->$name}}
@endsection
<style>
    .crumbs__container.page{
        margin: 0px 0px 20px 0px;
    }
    .crumbs__container.page .crumbs__box a,
    .crumbs__container.page .crumbs__box p {
        margin: 0px 10px 0px 0px;
    }
    .crumbs__container.page .crumbs__box a:hover{
        color: #72215e;
    }
</style>
@section('content')
    <div class="content">
        <div class="container">
            <div class="section-row">
                <div class="crumbs__container page">
                    <div class="crumbs__box d-flex aling-items-center">
                        <a href="/">Главная</a>
                        <p> > </p> {{$page->$name}}
                    </div>
                </div>

                {!! $page->$content!!}
            </div>
        </div>
    </div>
@endsection