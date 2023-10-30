<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TelegramBotApiController extends Controller
{
    public function getCategories(Request $request)
    {
        return new \App\Http\Resources\GenreResource(\App\Models\Genre::all(),'kz');

    }
    public function getCategoryBooks(Request $request){
        $genre = \App\Models\Genre::where('genre_id', $request->genre_id)->with('books')->first();
        if($request->has('author_id')){
            $genre = \App\Models\Author::where('id' , $request->author_id)->first();
        }
        $books= $genre->paperbooks2()->with(['authors', 'images'])->filterBy($request->all());
        $books=$books->get();

        return new \App\Http\Resources\CatalogResource($books,'kz');
    }
    public function search(Request $request){
        $search_word=$request->search;

        $books = \App\Models\Book::where('book_name','like', '%'.$search_word.'%')->where('in_archive',0)
            ->select('book_id','book_name','book_image','book_lang','paperbook_price as price')
            ->get();

        foreach($books as $item){
            $item['book_image']=$item->main_image()->path;
            $item["author"]=new \App\Http\Resources\AuthorResource($item->authors);
            unset($item['authors']);
        }

        return ['books'=>$books];
    }

}
