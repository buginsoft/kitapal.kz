<?php
$lang = App::getLocale();
$name = 'name_' . $lang;

use App\Models\Book;
?>
@extends('layouts.main')
@section('title',__('main.title'))
@section('content')
                    <div class="section-row">
                        <p class="big-title">@lang('main.articles_title')
                            <span class="pull-right">
                                <a class="text-green" href="/articles">@lang('main.all_articles')
                                    <i class="icons ic-arrow-r"></i></a>
                            </span>
                        </p>
                        <div class="row">
                            @foreach($articles as $article)
                                <div class="col-md-3 col-sm-6">
                                    <a href="/article/{{$article->id}}">
                                        <div class="item-article">
                                            <img src="{{$article->image}}">
                                            <div class="text-article">
                                                <p class="block__title">{{$article['title_'.$lang]}}</p>
                                                <p class="fs-15 text-grey">{!! $article['short_text_'.$lang] !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
@endsection
@push('scripts')
@endpush
