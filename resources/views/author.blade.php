@php
    $lang=App::getLocale();
    $name='name_'.App::getLocale();
    $description='description_'.$lang;
    $source='source_'.$lang;
@endphp
@push('styles')
    <link rel="stylesheet" href="/css/author_publish_style.css">
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
                        <img src="{{$author->author_photo}}" alt="">
                        <div class="social d-flex">
                            @if($author->facebook)
                                <a target="_blank" href="{{$author->facebook}}"><i class="fab fa-facebook-square"></i></a>
                            @endif
                            @if($author->instagram)
                                <a target="_blank" href="{{$author->instagram}}"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($author->telegram)
                                <a target="_blank" href="{{$author->telegram}}"><i class="fab fa-telegram-plane"></i></a>
                            @endif
                            @if($author->twitter)
                                <a target="_blank" href="{{$author->twitter}}"><i class="fab fa-twitter-square"></i></a>
                            @endif
                            @if($author->vk)
                                <a target="_blank" href="{{$author->vk}}"><i class="fab fa-vk"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h3 class="title">{{$author->$name}}</h3>
                        <p class="text">{!! $author->$description!!}</p>
                        <p class="source">
                            <span>Дереккөзі:</span>
                            {{$author->$source}}
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
