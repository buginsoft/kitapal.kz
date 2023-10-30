<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('id','desc')->paginate(8);
        return view('articles',compact('articles'));
    }
    public function show($article_id)
    {
        $article = Article::find($article_id);
        return view('singlearticle',compact('article'));
    }

}
