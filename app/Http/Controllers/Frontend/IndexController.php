<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Book;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Collection;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{

    public function testredis(){
        $cachedBlog = \Illuminate\Support\Facades\Redis::get('recent_articles');
        if(isset($cachedBlog)) {
            $articles = json_decode($cachedBlog,true);

            // dd($articles);
        }else {
            $articles =   Article::orderBy('created_at','desc')->take(4)->get();
            \Illuminate\Support\Facades\Redis::set('recent_articles', $articles);

            //dd($blog);
        }
        return view('testredis',compact('articles'));
    }
    public function index()
    {
        $sliders = Slider::where('slider_type','upper')->orderBy('sort_num')->get();
        $bottom_sliders = Slider::where('slider_type','bottom')->orderBy('sort_num')->get();
        $contacts = Contact::first();
        $collections = Collection::with('books')->orderBy('sort_num')->get();
        $cachedarticles = \Illuminate\Support\Facades\Redis::get('recent_articles');

        if (isset($cachedarticles)) {
            $articles = json_decode($cachedarticles, true);
        } else {
            $articles = \App\Models\Article::orderBy('created_at', 'desc')->take(4)->get();
            \Illuminate\Support\Facades\Redis::set('recent_articles', $articles);
        }
        $lang = \App::getLocale();

        return view('index', compact('articles','sliders','contacts','collections','bottom_sliders','lang'));
    }
    public function test(){
        $address = \App\Models\Address::where('user_id',\Auth::user()->user_id)->first();

        return view('test',compact('address'));
    }
    public function getAuthor($author_id)
    {
        $author = Author::find($author_id);
        $books = $author->books()->paginate(12);

        return view('author', compact('books','author'));
    }
    public function getPublisher($publisher_id){
        $publisher = Publisher::find($publisher_id);
        $books = $publisher->books()->paginate(12);

        return view('publisher', compact('books','publisher'));
    }
}
