<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use App\Models\UserBooks;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class BookController extends Controller
{

    public function index($book_url)
    {
        $user = Auth::user();
        $book = Book::where('book_url', $book_url)->first();
        $lang = app()->getLocale();

        $breadcrumb_link = '';
        $genre_name = 'genre_name_' . $lang;

        if (strpos(url()->previous(), 'catalog') !== false) {
            $genre_id = explode("/", url()->previous());
            $breadcrumb_link = '<a href="' . url()->previous() . '">' . Genre::find(end($genre_id))[$genre_name] . '</a> <p>> </p>';
        }

        $breadcrumb_link = $breadcrumb_link . $book->book_name;

        if ($user) {
            /*$boughtebookbefore = UserBooks::where([
                ['ub_user_id',$user->user_id],
                ['ub_book_id',$book->book_id],
                ['type','ebook']])->first();*/
            $boughtaudiobefore = UserBooks::where([
                ['ub_user_id', $user->user_id],
                ['ub_book_id', $book->book_id],
                ['type', 'ebook']])->first();

            // $ebook = $boughtebookbefore?1:0;
            $audio = $boughtaudiobefore ? 1 : 0;

            return view('singleBook', compact('book', 'audio', 'genre_name', 'breadcrumb_link'));
        }

        return view('singleBook', compact('book', 'genre_name', 'breadcrumb_link'));
    }

    public function search(Request $request)
    {
        $search_word = $request->search;

        /* $words =explode($search_word);
         dd(' ',$words);*/
        //dd(preg_split('/ +/', $search_word));

        $books = Book::with(['authors', 'publisher', 'genres'])
            ->where([['book_name', 'like', '%' . $search_word . '%'], ['in_archive', 0]])
            ->orWhereHas('authors', function (Builder $q) use ($search_word) {
                $q->where('name_kz', 'like', '%' . $search_word . '%')
                    ->orWhere('name_ru', 'like', '%' . $search_word . '%');
            })->orWhereHas('publisher', function (Builder $q) use ($search_word) {
                $q->where('name_kz', 'like', '%' . $search_word . '%')
                    ->orWhere('name_ru', 'like', '%' . $search_word . '%');
            })->paginate(12);

        return view('searchresult', compact('books', 'search_word'));
    }

    public function readbook($book_id)
    {
        $result = check_access(\Auth::user(),$book_id);
        if($result['success']){
            return view('readbook', ['book' => $result['book'], 'last' => $result['last']]);
        }
        else{
            abort(404);
        }
    }
}

