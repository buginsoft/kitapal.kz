<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Book;
use App\Models\BookGenre;

class CollectionController extends Controller
{
    public $lang = 'ru';

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang')?:'ru';
    }

    public function getCollectionList()
    {
        $collection = Collection::all();
        $row = array();
        foreach ($collection as $key => $value) {
            $book = Book::where('book_collection_id', $value->collection_id)
                        ->orderBy('books.book_views', 'desc')
                        ->take(3)
                        ->get();
            $row[$key]['collection_id'] = $value->collection_id;
            $row[$key]['collection_name'] = $value['collection_name_'.$this->lang];
            $row[$key]['book_image'] = array();
            foreach ($book as $key_b=>$val) {
                $row[$key]['book_image']['image_'.$key_b]=$val->main_image()->path;
            }
        }

        $result['data'] = $row;
        $result['status'] = true;

        return $result;
    }

    public function getCollectionByGenre($id)
    {
        $collection = Collection::all();
        $row = array();
        foreach ($collection as $key => $value) {
            $book = BookGenre::leftJoin('books', 'book_genres.bg_book_id', '=', 'books.book_id')
                ->where('book_collection_id', $value->collection_id)
                ->where('bg_genre_id', $id)
                ->orderBy('books.book_views', 'desc')
                ->take(3)
                ->get();
            $row[$key]['collection_id'] = $value->collection_id;
            $row[$key]['collection_name'] = $value['collection_name_'.$this->lang];
            $row[$key]['book_image'] = array();
            foreach ($book as $key_b=>$val) {
                $row[$key]['book_image']['image_'.$key_b]=$val->main_image()->path;
            }
        }

        $result['data'] = $row;
        $result['status'] = true;

        return $result;
    }
    public function getCompilation(Request $request){
        $collection_books = Collection::find($request->id)->books;
        $row2 = array();
        foreach ($collection_books as $key => $value) {
            $row['book_id'] =$value->book_id;
            $row['book_name'] =$value->book_name;
            $row['book_image'] =$value->main_image()->path;
            $row['price']=$value->paperbook_price;
            if(isset($value->authors)) {
                $row['author'] = new \App\Http\Resources\AuthorResource($value->authors);
            }
            array_push($row2,$row);
       }
        $result['data'] = $row2;
        $result['status'] = true;
        return $result;
    }
}
