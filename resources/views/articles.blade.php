@php
    $lang=App::getLocale();
    $title = 'title_'.$lang;
    $short_text = 'short_text_'.$lang;
@endphp
@extends('layouts.main')
@section('title')
    @lang('title.articles')
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title"></h1>
                <div class="row catalog">
                    @foreach($articles as $article)
                        <div class="col-md-3 col-sm-6">
                            <a href="/article/{{$article->id}}">
                                <div class="item-article">
                                    <img src="{{$article->image}}">
                                    <div class="text-article">
                                        <p>{{$article->$title}}</p>
                                        <p class="fs-15 text-grey">{!!$article->$short_text!!}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <nav>
                    {{ $articles->links('vendor.pagination.custom') }}
                </nav>
            </div>
        </div>
    </div>
@endsection