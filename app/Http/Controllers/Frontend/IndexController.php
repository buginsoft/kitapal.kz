<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Collection;
use App\Models\Contact;
use App\Models\Publisher;
use App\Models\Slider;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('slider_type', 'upper')->orderBy('sort_num')->get();
        $bottom_sliders = Slider::where('slider_type', 'bottom')->orderBy('sort_num')->get();
        $contacts = Contact::first();
        $collections = Collection::with('books')->orderBy('sort_num')->get();
        $articles = \App\Models\Article::orderBy('created_at', 'desc')->take(4)->get();

        $lang = \App::getLocale();

        return view('index', compact('articles', 'sliders', 'contacts', 'collections', 'bottom_sliders', 'lang'));
    }

    public function test()
    {
        $address = \App\Models\Address::where('user_id', \Auth::user()->user_id)->first();

        return view('test', compact('address'));
    }

    public function getAuthor($author_id)
    {
        $author = Author::find($author_id);
        $books = $author->books()->paginate(12);

        return view('author', compact('books', 'author'));
    }

    public function getPublisher($publisher_id)
    {
        $publisher = Publisher::find($publisher_id);
        $books = $publisher->books()->paginate(12);

        return view('publisher', compact('books', 'publisher'));
    }
}
