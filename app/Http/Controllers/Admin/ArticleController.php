<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Genre;
use App\Models\BookGenre;
use App\Http\Helpers;
use App\Http\Controllers\Admin\MP3File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return view('admin.article.article', compact('articles'));
    }
    public function create()
    {
        $action='/admin/article';
        return view('admin.article.form' , compact('action'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'book_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('book_image')) {
            $image = $request->file('book_image');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $image_name = $destinationPath . '/' . $image_name;

            if (Storage::disk('image')->exists($image_name)) {
                $now = \DateTime::createFromFormat('U.u', microtime(true));
                $image_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
            }

            Storage::disk('image')->put($image_name, File::get($image));
            $result = '/media' .$image_name;
        }

        $article = new Article();
        $article->title_ru = $request->title_ru;
        $article->text_ru = $request->text_ru;;
        $article->title_kz = $request->title_kz;
        $article->text_kz = $request->text_kz;
        $article->short_text_ru = $request->short_text_ru;
        $article->short_text_kz = $request->short_text_kz;
        $article->image = $result;
        $article->save();

       $this->update_recent();


        if($request->send_push){
            send_push(['id'=>$article->id, 'title'=>$article->title_kz,'text'=>'Добавлена новая статья','type'=>'article']);
        }
        return redirect("/admin/article");
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $action='/admin/article/'.$id;
        $article = Article::find($id);
        return view('admin.article.form', compact('article','action'));
    }
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->title_ru = $request->title_ru;
        $article->text_ru = $request->text_ru;;
        $article->title_kz = $request->title_kz;
        $article->text_kz = $request->text_kz;
        $article->short_text_ru = $request->short_text_ru;
        $article->short_text_kz = $request->short_text_kz;
        if($request->hasFile('book_image')){
            $result=Helpers::storeImg('book_image', 'image', $request);;
        }
        else{
            $result=$article->image;
        }
        $article->image = $result;
        $article->save();

        $this->update_recent();

        return redirect("/admin/article");
    }
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        $this->update_recent();
    }

    public function update_recent(){
        \Illuminate\Support\Facades\Redis::del('recent_articles');
        $recent_articles = \App\Models\Article::orderBy('created_at', 'desc')->take(4)->get();
        \Illuminate\Support\Facades\Redis::set('recent_articles', $recent_articles);
    }
}
