@php
    $lang=App::getLocale();
    $name='name_'.App::getLocale();
    $description='description_'.$lang;
    $source='source_'.$lang;
@endphp
@push('styles')
    <link rel="stylesheet" href="/css/author_publish_style.css?v=21">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

@endpush
@extends('layouts.main')
@section('title')
    @lang('main.title')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid author__box">
            <div class="container">
                <div class="row section-row">
                    <div class="col-lg-3">
                        <img src="{{$publisher->photo}}" alt="">
                        <div class="social d-flex">
                            @if($publisher->facebook)
                                <a target="_blank" href="{{$publisher->facebook}}"><i class="fab fa-facebook-square"></i></a>
                            @endif
                            @if($publisher->instagram)
                                <a target="_blank" href="{{$publisher->instagram}}"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($publisher->telegram)
                                <a target="_blank" href="{{$publisher->telegram}}"><i class="fab fa-telegram-plane"></i></a>
                            @endif
                            @if($publisher->twitter)
                                <a target="_blank" href="{{$publisher->twitter}}"><i class="fab fa-twitter-square"></i></a>
                            @endif
                            @if($publisher->vk)
                                <a target="_blank" href="{{$publisher->vk}}"><i class="fab fa-vk"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h3 class="title">{{$publisher->$name}}</h3>
                        <p class="text">{!!$publisher->$description!!}</p>
                        <p class="source">
                            <span>Дереккөзі:</span>
                            {!! $publisher->$source!!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section class="example__box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 example_cont">
                        <h2 class="book__title">
                            Шығармалар:
                        </h2>
                        <div class="book__cont d-flex">
                            @foreach($books as $book)
                                <div class="book__box">
                                    <a target="_blank" href="/book/{{$book->book_url}}">
                                        <img src="{{$book->main_image()->path}}" alt="">
                                        <p>{{$book->book_name}}</p>
                                        <span>
                                            @foreach($book->authors as $key=>$author)
                                                @if($key==count($book->authors)-1)
                                                    {{$author->$name}}
                                                @else
                                                    {{$author->$name}},
                                                @endif
                                            @endforeach
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        {{$books->links()}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
@endpush
