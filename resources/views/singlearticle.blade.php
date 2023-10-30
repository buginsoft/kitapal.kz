@php
    use App\Http\Helpers;
    $lang=App::getLocale();
    $text = 'text_'.$lang;
    $title = 'title_'.$lang;
@endphp

@extends('layouts.main')
@section('title')
    {{$article->$title}}
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row section-row">
                <div class="col-md-8">
                    <h1 class="big-title mb-25">{{$article->$title}}</h1>
                    <div class="top-tags">
                        <span class="text-uppercase">
                            <i class="icons ic-calendar"></i>
                            {{$article->created_at->format('d')}}
                            {{Helpers::getMonthName($article->created_at->format('n') )}}
                            {{$article->created_at->format('Y')}}</span>
                    </div>
                    <div class="mt-40"><img class="img-100" src="{{$article->image}}"></div>
                    <div class="mt-40">
                        {!! $article->$text!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection