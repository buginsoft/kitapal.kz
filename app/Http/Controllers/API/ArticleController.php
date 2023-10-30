<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Article;
use App\Models\Address;
use App\Models\Chapter;
use App\Models\UserBooks;
use App\Models\City;
use App\Models\UserSubscription;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\UserBooksResource;
use Illuminate\Support\Facades\Validator;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ArticleController extends Controller
{
    public $lang = 'ru';

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang')?:'ru';
    }
    public function show(Request $request)
    {
        if($request->has('article_id')) {
            $article = Article::where('id', $request->article_id)
                ->select('id','title_'.$request->lang.' as title', 'text_'.$request->lang.' as text', 'image', 'created_at')->first();

            $article->image = url('/') . $article->image;
        }
        else{
            $article = Article::orderBy('created_at','desc')->select('id','title_' . $request->lang.' as title',  'image', 'created_at' ,'short_text_'. $request->lang.' as short_text')->get();

            foreach ($article as $item) {
                $item->image = url('/') . $item->image;
            }
        }
        return ['data' => $article, 'success' => true];
    }
}
